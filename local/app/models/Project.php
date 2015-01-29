<?php

class Project extends Eloquent {


	//public $timestamps = false;

	protected $fillable = ['name', 'description', 'user_id'];
	//use UserTrait, RemindableTrait;

	public static $add_project_form_rules = [
		'name'	 		    => 'required',
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
