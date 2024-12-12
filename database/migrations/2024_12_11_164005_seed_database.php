<?php

use App\Models\Dish;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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

        User::factory()->count(50)->create();

        $user = User::create([
            'name' => 'benjamin',
            'email' => 'test@example.com',
            'password' => Hash::make('admin_secure_password')
        ]);

        Dish::factory(250)
            ->recycle(User::all())
            ->create();

        $role = Role::firstOrCreate(['name' => 'ADMIN']);
        $permissionCreateDish = Permission::firstOrCreate(['name' => 'create_dishes']);
        $permissionDeleteDish = Permission::firstOrCreate(['name' => 'delete_dishes']);

        $role->syncPermissions([$permissionCreateDish, $permissionDeleteDish]);

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
