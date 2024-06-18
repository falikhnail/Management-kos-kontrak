<?php

namespace App\Models;

trait _CategoryScopes
{
    public function scopeActive($e)
    {
        return $e->where('is_active', 1);
    }

    public function scopeFilter($ee, $q)
    {
        return $ee->when($q, function ($e, $q) {
            return $e->where('name', 'like', "%$q%")
                ->orWhere('code', 'like', "%$q%");
        });
    }
}
