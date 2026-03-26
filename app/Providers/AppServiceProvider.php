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
use App\Observers\ActivityObserver;
use Illuminate\Pagination\Paginator;
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
}
