<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        ## Read POST data 
        $id = $request->post('id');

        $empdata = Blog::find($id);

        $response = array();
        if (!empty($empdata)) {

            $response['title'] = $empdata->title;
            $response['description'] = $empdata->description;
            $response['content'] = $empdata->content;
            $response['success'] = 1;
        } else {
            $response['success'] = 0;
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        ## Read POST data
        $id = $request->post('id');

        $empdata = Blog::find($id);

        $response = array();
        if (!empty($empdata)) {
            $updata['title'] = $request->post('title');
            $updata['description'] = $request->post('description');
            $updata['content'] = $request->post('content');

            if ($empdata->update($updata)) {
                $response['success'] = 1;
                $response['msg'] = 'Update successfully';
            } else {
                $response['success'] = 0;
                $response['msg'] = 'Record not updated';
            }
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $empdata = Blog::find($id);

        if ($empdata->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.' + $id;
        }

        return response()->json($response);
    }
}
