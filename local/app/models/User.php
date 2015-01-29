<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface; 

class User extends Eloquent implements UserInterface, RemindableInterface {


	//public $timestamps = false;

	protected $fillable = ['firstname', 'lastname', 'username', 'email', 'phone', 'country', 'image', 'password'];
	use UserTrait, RemindableTrait;

	public static $registration_form_rules = [
		'firstname'	 		    => 'required',
		'lastname' 	    	    => 'required',
		'username' 	    	    => 'required|unique:users',
		'email'    	 			=> 'required|email|unique:users',
		'country'  	 	  		=> 'required',
		'password'	 	  		=> 'required|alphaNum|min:3|confirmed',
		//'password_confirmation' => 'required|Matchpass:' . $registration_data['password'],
		'password_confirmation' => 'required',
		'image'            		=> 'image|mimes:jpeg,jpg,bmp,png,gif',
	];

	public static $update_form_rules = [
		'firstname'	 		    => 'required',
		'lastname' 	    	    => 'required',
		'username' 	    	    => 'required|unique:users',
		'email'    	 			=> 'required|email|unique:users',
		//'email'    	 			=>'required|email|unique:users,email,' . Input::get['email']
		'country'  	 	  		=> 'required',
		'password'	 	  		=> 'alphaNum|min:3|confirmed',
		//'password_confirmation' => 'Matchpass:'. $postData['password']
	];

	public static $login_form_rules = array(
				'username' => 'required', 
				'password' => 'required|alphaNum|min:3'
				);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
