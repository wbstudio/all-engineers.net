<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init_members = [
            [
                'name' => 'member',
                'email' => 'member@member.com',
                'password' => 'memberpass',
                'course' => 2,
                'prefecture' => 6,
                'progress' => 0,
            ],

            // ここに追加できます
        ];

        foreach($init_members as $init_member) {

            $member = new Member();
            $member->name = $init_member['name'];
            $member->email = $init_member['email'];
            $member->password = Hash::make($init_member['password']);
            $member->course = $init_member['course'];
            $member->prefecture = $init_member['prefecture'];
            $member->progress = $init_member['progress'];
            $member->save();

        }
    }
}
