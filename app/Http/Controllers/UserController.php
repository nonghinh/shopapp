<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    //
    public function create(){
    	return view('backend.users.add');
    }
    public function store(UserRequest $req){
    	$user = new User;
    	$user->name = $req->username;
    	$user->email = $req->email;
    	$user->password = $req->password;
    	$user->save();

    	return redirect('goto/backend/users/show');
    }
    public function show(){
    	$users = User::all();
    	return view('backend.users.show', compact('users'));
    }

    public function edit($id){
    	$user = User::find($id);
    	return view('backend.users.edit', compact('user'));
    }

    public function update($id, Request $req){
    	$user = User::find($id);

    	$this->validate($req, [
    		'username' => 'required|min:3|unique:users,name,'.$id,
    		'email' => 'required|email|unique:users,email,'.$id,
    		'password' => 'required|min:6',
    		'password_again'=> 'same:password'
    		]);
    	$user->name = $req->username;
    	$user->email = $req->email;
    	$user->password = $req->password;
    	$user->save();

    	return redirect('goto/backend/user/show');

    }

    public function delete($id){
    	$user = User::find($id);
    	$user->delete();
    	return redirect('goto/backend/user/show');
    }
}
