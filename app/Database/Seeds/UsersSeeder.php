<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            $gender = $faker->randomElements(['male', 'female'])[0];

            $data = [
                'name' => $faker->firstName($gender),
                'email' => $faker->email,
                'password' => password_hash('1234567', PASSWORD_DEFAULT),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            print_r($data);
            $this->db->table('users')->insert($data);
        }
    }
}
