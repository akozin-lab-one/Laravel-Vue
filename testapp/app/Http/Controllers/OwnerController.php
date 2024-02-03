<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Exception;

class OwnerController extends Controller
{
        //allcategory
        public function allowner(){
            try {
                $owners = Owner::all();
                if (!$owners) {
                    return response()->json([
                        'message' => 'owner not found',
                        'status' => 404
                    ], 404);
                }
                return $owners;
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->message(),
                    'status' => 500
                ], 500);
            }
        }

        //find
        public function find($id){
            try {
                $owner = Owner::find($id);
                if (!$owner) {
                    return response()->json([
                        'message' => 'owner not found',
                        'status' => 404
                    ], 404);
                }
                return $owner;
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->message(),
                    'status' => 500
                ], 500);
            }
        }

            //createPage
            public function create(Request $request){
                $this->create_validation($request);
                try{
                    $owner = new Owner;
                    $owner->name = $request->name;
                    $owner->phone_number = $request->phone;
                    $owner->address = $request->address;
                    $owner->user_id = $request->userId;
                    $owner->save();
                    return $owner;
                } catch (Exception $e) {
                    return response()->json([
                        'message' => $e->message(),
                        'status' => 500
                    ], 500);
                }
            }

            //createvalidate
            public function create_validation($request)
            {
                // dd($request->all());
                $validate = Validator::make($request->all(), [
                    'name' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'userId' => 'required', Rule::exists('user', 'id')
                ]);

                if($validate->fails()){
                    $flatErrors = collect($validate->errors())->flatMap(function($e, $fileld){
                        return [$fileld => $e[0]];
                    });
                    // dd($flatErrors);
                    return response()->json([
                        'errors'=> $flatErrors,
                        'status' => 400
                    ],400);
                }
            }

            public function update(Request $request, $id)
            {
                $this->update_validation($request);
                try{
                    $owner = new Owner;
                    $owner =  $owner->findorFail($id);
                    $owner->update($request->all());
                }catch (Exception $e) {
                    return response()->json([
                        'message' => $e->message(),
                        'status' => 500
                    ], 500);
                }

                return response()->json([
                    'message' => "Your owner is successfully updated",
                    'status' => 200
                ], 200);
            }

            public function update_validation($data)
            {
                $validate = Validator::make($data->all(), [
                    'name' => 'required',
                    'phone' => 'required',
                    'address' => 'required',
                    'userId' => 'required', Rule::exists('user', 'id')
                ]);

                if($validate->fails()){
                    $flatErrors = collect($validate->errors())->flatMap(function($e, $fileld){
                        return [$fileld => $e[0]];
                    });

                    return response()->json([
                        'errors'=> $flatErrors,
                        'status' => 400
                    ],400);
                }
            }

            public function delete($id)
            {
                try {
                    $owner = new Owner;
                    $owner->delete($id);
                    if (!$owner) {
                        return response()->json([
                            'message' => 'owner not found',
                            'status' => 404
                        ], 404);
                    }
                    return response()->json([
                        'message' => 'delete owner is done',
                        'status' => 200
                    ],200);
                } catch (Exception $e) {
                    return response()->json([
                        'message' => $e->message(),
                        'status' => 500
                    ], 500);
                }
            }
}
