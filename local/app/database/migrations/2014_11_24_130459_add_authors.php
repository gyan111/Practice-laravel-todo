<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::table('authors')->insert(array(
			'name' => 'Jnana',
			'bio'  => 'Some data about author Jnana',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));
		DB::table('authors')->insert(array(
			'name' => 'author 2',
			'bio'  => 'Some data about author Jnana',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::table('authors')->where('name', '=', 'Jnana')->delete();
	}

}
