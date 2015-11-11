<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTableCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('parent_category')->unsigned()->nullable();
			$table->string('title');
			$table->string('subtitle');
			$table->integer('weight');
			$table->string('bg_color'); // not part of vendor
			$table->string('slug');			// not part of vendor
		});

		DB::table('forum_categories')->insert(
			array(
				['parent_category' => null, 'title' => 'Health', 										'subtitle' => '',
				'weight' => 0, 'bg_color' => '0D8E56', 'slug' => 'health'],
				['parent_category' => null, 'title' => 'Science & Environment', 		'subtitle' => '',
				'weight' => 0, 'bg_color' => '1D73A3', 'slug' => 'science'],
				['parent_category' => null, 'title' => 'EM Practitioner & Response','subtitle' => '',
				'weight' => 0, 'bg_color' => 'DB9421', 'slug' => 'response'],
				['parent_category' => null, 'title' => 'Civil & Cyber Security', 		'subtitle' => '',
				'weight' => 0, 'bg_color' => '848889', 'slug' => 'security'],
				['parent_category' => null, 'title' => 'Business Continuity', 			'subtitle' => '',
				'weight' => 0, 'bg_color' => '933131', 'slug' => 'continuity'],
				['parent_category' => null, 'title' => 'NGO & Humanitarian', 				'subtitle' => '',
				'weight' => 0, 'bg_color' => '754293', 'slug' => 'humanitarian'],
				['parent_category' => null, 'title' => 'Category', 								'subtitle' => 'Contains categories and threads',
				'weight' => 0, 'bg_color' => null, 'slug' => null],
				['parent_category' => 7, 		'title' => 'Sub-category', 						'subtitle' => 'Contains threads',
				'weight' => 0, 'bg_color' => null, 'slug' => null],
				['parent_category' => 7, 		'title' => 'Second subcategory', 			'subtitle' => 'Contains more threads',
				'weight' => 1, 'bg_color' => null, 'slug' => null]
			)
		);
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('forum_categories');
	}

}
