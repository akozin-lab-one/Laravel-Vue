<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
            //allcategory
            public function allItem(){
                try {
                    $products = Product::with('category:id,name', 'owner:id,name')->orderBy('created_at', 'desc')->paginate(6);
                    if (!$products) {
                        return response()->json([
                            'message' => 'products not found',
                            'status' => 404
                        ], 404);
                    }
                    return $products;
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
                    $product = Product::find($id);
                    if (!$product) {
                        return response()->json([
                            'message' => 'product not found',
                            'status' => 404
                        ], 404);
                    }
                    return $product;
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
                        $product = new Product;
                        $product->name = $request->name;
                        $product->category_id = $request->categoryId;
                        $product->description = $request->description;
                        $product->price = $request->price;
                        $product->user_id = $request->userId;
                        $product->owner_id = $request->ownerId;
                        $product->status = $request->status;
                        // $product->condition = $request->condition;
                        // $product->type = $request->type;
                        $product->photo = $request->photo;
                        $product->save();
                        return $product;
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
                        'description' => 'required',
                        'price' => 'required',
                        'userId' => 'required', Rule::exists('user', 'id'),
                        'status' => 'required',
                        // 'condition' => 'required',
                        // 'type' => 'required',
                        'photo' => 'required',
                        'categoryId' => 'required', Rule::exists('categories', 'id'),
                        'ownerId' => 'required', Rule::exists('owners', 'id')
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

                public function upload(Request $request){
                    $validationResult = $this->uploadValidation($request);

                    if ($validationResult !==  null && $validationResult->getStatusCode() !== 200) {
                        return $validationResult;
                    }

                    try {
                        $path = 'storage/' . request('image')->store('items');
                        return [
                            'path' => $path
                        ];
                    } catch (Exception $e) {
                        return response()->json([
                            'message' => $e->message(),
                            'status' => 500
                        ], 500);
                    }
                }

                public function uploadValidation($request){
                    $validate = Validator::make($request->all(), [
                        'image' => 'required | image',
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

                public function update(Request $request)
                {
                    try{
                        $product = Product::find($id);
                        if (!$product) {
                            return response()->json([
                                'message' => 'product not found',
                                'status' => 400
                            ], 400);
                        }
                        $validationResult = $this->update_validation($request);

                        if ($validationResult !==  null && $validationResult->getStatusCode() !== 200) {
                            return $validationResult;
                        }
                        $product->update($request->all());
                    }catch (Exception $e) {
                        return response()->json([
                            'message' => $e->message(),
                            'status' => 500
                        ], 500);
                    }

                    return response()->json([
                        'message' => "Your product is successfully updated",
                        'status' => 200
                    ], 200);
                }

                public function update_validation($data)
                {
                    $validate = Validator::make($data->all(), [
                        'name' => 'required',
                        'description' => 'required',
                        'price' => 'required',
                        'userId' => 'required', Rule::exists('user', 'id'),
                        'status' => 'required',
                        'condition' => 'required',
                        'type' => 'required',
                        'phtot' => 'required',
                        'categoryId' => 'required', Rule::exists('categories', 'id'),
                        'ownerId' => 'required', Rule::exists('owners', 'id')
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
                        $product = Product::find($id);
                        if (!$product) {
                            return response()->json([
                                'message' => 'product not found',
                                'status' => 404
                            ], 404);
                        }
                        $product->delete($id);
                        return $product;
                    } catch (Exception $e) {
                        return response()->json([
                            'message' => $e->message(),
                            'status' => 500
                        ], 500);
                    }
                }
}
