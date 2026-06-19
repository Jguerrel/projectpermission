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

        // 2) Limpiar fechas legadas '0000-00-00' poniéndoles la fecha de hoy, y ampliar
        //    la columna a TEXT (el texto cifrado es mucho mayor a 50 chars).
        //    sql_mode relajado (por-conexión, no persiste) para poder corregir filas con
        //    fechas inválidas y para que el ALTER no las revalide.
        DB::statement("SET SESSION sql_mode=''");
        DB::statement("UPDATE accounts SET created_at = NOW() WHERE created_at = '0000-00-00 00:00:00'");
        DB::statement("UPDATE accounts SET updated_at = NOW() WHERE updated_at = '0000-00-00 00:00:00'");
        DB::statement('ALTER TABLE accounts MODIFY password TEXT NULL');

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

        DB::statement("SET SESSION sql_mode=''");
        DB::statement('ALTER TABLE accounts MODIFY password VARCHAR(50) NULL');

        Schema::dropIfExists('accounts_password_backup');
    }
};
