<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cates;
use App\Http\Requests\CateRequest;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Cates::all();
        return view('backend.cates.add', compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CateRequest $request)
    {
        $cates = Cates::all();
        $cate = new Cates;
        $cate->name = $request->catename;
        $cate->slug = toSlug($request->catename);
        $cate->parent_id = $request->parent_id;
        $cate->save();
        return redirect('goto/backend/cate/show')->with(['flash_level'=>'success', 'flash_message'=>'Added an item success!']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cates = Cates::all();
        return view('backend.cates.show', compact('cates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $cate = Cates::find($id);
        $cates = Cates::where('id', '<>', $id)->get();
        return view('backend.cates.edit', compact('cates', 'cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'catename' => 'required|unique:categories,name,'.$id,
        ]);

        $cate = Cates::find($id);
        $cate->name = $request->catename;
        $cate->slug = toSlug($request->catename);
        $cate->parent_id = $request->parent_id;
        $cate->save();

        return redirect('goto/backend/cate/show')->with(['flash_level'=>'success', 'flash_message'=>'Updated success!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate = Cates::find($id);
        $cate->delete();
        return redirect('goto/backend/cate/show')->with(['flash_level'=>'success', 'flash_message'=>'Deleted an item success!']);
    }
}
