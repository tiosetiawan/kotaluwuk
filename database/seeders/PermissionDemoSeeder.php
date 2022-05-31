<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view menu']);
        Permission::create(['name' => 'create menu']);
        Permission::create(['name' => 'edit menu']);
        Permission::create(['name' => 'delete menu']);
        Permission::create(['name' => 'publish menu']);
        Permission::create(['name' => 'unpublish menu']);

        $user1 = User::factory()->create([
            'name'       => 'ROZUL IMAM',
            'username'   => '88101731',
            'email'      => 'tio@gmail.com',
            'perusahaan' => 'PT IMIP',
            'divisi'     => 'IT - APPLICATION DEVELOPMENT',
            'password'   => bcrypt('12345678'),
        ]);
        

        $user2 = User::factory()->create([
            'name'       => 'HEVI SISWOYO',
            'username'   => '88100085',
            'email'      => 'tio31gmail.com',
            'perusahaan' => 'PT IMIP',
            'divisi'     => 'IT - APPLICATION DEVELOPMENT',
            'password'   => bcrypt('12345678'),
        ]);
        

        $user3 = User::factory()->create([
            'name'       => 'Satrio Setiawan I Lintang',
            'username'   => '88102332',
            'email'      => 'tiogmail.com',
            'perusahaan' => 'PT IMIP',
            'divisi'     => 'IT - APPLICATION DEVELOPMENT',
            'password'   => bcrypt('12345678'),
        ]);
       

        //create roles and assign existing permissions
        $writerRole = User::where('username', '88101731')->first();
        $writerRole->givePermissionTo('view menu');
        $writerRole->givePermissionTo('create menu');
        $writerRole->givePermissionTo('edit menu');
        $writerRole->givePermissionTo('delete menu');

        $adminRole =  User::where('username', '88100085')->first();
        $adminRole->givePermissionTo('view menu');
        $adminRole->givePermissionTo('create menu');
        $adminRole->givePermissionTo('edit menu');
        $adminRole->givePermissionTo('delete menu');
        $adminRole->givePermissionTo('publish menu');

        $superadminRole =  User::where('username', '88102332')->first();
        $superadminRole->givePermissionTo('view menu');
        $superadminRole->givePermissionTo('create menu');
        $superadminRole->givePermissionTo('edit menu');
        $superadminRole->givePermissionTo('delete menu');
        $superadminRole->givePermissionTo('publish menu');
        $superadminRole->givePermissionTo('unpublish menu');
        // gets all permissions via Gate::before rule

        // create demo users
        $writerRole     = Role::create(['name' => 'writer']);
        $adminRole      = Role::create(['name' => 'admin']);
        $superadminRole = Role::create(['name' => 'super-admin']);
       
        $user1->assignRole($adminRole);
        $user2->assignRole($writerRole);
        $user3->assignRole($superadminRole);
    }
}
