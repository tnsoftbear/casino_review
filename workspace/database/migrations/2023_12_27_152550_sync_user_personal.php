<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $usersWithoutProfile = User::whereDoesntHave('userPersonal')->get();
        foreach ($usersWithoutProfile as $user) {
            $user->userPersonal()->create([
                'first_name' => '',
                'last_name' => '',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
