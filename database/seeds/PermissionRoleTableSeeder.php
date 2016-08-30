<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // add permission_role mapping
        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 2
        ]);

        DB::table('permission_role')->insert([
            'permission_id' => 2,
            'role_id' => 2
        ]);

        // add role_user mapping
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 2
        ]);
    }
}
