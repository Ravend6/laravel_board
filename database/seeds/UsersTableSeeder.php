<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\User::class, 1)->create();
        DB::table('users')->insert([
            'role_id' => 3,
            'name' => 'root',
            'email' => 'root@email.com',
            'password' => bcrypt('qwerty'),
            'email_confirm' => true,
            'count' => 19,
            'gender' => 1,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('users')->insert([
            'role_id' => 3,
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => bcrypt('qwerty'),
            'email_confirm' => true,
            'count' => 19,
            'gender' => 1,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('users')->insert([
            'role_id' => 4,
            'name' => 'vova',
            'email' => 'vova@email.com',
            'password' => bcrypt('qwerty'),
            'email_confirm' => true,
            'count' => 19,
            'gender' => 1,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        DB::table('users')->insert([
            'role_id' => 4,
            'name' => 'bob',
            'email' => 'bob@email.com',
            'password' => bcrypt('qwerty'),
            'email_confirm' => true,
            'count' => 19,
            'gender' => 1,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
    }
}
