<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
            ['name' => 'edit-post', 'label' => 'Can edit post', 'description' => null],
            ['name' => 'delete-post', 'label' => 'Can delete post', 'description' => null]
        );
            
        // Loop through each permission above and create the record for them in the database
        foreach ($permissions as $permission)
        {
            Permission::create($permission);
        }
    }
}
