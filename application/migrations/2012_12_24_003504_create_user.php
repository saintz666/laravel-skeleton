<?php

class Create_User {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->create();
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_me')->nullable();
			$table->string('activation_hash')->nullable();
			$table->string('ip_address')->nullable();
			$table->string('activated')->nullable();
			$table->text('permissions')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->timestamps();
		});

		// Create user metadata table
		Schema::table('profiles', function($table) {
			if (Config::get('database.default')=='mysql')
				$table->engine = 'InnoDB';
			$table->create();
			$table->integer('user_id')->unsigned();
			$table->primary('user_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->date('birth_date');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->on_delete('cascade')->on_update('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}