<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();
		$this->call('IoTInputSeed');
		$this->command->info('board_inputs table seeded!');

		// $this->call('UserTableSeeder');
	}
}

class IoTInputSeed extends Seeder {
	public function run(){
    	// for($x = 1; $x < 5; $x++){
    	// 	DB::table('board_inputs')
    	// 		->insert(array(
    	// 					'user_input' 	=> 'Analog A'.$x.'',
    	// 					'board_input'	=> 'A'.$x.''
    	// 				));
    	// }
	}	    
}
