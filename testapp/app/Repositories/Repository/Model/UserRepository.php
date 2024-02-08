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
        try {
            $user  = $this->model->findorFail($id);
            if (!$user) {

                    return response()->json([
                        'message' => 'user not found',
                        'status' => 404
                    ], 404);

            }
            return $user;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->message(),
                'status' => 500
            ], 500);
        }
    }

    public function get()
    {
        try {
            $users  = $$this->model->all();
            if (!$users) {
                    return response()->json([
                        'message' => 'users not found',
                        'status' => 404
                    ], 404);
            }
            return $users;
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->message(),
                'status' => 500
            ], 500);
        }
    }

    public function create(Request $request)
    {
        $validateResult = $this->create_validation($request);
        if ($validateResult !== null && $validateResult->getStatusCode() !== 200) {
            return $validateResult;
        }
        try{
            $this->model->name = $request->name;
            $this->model->email = $request->email;
            $this->model->password = bcrypt($request->password);
            $this->model->save();
            return redirect()->route('login')->with([
                'message' => 'user',
                'status' => 200
            ])->json([
                'message' => 'user',
                'status' => 200
            ], 200);
            
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->message(),
                'status' => 500
            ], 500);
        }
    }

    public function update(Request $request)
    {

        $validateResult = $this->update_validation($request);
        if ($validateResult !== null && $validateResult->getStatusCode() !== 200) {
            return $validateResult;
        }
        try{
            $this->model =  $this->model->findorFail($request->id);
            $this->model->update($request->all());
            return response()->json([
                'message' => 'User Updated info',
                'status' => 200
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->message(),
                'status' => 500
            ], 500);
        }
    }

    public function create_validation($data)
    {
        $validate = Validator::make($data->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        if($validate->fails()){
            $flatErrors = collect($validate->errors())->flatMap(function($e, $fileld){
                return [$fileld => $e[0]];
            });

            return response()->json([
                'message' => $flatErrors,
                'status' => 400
            ], 400);
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
            $flatErrors = collect($validate->errors())->flatMap(function($e, $fileld){
                return [$fileld => $e[0]];
            });

            return response()->json([
                'message' => $flatErrors,
                'status' => 400
            ], 400);
        }
    }

}
