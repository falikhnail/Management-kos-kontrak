<?php

namespace App\Models;

trait _UserScopes
{
    public function scopeFilter($e, $q)
    {
        return $e->when($q, function ($ee, $q) {
            return $ee->where('name', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%");
        });
    }

    public function scopeActive($e)
    {
        return $e->where('is_active', 1);
    }

    public function scopeBelumMenyewa($e)
    {
        return $e->doesntHave('penghuni')->orWhereHas('penghuni', function ($e) {
            $e->whereNull('product_id');
        });
    }
}
