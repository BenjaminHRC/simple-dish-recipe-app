<?php

use App\Models\Dish;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::factory()
            ->count(50)
            ->create();

        $user = User::create(['email' => 'test@example.com', 'password' => 'admin']);

        Dish::factory(250)
            ->create()
            ->each(function ($dish) {
                $dish->users()
                    ->attach(User::inRandomOrder()->limit(rand(1, 50))->pluck('id')->toArray());
            });

        $role = Role::create(['name' => 'ADMIN']);
        $permissionCreateDish  = Permission::create(['name' => 'create_dishes']);
        $permissionDeleteDish  = Permission::create(['name' => 'delete_dishes']);

        $permissionCreateDish->assignRole($role);
        $permissionDeleteDish->assignRole($role);

        $user->assignRole('ADMIN');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
