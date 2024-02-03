<?php

namespace App\Repositories\Repository\Model;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class UserRepository extends Repository{
    public function model()
    {
        return User::class;
    }

    public function find($id)
    {
        return $this->model->findorFail($id);
    }

    public function get()
    {
        return $this->model->all();
    }

    public function create(Request $request)
    {
        $this->create_validation($request);
        try{
            $this->model->name = $request->name;
            $this->model->email = $request->email;
            $this->model->password = bcrypt($request->password);
            $this->model->save();
            Log::info("User created " . json_encode($this->model->email));
            return redirect()->route('login');
        }catch(QueryException $e){
            DB::rollBack();
            Log::alert("Query Exception " . $e->getMessage());
            throw new Exception('Oops! Something went wrong!');
        }catch(Throwable $e){
            DB::rollBack();
            Log::alert("Something is wrong with creating user " . $e->getMessage());
            throw new Exception('Oops! Something went wrong!');
        }
    }

    public function update(Request $request)
    {
        $this->update_validation($request);
        try{
            $this->model =  $this->model->findorFail($request->id);
            $this->model->update($request->all());
            Log::info("User updated info " . json_encode($this->model->email));
        }catch(ModelNotFoundException $e){
            DB::rollBack();
            Log::alert("Model Not Found Exception " . $e->getMessage());
            throw new Exception('Oops! Something went wrong!');
        }catch(QueryException $e){
            DB::rollBack();
            Log::alert("Query Exception " . $e->getMessage());
            throw new Exception('Oops! Something went wrong!');
        }catch(Throwable $e){
            DB::rollBack();
            Log::alert("Something is wrong with creating user " . $e->getMessage());
            throw new Exception('Oops! Something went wrong!');
        }
    }

    public function create_validation($data)
    {
        $validate = Validator::make($data->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);
        // dd($validate->fails());
        if($validate->fails()){
            Log::info("Creating user validation fail!" . $validate->errors());
            throw new Exception("Validation Fail!" . $validate->errors());
        }
    }

    public function update_validation($data)
    {
        $validate = Validator::make($data->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        if($validate->fails()){
            Log::info("Updating user validation fail!" . $validate->errors());
            throw new Exception("Validation Fail!" . $validate->errors());
        }
    }

}
