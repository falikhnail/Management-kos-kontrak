<?php

namespace App\Models;

use App\Models\Penghuni;
use Modules\Roles\Entities\Role;

trait _UserRelations
{
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id')->withDefault([
            'name' => null
        ]);
    }

    public function penghuni()
    {
        return $this->hasOne(Penghuni::class, 'user_id');
    }
}
