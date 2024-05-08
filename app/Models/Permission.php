<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    use HasUuids;

    public $guarded = [];
}