<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'parent_id' => null,
            'title' => 'Курьерская служба',
            'position' => 0,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Курьерская доставка',
            'position' => 1,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Грузовые перевозки',
            'position' => 2,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Пасажирские перевозки',
            'position' => 3,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Доставка цветов',
            'position' => 4,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Доставка продуктов',
            'position' => 5,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Доставка подарков',
            'position' => 6,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Найти товар',
            'position' => 7,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 1,
            'title' => 'Прочее',
            'position' => 99,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => null,
            'title' => 'Домашний мастер',
            'position' => 0,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 10,
            'title' => 'Сантежник',
            'position' => 1,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 10,
            'title' => 'Электрик',
            'position' => 2,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 10,
            'title' => 'Ремонт квартиры',
            'position' => 3,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 10,
            'title' => 'Ремонт мебели',
            'position' => 4,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 10,
            'title' => 'Сборка мебели',
            'position' => 5,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 10,
            'title' => 'Разнорабочие',
            'position' => 6,
            'is_visible' => 1,
        ]);

        DB::table('categories')->insert([
            'parent_id' => 10,
            'title' => 'Другие услуги мастера',
            'position' => 99,
            'is_visible' => 1,
        ]);

    }
}
