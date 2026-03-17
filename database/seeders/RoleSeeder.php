<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'Admin',
            'description'=>'Administrator with full access to the system.'
        ]);

        Role::create([
            'name'=>'Trainer',
            'description'=>'Trainer with access to training related systems.'
        ]);

        Role::create([
            'name'=>'User',
            'description'=>'User with access to user general features.'
        ]);

        Role::create([
            'name'=>'Staff',
            'description'=>'Staff member with access to general features.'
        ]);
    }
}
