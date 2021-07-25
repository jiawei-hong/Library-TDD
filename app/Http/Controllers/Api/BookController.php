<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Publish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
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
            'data' => Book::all()
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'author_id' => 'required',
            'publish_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_FIELD_MISSING',
                'data' => ''
            ]);
        }

        $isExist = Book::where('name', $request->get('name'))->first();

        if (!is_null($isExist)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_BOOK_IS_EXIST',
                'data' => ''
            ]);
        }

        $book = Book::create($request->all());

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => $book->id
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $book_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book_id)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_FIELD_MISSING',
                'data' => ''
            ]);
        }

        $book = Book::find($book_id);

        if (is_null($book)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_BOOK_NOT_EXIST',
                'data' => ''
            ]);
        }

        $book->update($request->all());

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $book_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($book_id)
    {
        $book = Book::find($book_id);

        if (is_null($book)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_BOOK_NOT_EXIST',
                'data' => ''
            ]);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }
}
