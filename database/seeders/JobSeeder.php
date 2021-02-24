<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\HelperClasses\EncryptDecryptHelper;
use Carbon\Carbon;
class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker=Faker::create();
        // foreach(range(1,500) as $index)
        // {
        //     DB::table('jobs')->insert([
        //         'job_category_id' => rand(1,6),
        //         'job_type_id' => rand(1,3),
        //         'email' => $faker->email,
        //         'company' => $faker->company,
        //         'position' => $faker->jobTitle,
        //         'logo_url' => $faker->imageUrl($width = 300, $height = 200),
        //         'location' => $faker->city,
        //         'description' => $faker->text,
        //         'token' => EncryptDecryptHelper::getJobToken(),
        //         'expired_at' => Carbon::now()->addDays(rand(5,30)),

                
        //     ]);
        // }
    }
}
