<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JeroenNoten\LaravelAdminLte\AdminLte;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $adminlte;

    public function __construct(AdminLte $adminlte)
    {
        $this->adminlte = $adminlte;
    }

}
