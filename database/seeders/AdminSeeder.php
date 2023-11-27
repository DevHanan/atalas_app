<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $user = User::create([

            'name'=>'admin',
            'email'=>'admin@mail.com',
            'password'=> Hash::make('admin1234'), //admin1234
            'remember_token'=>'NlPo4Mr4KXcEw2Ltc2ujMwNh15VO405hLCeplSO1kDh7Gzr8r1J7ZnS3jixL'
        ]);

        // Delete Old Roles
        DB::table('roles')->delete();

        $role = Role::create(['name' => 'Super Admin', 'slug' => 'super-admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        // Create Roles
        $data = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'Accountant', 'slug' => 'accountant'],
            ['name' => 'Librarian', 'slug' => 'librarian'],
            ['name' => 'Receptionist', 'slug' => 'receptionist'],
            ['name' => 'Teacher', 'slug' => 'teacher'],
            ['name' => 'Office Staff', 'slug' => 'office-staff'],
        ];

        $roles = Role::insert($data);
    }
}
