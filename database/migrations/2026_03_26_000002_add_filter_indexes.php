<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds indexes on columns used in DataTable filter queries.
 * - status (boolean) → improves exact-match WHERE status = ?
 * - name  (string)   → improves LIKE 'val%' (starts_with operator)
 * - logs.module, logs.action, logs.user_id → improves activity log queries
 *
 * Note: LIKE '%val%' (contains) cannot use a B-tree index regardless.
 */
return new class extends Migration
{
    private array $statusTables = [
        'accounts', 'brands', 'carmodels', 'departments',
        'diskstorages', 'disktypes', 'employees', 'devices',
        'microsoftoffices', 'operatingsystems', 'sizes', 'uniforms',
        'jobtitles', 'branchoffices',
    ];

    private array $nameTables = [
        'accounts', 'brands', 'carmodels', 'departments',
        'diskstorages', 'disktypes', 'employees',
        'microsoftoffices', 'operatingsystems', 'sizes', 'uniforms',
        'jobtitles', 'branchoffices',
    ];

    public function up(): void
    {
        foreach ($this->statusTables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'status')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->index('status');
                });
            }
        }

        foreach ($this->nameTables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'name')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->index('name');
                });
            }
        }

        // Logs table — used by ActivityLogController filters
        if (Schema::hasTable('logs')) {
            Schema::table('logs', function (Blueprint $t) {
                if (Schema::hasColumn('logs', 'module') && !$this->hasIndex('logs', 'logs_module_index')) {
                    $t->index('module');
                }
                if (Schema::hasColumn('logs', 'action') && !$this->hasIndex('logs', 'logs_action_index')) {
                    $t->index('action');
                }
                if (Schema::hasColumn('logs', 'user_id') && !$this->hasIndex('logs', 'logs_user_id_index')) {
                    $t->index('user_id');
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->statusTables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, fn(Blueprint $t) => $t->dropIndex([$table . '_status_index']));
            }
        }

        foreach ($this->nameTables as $table) {
            if (Schema::hasTable($table)) {
                Schema::table($table, fn(Blueprint $t) => $t->dropIndex([$table . '_name_index']));
            }
        }

        if (Schema::hasTable('logs')) {
            Schema::table('logs', function (Blueprint $t) {
                $t->dropIndex(['module']);
                $t->dropIndex(['action']);
                $t->dropIndex(['user_id']);
            });
        }
    }

    private function hasIndex(string $table, string $indexName): bool
    {
        $indexes = \DB::select("SHOW INDEX FROM `{$table}` WHERE Key_name = ?", [$indexName]);
        return !empty($indexes);
    }
};
