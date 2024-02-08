<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
        //allcategory
        public function allowner(){
            try {
                $owners = Owner::paginate();
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
                $validationResult = $this->create_validation($request);

                if ($validationResult !==  null && $validationResult->getStatusCode() !== 200) {
                    return $validationResult;
                }

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

                try{
                    $owner = Owner::find($id);
                    if (!$owner) {
                        return response()->json([
                            'message' => 'owner not found',
                            'status' => 400
                        ], 400);                        
                    }
                    $validationResult = $this->update_validation($request);

                    if ($validationResult !==  null && $validationResult->getStatusCode() !== 200) {
                        return $validationResult;
                    }

                    $owner->update($request->all());
                    return $owner;
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
                    $owner = Owner::find($id);

                    if (!$owner) {
                        return response()->json([
                            'message' => 'owner not found',
                            'status' => 404
                        ], 404);
                    }

                    $owner->delete($id);
                    return $owner;
                } catch (Exception $e) {
                    return response()->json([
                        'message' => $e->message(),
                        'status' => 500
                    ], 500);
                }
            }
}
