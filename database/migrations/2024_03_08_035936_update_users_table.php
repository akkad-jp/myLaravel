<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'auth0')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('auth0', 32)->nullabe();
                $table->boolean('email_verified')->default(false);

                $table->unique('auth0', 'users_auth0_unique');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'auth0')) {
                $table->dropUnique('users_auth0_unique');
                $table->dropColumn('auth0');
            }
            if (Schema::hasColumn('users', 'email_verified')) {
                $table->dropColumn('email_verified');
            }
        });
    }
};
