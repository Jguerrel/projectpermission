<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Brand;
use App\Models\BranchOffice;
use App\Models\CarModel;
use App\Models\Department;
use App\Models\Device;
use App\Models\Disktype;
use App\Models\Diskstorage;
use App\Models\Employee;
use App\Models\Ipaddress;
use App\Models\Jobtitle;
use App\Models\Microsoftoffice;
use App\Models\OperatingSystem;
use App\Models\Size;
use App\Models\Typedevice;
use App\Models\Uniform;
use App\Models\User;
use App\Models\Setting;
use App\Observers\ActivityObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        $this->applyDynamicSettings();

        $models = [
            Account::class, Brand::class, BranchOffice::class, CarModel::class,
            Department::class, Device::class, Disktype::class, Diskstorage::class,
            Employee::class, Ipaddress::class, Jobtitle::class, Microsoftoffice::class,
            OperatingSystem::class, Size::class, Typedevice::class, Uniform::class,
            User::class,
        ];

        foreach ($models as $model) {
            $model::observe(ActivityObserver::class);
        }
    }

    /**
     * Aplica la configuracion editable desde la pantalla de Setup (tabla settings)
     * sobre config() en tiempo de ejecucion. Si una clave esta vacia, se mantiene
     * el valor del .env como respaldo.
     */
    protected function applyDynamicSettings(): void
    {
        // Evitar fallos antes de migrar o durante comandos de instalacion.
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }
        } catch (\Throwable $e) {
            return;
        }

        $set = function (string $configKey, $value) {
            if ($value !== null && $value !== '') {
                config([$configKey => $value]);
            }
        };

        // Google SSO
        $set('services.google.client_id', Setting::get('google_client_id'));
        $set('services.google.client_secret', Setting::get('google_client_secret'));
        $set('services.google.redirect', Setting::get('google_redirect'));

        $domains = Setting::get('google_allowed_domains');
        if ($domains) {
            config(['services.google.allowed_domains' => array_values(array_filter(array_map(
                'trim',
                explode(',', $domains)
            )))]);
        }

        // Correo (SMTP)
        $set('mail.mailers.smtp.host', Setting::get('mail_host'));
        $set('mail.mailers.smtp.port', Setting::get('mail_port'));
        $set('mail.mailers.smtp.username', Setting::get('mail_username'));
        $set('mail.mailers.smtp.password', Setting::get('mail_password'));
        $set('mail.mailers.smtp.encryption', Setting::get('mail_encryption'));
        $set('mail.from.address', Setting::get('mail_from_address'));
        $set('mail.from.name', Setting::get('mail_from_name'));
    }
}
