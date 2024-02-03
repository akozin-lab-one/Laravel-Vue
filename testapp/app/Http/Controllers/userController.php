<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Repository\Model\UserRepository;

class userController extends Controller
{
    //userrepository
    private UserRepository $userrepository;

    public function __construct(UserRepository $userrepository)
    {
        $this->userrepository = $userrepository;
    }

    //getmethod
    public function Dashboard() {
        // dd(Auth::user());
        if (Auth::user()) {
            return redirect()->route('product#main');
        }
    }

    public function create(Request $request){
       return $this->userrepository->create($request);
    }

    public function update(Request $request){
        return $this->userrepository->update($request);
    }

    public function find($id){
        return $this->userrepository->find($id);
    }

    public function allUsers(){
        return $this->userrepository->get();
    }


}
