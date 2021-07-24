<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
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
            'data' => Author::all()
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
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_FIELD_MISSING',
                'data' => ''
            ], 400);
        }

        $authorIsExist = Author::where([
                ['firstname', '=', $request->get('firstname')],
                ['lastname', '=', $request->get('lastname')]
            ])->count() > 0;

        if ($authorIsExist) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_AUTHOR_IS_EXIST',
                'data' => ''
            ], 409);
        }

        $author = Author::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname')
        ]);

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => $author->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $author_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $author_id)
    {
        $author = Author::find($author_id);

        if (is_null($author)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_AUTHOR_NOT_EXIST',
                'data' => ''
            ], 404);
        }

        $author->update([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname')
        ]);

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $author_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($author_id)
    {
        $author = Author::find($author_id);

        if (is_null($author)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_AUTHOR_NOT_EXIST',
                'data' => ''
            ], 404);
        }

        $author->delete();

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }
}
