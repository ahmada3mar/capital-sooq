<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Dashboard;
use App\Models\Gallery;
use App\Models\Industry;
use App\Models\Item;
use App\Models\ItemAttributeValue;
use App\Models\Note;
use App\Models\Order;
use App\Models\Organization;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shipping;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Value;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info( Permission::class);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            Attribute::class,
            Category::class,
            Gallery::class,
            Item::class,
            ItemAttributeValue::class,
            Note::class,
            Order::class,
            Organization::class,
            Plan::class,
            Product::class,
            Review::class,
            Shipping::class,
            Transaction::class,
            User::class,
            Value::class,
            Industry::class,
            Dashboard::class,
            Role::class,
            Permission::class
            // ... // List all your Models you want to have Permissions for.
        ]);

        $adminEmail = env('ADMIN_EMAIL', 'admin@capitalsooq.com');

        if (is_null($adminEmail)) {
            throw new \InvalidArgumentException('Email parameter must be provided!');
        }


        $collection->each(function ($item, $key) {
            // create permissions for each collection item
            $group = $this->getGroupName($item);
            $permission = $this->getPermissionName($item);

              Permission::updateOrCreate([
                    'group' => $group,
                    'name' =>   'view ' . $permission,
                    'description' => 'Allow the user to view a list of ' . strtolower($group) . ' as well as the details'
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'create ' . $permission,
                        'description' => 'Allow the user to add new ' . strtolower($group)
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'update ' . $permission,
                        'description' => 'Allow the user to update existing ' . strtolower($group)
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'delete ' . $permission,
                        'description' => 'Allow the user to delete ' . strtolower($group)
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'destroy ' . $permission,
                        'description' => 'Allow the user to destroy ' . strtolower($group)
                    ]);
                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'restore ' . $permission,
                        'description' => 'Allow the user to restore ' . strtolower($group)
                    ]);

                    Permission::updateOrCreate([
                        'group' => $group,
                        'name' =>   'view deleted ' . $permission,
                        'description' => 'Allow the user to view deleted ' . strtolower($group)
                    ]);
                });

        // Create an Admin Role and assign all Permissions
        $role = Role::updateOrCreate(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

       // Give User Admin Role
         $user = User::firstOrCreate(['email' => $adminEmail] , ['password' => bcrypt('P@ssw0rd') , 'name' => 'admin']); // Change this to your email.
         $user->assignRole('admin');
    }

    /**
     * Get group name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getGroupName($class)
    {
        return Str::plural(Str::title(Str::snake(class_basename($class), ' ')));
    }

    /**
     * Get permission name based on the model class provided
     *
     * @param $class
     *
     * @return string
     */
    private function getPermissionName($class)
    {
        return Str::plural(Str::snake(class_basename($class), ' '));
    }
}
