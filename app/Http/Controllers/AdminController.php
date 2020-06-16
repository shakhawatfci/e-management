<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,Validator,Hash,Session;
use App\User;

class AdminController extends Controller
{
    // setting password 

   	public function changePassword(){
      return view('setting.change_password');
  	}

  	public function PostPassword(Request $request){

      	if(Auth::check()){
       		$validator = Validator::make($request->all(),[

	        'old_password'=>'required',
	        'password'=>'required|min:6|confirmed'
	        // 'password_confirmation'=>'required|min:6'
     	]);

	       if($validator->fails()){

	           return redirect()->back()->withErrors($validator);

	       }

	       $old_pass =$request->old_password;
	       $check = User::where('id','=',Auth::user()->id)->first();

	       if (Hash::check($request->old_password,$check->password)){

	           $check->password = Hash::make($request->password);

	           $check->save();

	           Session::flash('success','Password Change Success');

	           return redirect()->route('/home');   

	       }
	       else{

	        Session::flash('warning','Old Password Not mathced');
	        return redirect()->back();
	    	}


		}
		else{

		  Session::flash('warning','You are not logged in');

		  return redirect('/');

		}
	}
}
