<?php

class Task extends Eloquent {


	//public $timestamps = false;

	protected $fillable = ['name', 'description', 'project_id'];
	//use UserTrait, RemindableTrait;

	public static $add_task_form_rules = [
		'name'	 		    => 'required',
		'project_id'        => 'required',
	];

	public static $update_task_form_rules = [
		'name'	 		    => 'required',
		'project_id'        => 'required',
		'completed'			=> 'required'
	];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}
