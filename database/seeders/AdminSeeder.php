<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'id' => '5',
                'admin_id' => '2',
                'name' => 'BaoDepTrai',
                'email' => 'quocbaodtr70@gmail.com',
                'password' => Hash::make('12344321'), // mã hóa mật khẩu
                'description' => 'New Admin',
                'role' => 'FULL OPTION',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
