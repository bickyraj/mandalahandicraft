<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        	DB::table('users')->insert([
        		'name'       => 'Weathubs',
        		'email'      => 'admin@admin.com',
        		'password'   => bcrypt('admin'),
        		'address'    => 'Balkot, Bhaktapur',
        		'phone'      => '966067450x',
        		'dob'        => \Carbon\Carbon::now(),
        		'verified'   => 1,
                'status'     => 1,
        		'auth_token' => str_random(250),
        		'created_at' => \Carbon\Carbon::now(),
        		'updated_at' => \Carbon\Carbon::now(),
        	]);

        	$roles = ['admin', 'normal', 'vendor','wseller'];
        	foreach ($roles as $role) {
        		DB::table('roles')->insert([
        			'name'       => $role,
        			'created_at' => \Carbon\Carbon::now(),
        			'updated_at' => \Carbon\Carbon::now(),
        		]);
        	}

        	// role user
        	DB::table('role_user')->insert([
        		'user_id'    => 1,
        		'role_id'    => 1,
        		'created_at' => \Carbon\Carbon::now(),
        		'updated_at' => \Carbon\Carbon::now(),
        	]);

        	DB::table('companies')->insert([
        		'name'             => config('app.name'),
        		'email'            => 'wearhubs@gmail.com',
        		'established_date' => date('Y-m-d h:i:s'),
        		'address'          => 'Balkot, Bhaktapur',
        		'phone'            => '9849604410',
        		'created_at'       => \Carbon\Carbon::now(),
        		'updated_at'       => \Carbon\Carbon::now(),
        	]);
        }
    }

