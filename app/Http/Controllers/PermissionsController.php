<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{
    public function roles()
    {
        return Role::query()->get();
    }

    public function permisssions()
    {
        return Role::query()->get();
    }
}
