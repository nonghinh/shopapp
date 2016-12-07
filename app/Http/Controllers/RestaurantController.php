<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Restaurant;
use File;
use LRedis;
use Auth;

class RestaurantController extends Controller
{
    public function index(){
        $rests = Restaurant::orderBy('id', 'DESC')->get();
        return view('backend.restaurant.index', compact('rests'));
    }

    public function addRestaurant(){

        if(Auth::check()){
    	   return view('frontend.restaurant.add');
        }

        return redirect('/dang-nhap');
    }
    public function doAddRestaurant(RestaurantRequest $req){
    	
        $rest = new Restaurant;
        $rest->name = $req->name;
        $rest->slug = toSlug($req->name);
        $rest->address = $req->address;
        $rest->user_id = Auth::user()->id;
        $rest->email = !empty($req->email) ? $req->email : '';
        $rest->phone = !empty($req->phone) ? $req->phone : '';
        $rest->website = !empty($req->website) ? $req->website : '';
        $rest->description_place = !empty($req->description_place) ? $req->description_place : '';
        $rest->location = !empty($req->location) ? $req->location : geocodeLocation($req->address);
        $rest->capacity = !empty($req->capacity) ? $req->capacity : 0;
        $rest->opening_time = $req->opening_time_hours.':'.$req->opening_time_minute;
        $rest->closing_time = $req->closing_time_hours.':'.$req->closing_time_minute;
        $rest->last_order_time = $req->last_order_time_hours.':'.$req->last_order_time_minute;
        $rest->min_price = !empty($req->min_price) ? $req->min_price : 0;
        $rest->max_price = !empty($req->max_price) ? $req->max_price : 0;
        $image = null;
        if(!empty($req->file('cover_image'))){
        	$image = $req->file('cover_image');
        	$imgname = titleSlug($req->name).'-'.time().'.'.$image->getClientOriginalExtension();
        	$rest->cover_image = $imgname;
        	$image->move('upload/covers/', $imgname);
        }

        $location = !empty($req->location) ? $req->location : geocodeLocation($req->address);
        if($location){
            $rest->save();
            $query = Restaurant::orderBy('id', 'DESC')->first(); 
            list($lat, $lng) = explode(",", $location);

            $data = [
                'id' => $query->id,
                'name' => $req->name,
                'slug' => toSlug($req->name),
                'address' => $req->address,
                'user' => Auth::user()->name,
                'cover_image' => $imgname,
                'email' => $req->email,
                'phone' => $req->phone,
                'website' => $req->website,
                'description' => $req->description,
                'lat' => $lat,
                'lng' => $lng,
                'capacity' => $req->capacity,
                'opening_time' => $req->opening_time_hours.':'.$req->opening_time_minute,
                'closing_time' => $req->closing_time_hours.':'.$req->closing_time_minute,
                'last_order_time' => $req->last_order_time_hours.':'.$req->last_order_time_minute,
                'min_price' => !empty($req->min_price) ? $req->min_price : 0,
                'max_price' => !empty($req->max_price) ? $req->max_price : 0
            ];
            
            $jsonData = json_encode($data);
            
            $redis = LRedis::connection();
            $redis->publish('new_location', $jsonData);
            return redirect('/');
        }
        return redirect()->back()->with('error_address', 'Địa chỉ có vẻ không hợp lệ, vui lòng nhập địa chỉ thật');
    }
    public function show($id){
        // $rests = Restaurant::where('user_id');

        // return view('frontend.userprofile.show');
    }
    public function edit($slug, $id){
        $rest = Restaurant::find($id);
        return view('frontend.restaurant.edit', compact('rest'));
    }
    public function update($slug, $id, UpdateRestaurantRequest $req){
        $rest = Restaurant::find($id);
        /*----GET old data----*/
        $oldLoc = $rest->location;
        /*---End get old data-----*/
        $rest->name = $req->name;
        $rest->slug = toSlug($req->name);
        $rest->address = $req->address;
        $rest->user_id = Auth::user()->id;
        $rest->email = !empty($req->email) ? $req->email : '';
        $rest->phone = !empty($req->phone) ? $req->phone : '';
        $rest->website = !empty($req->website) ? $req->website : '';
        $rest->description_place = !empty($req->description_place) ? $req->description_place : '';
        $rest->location = !empty($req->location) ? $req->location : geocodeLocation($req->address);
        $rest->capacity = !empty($req->capacity) ? $req->capacity : 0;
        $rest->opening_time = $req->opening_time_hours.':'.$req->opening_time_minute;
        $rest->closing_time = $req->closing_time_hours.':'.$req->closing_time_minute;
        $rest->last_order_time = $req->last_order_time_hours.':'.$req->last_order_time_minute;
        $rest->min_price = !empty($req->min_price) ? $req->min_price : 0;
        $rest->max_price = !empty($req->max_price) ? $req->max_price : 0;
        $image = null;
        $curr_img = 'upload/covers/'.$rest->cover_image;
        if(!empty($req->file('cover_image'))){
            $image = $req->file('cover_image');
            $imgname = titleSlug($req->name).'-'.time().'.'.$image->getClientOriginalExtension();
            $rest->cover_image = $imgname;
            $image->move('upload/covers/', $imgname);

            if(File::exists($curr_img)){
                File::delete($curr_img);
            }
        }
        $location = !empty($req->location) ? $req->location : geocodeLocation($req->address);
        if($location){
            $rest->save();
            $query = Restaurant::orderBy('id', 'DESC')->first(); 
            list($lat, $lng) = explode(",", $location);
            list($old_lat, $old_lng) = explode(",", $oldLoc);

            $data = [
                'id' => $query->id,
                'name' => $req->name,
                'slug' => toSlug($req->name),
                'address' => $req->address,
                'user' => Auth::user()->name,
                'cover_image' => $query->cover_image,
                'email' => $req->email,
                'phone' => $req->phone,
                'website' => $req->website,
                'description' => $req->description,
                'lat' => $lat,
                'lng' => $lng,
                'capacity' => $req->capacity,
                'opening_time' => $req->opening_time_hours.':'.$req->opening_time_minute,
                'closing_time' => $req->closing_time_hours.':'.$req->closing_time_minute,
                'last_order_time' => $req->last_order_time_hours.':'.$req->last_order_time_minute,
                'min_price' => !empty($req->min_price) ? $req->min_price : 0,
                'max_price' => !empty($req->max_price) ? $req->max_price : 0,
                'old_lat' => $old_lat,
                'old_lng' => $old_lng
            ];
            
            $jsonData = json_encode($data);
            
            $redis = LRedis::connection();
            $redis->publish('update_location', $jsonData);
            return redirect('/userprofile')->with('message', 'Đã cập nhật xong.');
        }
        return redirect()->back()->with('error_address', 'Địa chỉ có vẻ không hợp lệ, vui lòng nhập địa chỉ thật');
    }

    public function destroy($slug, $id){
        $rest = Restaurant::find($id);
        $latLng = $rest->location;
        $rest->delete();
        $redis = LRedis::connection();
        list($lat, $lng) = explode(",", $latLng);

        $data = [
            'id' => $id,
            'lat' => $lat,
            'lng' => $lng
        ];

        $redis->publish('delete_location', json_encode($data));
        return redirect()->back()->with('message', 'Đã xóa xong.');
    }
}
