<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelompokController extends Controller
{
    public function index()
    {
        $data = Kelompok::orderBy('id', 'desc')->with('desa')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        $data = Kelompok::with('desa')->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Kelompok not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desa_id' => 'required',
            'koordinator' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 400);
        }

        $data = Kelompok::create([
            'name' => $request->input('name'),
            'desa_id' => $request->input('desa_id'),
            'koordinator' => $request->input('koordinator'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kelompok created successfully',
            'data' => $data
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desa_id' => 'required',
            'koordinator' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 400);
        }

        $blog = Kelompok::find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Kelompok not found',
            ], 404);
        }

        $blog->update(
            [
                'name' => $request->input('name'),
                'desa_id' => $request->input('desa_id'),
                'koordinator' => $request->input('koordinator')
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Kelompok updated successfully',
            'data' => $blog
        ], 200);
    }

    public function destroy($id) {
        $data = Kelompok::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Kelompok not found',
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kelompok deleted successfully'
        ]);
    }
}
