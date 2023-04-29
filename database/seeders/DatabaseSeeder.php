<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\SettingsSeeder;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call([
            SettingsSeeder::class,
            RolePermissionSeeder::class,
            // CategorySeeder::class,
            // ProductSeeder::class,
        ]);
        $role = Role::where('name', '=', 'Super Admin')->first();
        $role->permissions()->sync(Permission::get()->pluck('id'));
    }
}