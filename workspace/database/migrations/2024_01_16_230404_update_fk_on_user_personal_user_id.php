<?php

use App\Infra\Db\DbSchemaExplorer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_personal', function (Blueprint $table) {
            $schemaExplorer = new DbSchemaExplorer();
            if ($schemaExplorer->hasForeignKey('user_personal', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
            $table
                // ->foreignIdFor(User::class, 'user_id') // Если хотим создать новую колонку
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_personal', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
