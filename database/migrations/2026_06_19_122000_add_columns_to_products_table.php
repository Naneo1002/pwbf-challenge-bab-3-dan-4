<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Add missing columns used by factories
        if (!Schema::hasColumn('products', 'weight')) {
            Schema::table('products', function (Blueprint $table) {
                $table->decimal('weight', 8, 2)->default(0)->after('is_featured');
            });
        }

        if (!Schema::hasColumn('products', 'rating')) {
            Schema::table('products', function (Blueprint $table) {
                $table->decimal('rating', 3, 2)->default(0)->after('weight');
            });
        }

        if (!Schema::hasColumn('products', 'view_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedInteger('view_count')->default(0)->after('rating');
            });
        }

        if (!Schema::hasColumn('products', 'review_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedInteger('review_count')->default(0)->after('view_count');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('products', 'review_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('review_count');
            });
        }

        if (Schema::hasColumn('products', 'view_count')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('view_count');
            });
        }

        if (Schema::hasColumn('products', 'rating')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('rating');
            });
        }

        if (Schema::hasColumn('products', 'weight')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('weight');
            });
        }
    }
};
