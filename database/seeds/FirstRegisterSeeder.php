<?php

use Illuminate\Database\Seeder;

class FirstRegisterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
           'name' => '技術本部',
           'created_at' => new DateTime(),
           'updated_at' => new DateTime()
        ]);
        DB::table('users')->insert([
           'name' => '管理者',
           'email' => 'admin@admin.com',
           'password' => '1234567890',
           'joined_at' => '2020_06_03',
           'department_id' => '1',
           'flg_admin' => '1',
           'created_at' => new DateTime(),
           'updated_at' => new DateTime()
        ]);
    }
}
