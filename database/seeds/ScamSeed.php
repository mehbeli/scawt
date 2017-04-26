<?php

use Illuminate\Database\Seeder;

class ScamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            \DB::table('scams')->insert([
                'name' => $faker->name,
                'location' => $faker->country,
            ]);
        }
    }
}
