<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cates;
use App\Events;
use  App\User;
use  App\Restaurant;
use  App\EventRestaurant;

class BackendController extends Controller
{
    public function dashboard(){
    	$cates = Cates::orderBy('id', 'DESC')->get();
    	$eventTypes = Events::orderBy('id', 'DESC')->get();
    	$users = User::orderBy('id', 'DESC')->get();
    	$rests = Restaurant::orderBy('id', 'DESC')->get();
    	$eRests = EventRestaurant::orderBy('id', 'DESC')->get();
    	return view('backend.dashboard.dashboard', compact('cates', 'eventTypes', 'users', 'rests', 'eRests'));
    }
}
