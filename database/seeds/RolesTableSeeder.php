<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            ['name' => 'editor', 'label' => 'The editor of the site', 'description' => null],
            ['name' => 'admin', 'label' => 'The admin of the site', 'description' => null]
        );
            
        // Loop through each role above and create the record for them in the database
        foreach ($roles as $role)
        {
            Role::create($role);
        }
    }
}
