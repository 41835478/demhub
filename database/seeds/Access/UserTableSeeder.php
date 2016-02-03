<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as Carbon;

class UserTableSeeder extends Seeder {

	public function run() {

		if(env('DB_DRIVER') == 'mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		if(env('DB_DRIVER') == 'mysql')
			DB::table(config('auth.table'))->truncate();
		elseif(env('DB_DRIVER') == 'sqlite')
			DB::statement("DELETE FROM ".config('auth.table'));
		else //For PostgreSQL or anything else
			DB::statement("TRUNCATE TABLE ".config('auth.table')." CASCADE");

		//Add the master administrator, user id of 1
		$users = [
			[
				'user_name' => 'DEMHUB',
				'first_name' => 'DEMHUB',
				'last_name' => 'NETWORK',
				'email' => 'demhubcontact@gmail.com',
				'password' => bcrypt('password'),
				'confirmation_code' => md5(uniqid(mt_rand(), true)),
				'confirmed' => true,
				'division' => NULL,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'user_name' => 'aldo',
				'first_name' => 'Aldo',
				'last_name' => 'Ruiz',
				'email' => 'aldo.ruiz.luna@gmail.com',
				'password' => bcrypt('password'),
				'confirmation_code' => md5(uniqid(mt_rand(), true)),
				'confirmed' => true,
				'division' => '|1|3|5|',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
			[
				'user_name' => 'lhaggarty',
				'first_name' => 'Leon',
				'last_name' => 'Haggarty',
				'email' => 'lhaggarty@ryerson.ca',
				'password' => bcrypt('password'),
				'confirmation_code' => md5(uniqid(mt_rand(), true)),
				'confirmed' => true,
				'division' => '|2|4|6|',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now()
			],
		];

		DB::table(config('auth.table'))->insert($users);

		if(env('DB_DRIVER') == 'mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
