<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublishController extends Controller
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
            'data' => Publish::all()
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
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_FIELD_MISSING',
                'data' => ''
            ]);
        }

        $isExist = Publish::where('name', $request->get('name'))->first();

        if (!is_null($isExist)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_PUBLISH_IS_EXIST',
                'data' => ''
            ]);
        }

        $publish = Publish::create($request->all());

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => $publish->id
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $publish_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $publish_id)
    {
        $validator = Validator::make($request->all(), ['name' => 'required']);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_FIELD_MISSING',
                'data' => ''
            ]);
        }

        $publish = Publish::find($publish_id);

        if (is_null($publish)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_PUBLISH_NOT_EXIST',
                'data' => ''
            ]);
        }

        $publish->update($request->all());

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $publish_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($publish_id)
    {
        $publish = Publish::find($publish_id);

        if (is_null($publish)) {
            return response()->json([
                'success' => false,
                'msg' => 'MSG_PUBLISH_NOT_EXIST',
                'data' => ''
            ]);
        }

        $publish->delete();

        return response()->json([
            'success' => true,
            'msg' => '',
            'data' => ''
        ]);
    }
}
