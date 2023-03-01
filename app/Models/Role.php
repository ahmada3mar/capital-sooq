<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{

    protected $appends = ['permissions_ids'];

    public function getPermissionsIdsAttribute()
    {
        return $this->permissions->pluck('id');
    }
}
