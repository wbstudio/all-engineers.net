<?php

namespace Database\Seeders;


use App\Models\Administer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class MultiAuthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init_administers = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin'
            ],

            // ここに追加できます
        ];

        foreach($init_administers as $init_administer) {

            $administer = new Administer();
            $administer->name = $init_administer['name'];
            $administer->email = $init_administer['email'];
            $administer->password = Hash::make($init_administer['password']);
            $administer->save();

        }
    }
}
