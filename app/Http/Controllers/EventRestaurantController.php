<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRestaurantRequest;
use App\Http\Requests\UpdateEventRestaurantRequest;
use Auth;
use LRedis;
use Carbon\Carbon;
use App\Restaurant;
use App\Events;
use App\Cates;
use App\EventRestaurant;
class EventRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventR = EventRestaurant::orderBy('id', 'DESC')->get();
        // $now = Carbon::now();
        // $eventNow  = EventRestaurant::where('start_time', '<', $now)where('end_time', '>', $now)->orderBy('id', 'DESC')->get();
        return view('backend.eventrest.index', compact('eventR'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cates = Cates::all();
        $events = Events::all();
        if(Auth::user()->level == 2){
            $rests = Restaurant::all();
        }
        else
            $rests = Restaurant::where('user_id', Auth::user()->id)->get();
        return view('frontend.event.add', compact('rests', 'cates', 'events'));
    }

    
    public function store(EventRestaurantRequest $req)
    {
        $eventR = new EventRestaurant;
        $eventR->name  = $req->name;
        $eventR->slug  = toSlug($req->name);
        $eventR->user_id = Auth::user()->id;
        $eventR->restaurant_id  = $req->restaurant_id;
        $eventR->cate_id  = $req->cate_id;
        $eventR->event_id  = $req->event_id;
        $eventR->info_event  = $req->event_info;
        $eventR->start_time = getDateTime($req->start_time);
        $eventR->end_time = getDateTime($req->end_time);
        $eventR->save();
        $redis = LRedis::connection();
        $new = EventRestaurant::orderBy('id', 'DESC')->first();
        $data = [
            'id' => $new->id,
            'name' => $req->name,
            'slug' => toSlug($req->name),
            'user_id' => Auth::user()->id,
            'restaurant_id' => $req->restaurant_id,
            'cate_id' => $req->cate_id,
            'event_id' => $req->event_id,
            'info_event'  => $req->event_info,
            'start_time'  => $req->start_time.':00',
            'end_time'  => $req->end_time.':00'
        ];

        $jsonData = json_encode($data);
        $redis->publish('new_event', $jsonData);
        
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $now = Carbon::now();
        $eventY = EventRestaurant::where('user_id', Auth::user()->id)->where('end_time', '>', $now)->get();
        $eventR = EventRestaurant::where('user_id', '<>', Auth::user()->id)->where('start_time', '<=', $now)->where('end_time', '>', $now)->get();
        $eventF = EventRestaurant::where('start_time', '>', $now)->where('end_time', '>', $now)->get();
        return view('frontend.event.show', compact('eventR', 'eventY', 'eventF'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {   
        $cates = Cates::all();
        $events = Events::all();
        $rests = Restaurant::where('user_id', Auth::user()->id)->get();
        $eventR = EventRestaurant::find($id);
        
        return view('frontend.event.edit', compact('events', 'cates', 'rests', 'eventR'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRestaurantRequest $req, $slug, $id)
    {
        $eventR = EventRestaurant::find($id);
        $eventR->name  = $req->name;
        $eventR->slug  = toSlug($req->name);
        $eventR->user_id = Auth::user()->id;
        $eventR->restaurant_id  = $req->restaurant_id;
        $eventR->cate_id  = $req->cate_id;
        $eventR->event_id  = $req->event_id;
        $eventR->info_event  = $req->event_info;
        $eventR->start_time  = $req->start_time.':00';
        $eventR->end_time  = $req->end_time.':00';
        $eventR->save();

        $redis = LRedis::connection();
        $data = [
            'id' => $id,
            'name' => $req->name,
            'slug' => toSlug($req->name),
            'user_id' => Auth::user()->id,
            'restaurant_id' => $req->restaurant_id,
            'cate_id' => $req->cate_id,
            'event_id' => $req->event_id,
            'info_event'  => $req->event_info,
            'start_time'  => $req->start_time.':00',
            'end_time'  => $req->end_time.':00'
        ];

        $jsonData = json_encode($data);
        $redis->publish('update_event', $jsonData);
        
        return redirect('ds-su-kien')->with('message', 'Đã cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        $eventR = EventRestaurant::find($id);
        $rest = Restaurant::where('id',$eventR->restaurant_id)->first();
        $eventR->delete();
        list($lat, $lng) = explode(",", $rest->location);
        $data = [
            'lat' => $lat,
            'lng' => $lng,
            'id' => $id
        ];
        $redis = LRedis::connection();
        $redis->publish('delete_event', json_encode($data));
        return redirect()->back()->with('message', 'Đã xóa thành công.');
    }
}
