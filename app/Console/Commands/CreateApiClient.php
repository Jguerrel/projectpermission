<?php

namespace App\Console\Commands;

use App\Models\ApiClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateApiClient extends Command
{
    protected $signature   = 'api:create-client {name? : Nombre descriptivo del cliente}';
    protected $description = 'Crea un nuevo cliente API con client_id y client_secret';

    public function handle(): int
    {
        $name     = $this->argument('name') ?? $this->ask('Nombre del cliente (ej: App Móvil)');
        $clientId = $this->ask('client_id (dejar vacío para generar automáticamente)');

        if (empty($clientId)) {
            $clientId = Str::slug($name) . '-' . Str::random(8);
        }

        if (ApiClient::where('client_id', $clientId)->exists()) {
            $this->error("Ya existe un cliente con client_id: {$clientId}");
            return self::FAILURE;
        }

        $secret = Str::random(40);

        ApiClient::create([
            'name'          => $name,
            'client_id'     => $clientId,
            'client_secret' => Hash::make($secret),
            'is_active'     => true,
        ]);

        $this->newLine();
        $this->info('✓ Cliente API creado exitosamente.');
        $this->newLine();
        $this->table(
            ['Campo', 'Valor'],
            [
                ['Nombre',        $name],
                ['client_id',     $clientId],
                ['client_secret', $secret],
            ]
        );
        $this->newLine();
        $this->warn('⚠ Guarda el client_secret ahora, no se mostrará de nuevo.');

        return self::SUCCESS;
    }
}
