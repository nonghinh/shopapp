<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use App\Http\Requests\EventRequest;
use File;

class EventController extends Controller
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
        return view('backend.events.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = new Events;
        $event->name = $request->eventname;
        $event->slug = toSlug($request->eventname);
        if(!empty($request->file('eventicon'))){
            $image = $request->file('eventicon');
            $filename = titleSlug($request->eventname).'-'.time().'.'.$image->getClientOriginalExtension();
            $event->icon = $filename;
            $image->move('upload/event/', $filename);
        }
        $event->save();

        return redirect('goto/backend/event/show')->with(['flash_level'=>'success', 'flash_message'=>'Added new item success!']);
    }

    public function show()
    {
        $events = Events::all();
        return view('backend.events.show', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Events::find($id);
        return view('backend.events.edit', compact('event'));
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
        $event = Events::find($id);
        $this->validate($request, [
            'eventname' => 'required|unique:event_types,name,'.$id,
        ]);
        $event->name = $request->eventname;
        $curr_img = 'upload/event/'.$event->icon;
        if(!empty($request->file('eventicon'))){
            $image = $request->file('eventicon');
            $filename = titleSlug($request->eventname).'-'.time().'.'.$image->getClientOriginalExtension();
            $event->icon = $filename;
            $image->move('upload/event/', $filename);

            if(File::exists($curr_img)){
                File::delete($curr_img);
            }
        }

        $event->save();

        return redirect('goto/backend/event/show')->with(['flash_level'=>'success', 'flash_message'=>'Updates an item success!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Events::find($id);
        $icon = 'upload/event/'.$event->icon;
        if(File::exists($icon)){
                File::delete($icon);
            }
        $event->delete();
        return redirect('goto/backend/event/show')->with(['flash_level'=>'success', 'flash_message'=>'Deleted an item success!']);
    }
}
