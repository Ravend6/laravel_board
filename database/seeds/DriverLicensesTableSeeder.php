<?php

use Illuminate\Database\Seeder;

class DriverLicensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('driver_licenses')->insert([
            'title' => 'A',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'A1',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'B',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'BE',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'B1',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'C',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'CE',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'C1',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'C1E',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'D',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'DE',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'D1E',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'M',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'Tm',
        ]);
        DB::table('driver_licenses')->insert([
            'title' => 'Tb',
        ]);
    }
}
