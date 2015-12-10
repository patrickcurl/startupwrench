<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
class UserController extends Controller
{
	public function __construct(){
		$this->middleware('auth', ['except' => ['getTest', 'getSetup', 'postSetup']]);
	}

public function getTest(){
	return Auth::user()->provider;
}

public function getSetup(){
	$user = Auth::user();
	return view('users.setup')->with('user', $user);
	// return Auth::user()->email;
}

public function postSetup(Request $request)
{
	$this->validate($request, [
			'password' => 'required|confirmed',
		]);
	$credentials= $request->only(
			'email', 'password', 'password_confirmation'
		);
	$user = Auth::user();
	$user->email = $credentials['email'];
	$user->password = bcrypt($credentials['password']);
	if($user->save()){
		return redirect('/');
	}
	
}


}