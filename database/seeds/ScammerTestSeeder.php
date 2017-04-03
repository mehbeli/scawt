<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ScammerTestSeeder extends Seeder
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
            \DB::table('scammer_tests')->insert([
                'name' => $faker->name,
                'location' => $faker->country,
                'first_report' => $faker->date(),
                'medium' => $faker->randomElement(['Online', 'Offline']),
                'type' => $faker->randomElement(['Buyer', 'Seller']),
            ]);
        }
    }
}
