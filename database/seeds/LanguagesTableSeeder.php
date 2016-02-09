<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'title' => 'русский',
            'country_code_2' => 'ru',
        ]);

        DB::table('languages')->insert([
            'title' => 'english',
            'country_code_2' => 'gb',
        ]);

        DB::table('languages')->insert([
            'title' => 'polski',
            'country_code_2' => 'pl',
        ]);
    }
}
