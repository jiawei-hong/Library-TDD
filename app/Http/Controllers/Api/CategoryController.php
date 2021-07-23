<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryName = $request->get('name');
        $categoryIsExist = Category::where('name', $categoryName)->count() > 0;

        if ($categoryIsExist) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_CATEGORY_IS_EXIST',
                'data' => ''
            ], 404);
        }

        $category = Category::create(['name' => $categoryName]);

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => $category->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $category_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id)
    {
        $category = Category::find($category_id);

        if (is_null($category)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_CATEGORY_NOT_EXIST',
                'data' => ''
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_FIELD_MISSING',
                'data' => ''
            ], 400);
        }

        $category->update(['name' => $request->get('name')]);

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $category_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        $category = Category::find($category_id);

        if (is_null($category)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_CATEGORY_NOT_EXIST',
                'data' => ''
            ], 404);
        }

        $category = Category::find($category_id);

        $category->delete();

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }
}
