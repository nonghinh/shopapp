<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\User;
use Carbon\Carbon;
use LRedis;
use App\Restaurant;
use App\Events;
use App\Cates;
use App\EventRestaurant;
use Auth;

class HomeController extends Controller
{
    public function index(){

        $active = 0;
        if(isset($_GET['slug']) && isset($_GET['id'])){
            $active = $_GET['id'];
        }

        $locations = Restaurant::all();
        $cates = Cates::all();
        $eventType = Events::all();
        $eventR = [];
        $now = Carbon::now();
        foreach($locations as $locate){
            $item = EventRestaurant::where('restaurant_id', $locate->id)->where('start_time','<=', $now)->where('end_time', '>', $now)->first();
            if($item){
                $eventR[] = $item;
            }
        }
        $jsonCates = json_encode($cates);
        $jsonEvent = json_encode($eventR);
        $jsonLocations = json_encode($locations);
        $jsonEventType = json_encode($eventType);

    	return view('frontend.home', compact('jsonLocations', 'jsonEvent', 'jsonEventType', 'jsonCates', 'active'));
    }

    public function register(){
    	if(Auth::guest()){
            return view('frontend.register');
        }

        return redirect()->back();
    }

    public function doRegister(RegisterRequest $req){
    	$user = new User;
    	$user->name = $req->username;
    	$user->email = $req->email;
    	$user->password = bcrypt($req->password);
    	$user->level = 0;
    	$user->save();

    	return 'ok';
    }

    public function login(){
    	if(Auth::guest()){
            return view('frontend.login');
        }

        return redirect()->back();
    }
    public function doLogin(LoginRequest $req){

    		$email = $req->email;
    		$password = $req->password;
    	if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            if(Auth::user()->level == 2)
            	return redirect('/goto/backend/dashboard');
            return redirect('/');
        }
        else
            return redirect()->back()->with('error_login','Email hoặc mật khẩu không chính xác.');
    }

    public function logout(){

    	Auth::logout();
    	return redirect('/');
    }

    public function userprofile(){
        $user = User::find(Auth::user()->id);
        $rests = Restaurant::where('user_id', Auth::user()->id)->get();
        $now = Carbon::now();
        $eventR = EventRestaurant::where('start_time', '<=', $now)->where('end_time', '>', $now)->get();
        
        return view('frontend.user.userprofile', compact('user', 'rests'));
    }

    public function searchCate($slug, $id){

        $active = 0;
        if(isset($_GET['slug']) && isset($_GET['id'])){
            $active = $_GET['id'];
        }
        $locations = Restaurant::all();
        $cates = Cates::find($id);
        $eventType = Events::all();
        $eventR = [];
        $now = Carbon::now();
        foreach($locations as $locate){
            $item = EventRestaurant::where('restaurant_id', $locate->id)->where('start_time','<=', $now)->where('end_time', '>', $now)->where('cate_id', $id)->first();
            if($item){
                $eventR[] = $item;
            }
        }
        $jsonCates = json_encode($cates);
        $jsonEvent = json_encode($eventR);
        $jsonLocations = json_encode($locations);
        $jsonEventType = json_encode($eventType);

        return view('frontend.home', compact('jsonLocations', 'jsonEvent', 'jsonEventType', 'jsonCates', 'active'));
    }

    public function searchEvent($slug, $id){
        $active = 0;
        if(isset($_GET['slug']) && isset($_GET['id'])){
            $active = $_GET['id'];
        }
        $locations = Restaurant::all();
        $cates = Cates::find($id);
        $eventType = Events::all();
        $eventR = [];
        $now = Carbon::now();
        foreach($locations as $locate){
            $item = EventRestaurant::where('restaurant_id', $locate->id)->where('start_time','<=', $now)->where('end_time', '>', $now)->where('event_id', $id)->first();
            if($item){
                $eventR[] = $item;
            }
        }
        $jsonCates = json_encode($cates);
        $jsonEvent = json_encode($eventR);
        $jsonLocations = json_encode($locations);
        $jsonEventType = json_encode($eventType);

        return view('frontend.home', compact('jsonLocations', 'jsonEvent', 'jsonEventType', 'jsonCates', 'active'));
    }

    public function findNearestLocaion(){
        $sql = "SELECT *, ( 3959 * acos( cos( radians(37) ) * cos( radians( lat ) ) * 
            cos( radians( lng ) - radians(-122) ) + sin( radians(37) ) * 
            sin( radians( lat ) ) ) ) AS distance FROM your_table_name HAVING
            distance < 25 ORDER BY distance LIMIT 0 , 20;";
        $data = DB::select(DB::raw($sql))->get();
    }

    public function getDataSearch(){
        if(Request::ajax()){
            $query = Request::get('query');
            $data = Restaurant::where('name', 'LIKE', '%'.$query.'%')->orWhere('address', 'LIKE', '%'.$query.'%')->orderBy('id', 'DESC')->skip(0)->take(5)->get();

            return view('frontend.data.dataSearch', compact('data'));
        }
    }

    public function serachLocation(){

        $locations = Restaurant::all();
        $cates = Cates::all();
        $eventType = Events::all();
        $eventR = [];
        $now = Carbon::now();
        foreach($locations as $locate){
            $item = EventRestaurant::where('restaurant_id', $locate->id)->where('start_time','<=', $now)->where('end_time', '>', $now)->first();
            if($item){
                $eventR[] = $item;
            }
        }
        $jsonCates = json_encode($cates);
        $jsonEvent = json_encode($eventR);
        $jsonLocations = json_encode($locations);
        $jsonEventType = json_encode($eventType);
    }
}
