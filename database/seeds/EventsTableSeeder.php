<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'name' => 'зарегистрирован',
        ]);

        DB::table('events')->insert([
            'name' => 'email подтвержден',
        ]);

        DB::table('events')->insert([
            'name' => 'добавлена анкета',
        ]);

        DB::table('events')->insert([
            'name' => 'создана задача',
        ]);

        DB::table('events')->insert([
            'name' => 'сделана пропозиция',
        ]);

        DB::table('events')->insert([
            'name' => 'заключена сделка',
        ]);
    }
}
