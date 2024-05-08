<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    use HasUuids;

    public $guarded = [];
}