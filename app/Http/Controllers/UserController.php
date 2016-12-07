<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\User;
use Auth;
use Request;

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
    	$user->password = bcrypt($req->password);
    	$user->save();

    	return redirect('goto/backend/user/show');
    }
    public function show(){
    	$users = User::all();
    	return view('backend.users.show', compact('users'));
    }

    public function edit($id){
    	$user = User::find($id);
    	return view('backend.users.edit', compact('user'));
    }

    public function update($id, UpdateUserRequest $req){
    	$user = User::find($id);
    	$user->name = $req->username;
    	$user->email = $req->email;
    	$user->password = $req->password;
    	$user->save();

    	return redirect('goto/backend/user/show');

    }

    public function destroy($id){
    	$user = User::find($id);
    	$user->delete();
    	return redirect('goto/backend/user/show');
    }

    public function updateAccount(){

        if(Request::ajax()){
            $name = Request::get('username');
            $check = User::where('name',$name)->first();
            if(!$check){
                $user = User::find(Auth::user()->id);
                $user->name = $name;
                $user->save();
                return 'success';
            }

            return 'existsed';
        }
    }

    public function updateEmail(){

        if(Request::ajax()){
            $email = Request::get('email');
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $check = User::where('email', $email)->first();
                if(!$check){
                    $user = User::find(Auth::user()->id);
                    $user->email = $email;
                    $user->save();

                    return 'success';
                }
                else
                     return 'existsed';
            }

            return 'notEmail';
        }
    }
    public function updatePassword(Request $req){
         if(Request::ajax()){
            $oldpass = Request::get('oldpass');
            $newpass = Request::get('newpass');
            $repass = Request::get('repass');
            
           if (Auth::attempt(['password' => $oldpass])) {
                
                if(strlen($newpass) > 3){
                    if($newpass == $repass){
                        $user = User::find(Auth::user()->id);
                        $user->password = Hash::make($newpass);
                        $user->save();
                        return 'success';
                    }
                    else
                        return 'notmath';
                }
                else{
                    return 'tooshort';
                }
            }
            return 'wrongpass';
        }
    }
}
