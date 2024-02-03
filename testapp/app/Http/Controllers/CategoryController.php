<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use TheSeer\Tokenizer\Exception;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    //allcategory
    public function allCategory(){
        try {
            $categories = Category::paginate(6);
            if (!$categories) {
                return response()->json([
                    'message' => 'category not found',
                    'status' => 404
                ], 404);
            }
            return $categories;
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
            $category = Category::find($id);
            if (!$category) {
                return response()->json([
                    'message' => 'category not found',
                    'status' => 404
                ], 404);
            }
            return $category;
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
                $category = new Category;
                $category->name = $request->name;
                $category->photo = $request->photo;
                $category->status = $request->status;
                $category->user_id = $request->userId;
                $category->save();
                return $category;
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
                'photo' => 'required',
                'status' => 'required',
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
                $category = new Category;
                $category =  $category->findorFail($id);
                $status = $category->update($request->all());
            }catch (Exception $e) {
                return response()->json([
                    'message' => $e->message(),
                    'status' => 500
                ], 500);
            }

            return response()->json([
                'message' => "Your Category is successfully updated",
                'status' => 200
            ], 200);
        }

        public function update_validation($data)
        {
            $validate = Validator::make($data->all(), [
                'name' => 'required',
                'photo' => 'required',
                'status' => 'required',
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
                $category = new Category;
                $category->delete($id);
                if (!$category) {
                    return response()->json([
                        'message' => 'category not found',
                        'status' => 404
                    ], 404);
                }
                return response()->json([
                    'message' => 'delete category is done',
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
