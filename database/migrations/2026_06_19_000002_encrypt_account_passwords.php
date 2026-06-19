<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cifra en reposo las contraseñas de la tabla accounts.
     * Crea primero un backup en texto plano (accounts_password_backup) por seguridad;
     * borrar ese backup manualmente una vez verificado todo.
     */
    public function up(): void
    {
        // 1) Backup de las contraseñas actuales (en plano) antes de tocar nada.
        if (! Schema::hasTable('accounts_password_backup')) {
            Schema::create('accounts_password_backup', function (Blueprint $table) {
                $table->unsignedBigInteger('account_id')->primary();
                $table->text('password')->nullable();
                $table->timestamp('backed_up_at')->nullable();
            });
        }

        DB::table('accounts')->orderBy('id')->chunkById(200, function ($accounts) {
            foreach ($accounts as $acc) {
                // Solo respaldar si aún no existe backup de esa cuenta.
                $exists = DB::table('accounts_password_backup')->where('account_id', $acc->id)->exists();
                if (! $exists) {
                    DB::table('accounts_password_backup')->insert([
                        'account_id'   => $acc->id,
                        'password'     => $acc->password,
                        'backed_up_at' => now(),
                    ]);
                }
            }
        });

        // 2) Ampliar la columna: el texto cifrado es mucho más largo que 50 chars.
        Schema::table('accounts', function (Blueprint $table) {
            $table->text('password')->nullable()->change();
        });

        // 3) Cifrar las contraseñas existentes (idempotente: salta las ya cifradas).
        DB::table('accounts')->orderBy('id')->chunkById(200, function ($accounts) {
            foreach ($accounts as $acc) {
                if ($acc->password === null || $acc->password === '') {
                    continue;
                }

                // ¿Ya está cifrada? Si descifra sin error, no la tocamos.
                try {
                    Crypt::decryptString($acc->password);
                    continue; // ya cifrada
                } catch (\Throwable $e) {
                    // estaba en texto plano -> cifrar
                }

                DB::table('accounts')->where('id', $acc->id)->update([
                    'password' => Crypt::encryptString($acc->password),
                ]);
            }
        });
    }

    /**
     * Revierte: descifra las contraseñas, vuelve la columna a string(50)
     * y elimina la tabla de backup.
     */
    public function down(): void
    {
        DB::table('accounts')->orderBy('id')->chunkById(200, function ($accounts) {
            foreach ($accounts as $acc) {
                if ($acc->password === null || $acc->password === '') {
                    continue;
                }
                try {
                    $plain = Crypt::decryptString($acc->password);
                    DB::table('accounts')->where('id', $acc->id)->update(['password' => $plain]);
                } catch (\Throwable $e) {
                    // ya estaba en plano; nada que hacer
                }
            }
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->string('password', 50)->nullable()->change();
        });

        Schema::dropIfExists('accounts_password_backup');
    }
};
