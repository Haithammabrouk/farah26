<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		'Privacy Policy',
    		'Terms & Conditions',
    		'Cookies',
    		'Copyrights',
    	];

    	foreach ($data as $value) {
	    	Page::create([
	    		'en' => [
		            'name' => $value,
		            'content' => $value
		        ]
	    	]);
    	}
    }
}
