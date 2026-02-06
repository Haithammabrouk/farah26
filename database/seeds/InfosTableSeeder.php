<?php

use Illuminate\Database\Seeder;

class InfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$infos = [
    		[
	        	'key' => 'address',
	        	'value' => '12, Moaez Al Dawla St. Makram Ebeid, Egypt',
	        ],
    		[
	        	'key' => 'email',
	        	'value' => 'info@farahnilecruise.com',
	        ],
    		[
	        	'key' => 'phone',
	        	'value' => '+20 2 22731921',
	        ],
    		[
	        	'key' => 'facebook',
	        	'value' => 'https://www.facebook.com',
	        ],
    		[
	        	'key' => 'twitter',
	        	'value' => 'https://www.twitter.com',
	        ],
    		[
	        	'key' => 'instagram',
	        	'value' => 'https://www.instagram.com',
	        ],
    		[
	        	'key' => 'tripadvisor',
	        	'value' => 'https://www.tripadvisor.com',
	        ],
    	];

    	foreach ($infos as $info) {
	        DB::table('infos')->insert([
	        	'key' => $info['key'],
	        	'value' => $info['value'],
	        	'created_at' => now(),
	        	'updated_at' => now(),
	        ]);
    	}
    }
}
