<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('admin') && !Schema::hasColumn('admin', 'deleted_at')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->timestamp('deleted_at')->nullable()->after('password')->index();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('admin') && Schema::hasColumn('admin', 'deleted_at')) {
            Schema::table('admin', function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }
    }
};
