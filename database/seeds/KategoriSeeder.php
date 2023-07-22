<?php

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\User;
use App\Absen;
use Illuminate\Support\Facades\Hash;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        // User::insert([
        //     'name' => 'admin',
        //     'email' => 'admin@mail.com',
        //     'password' => Hash::make(11111111),
        // ]);
        for ($i = 1; $i <= 100; $i++) {
            User::insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make(11111111),
            ]);
        }
        // for ($b = 10; $b <= 30; $b++) {
        //     $waktu = '2020-06-' . $b;
        //     for ($i = 1; $i <= 50; $i++) {
        //         Absen::create([
        //             // 'user_id' => $faker->numberBetween($min = 2, $max = 50),
        //             'user_id' => $i,
        //             'kategori' => 'ontime',
        //             'waktu' => $waktu,
        //             'jam' => $faker->valid()->randomElement($array = array(
        //                 '06:',
        //                 '07:',
        //                 '05:'
        //             )) . $faker->numberBetween($min = 10, $max = 59) . ':' .
        //                 $faker->numberBetween($min = 10, $max = 59),
        //             // 'created_at' => "2023-07-20 ".$faker->numberBetween($min = 7, $max = 9)
        //             // .':'.$faker->numberBetween($min = 0, $max = 60).':'.$faker->numberBetween($min = 7, $max = 9)
        //         ]);
        //     }



        //     for ($i = 1; $i <= 5; $i++) {
        //         Absen::where('user_id', $faker->numberBetween($min = 2, $max = 50))->update([
        //             // 'user_id' => $faker->numberBetween($min = 2, $max = 50),
        //             'kategori' => 'telat',
        //             'waktu' => $waktu,
        //             'jam' => $faker->valid()->randomElement($array = array(
        //                 '08:',
        //                 '09:',
        //                 '10:'
        //             )) . $faker->numberBetween($min = 10, $max = 59) . ':' .
        //                 $faker->numberBetween($min = 10, $max = 59),
        //             // 'created_at' => "2023-07-20 ".$faker->numberBetween($min = 7, $max = 9)
        //             // .':'.$faker->numberBetween($min = 0, $max = 60).':'.$faker->numberBetween($min = 7, $max = 9)
        //         ]);
        //     }
        // }
    }
}
