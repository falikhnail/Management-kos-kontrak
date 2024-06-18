<?php

namespace App\Models;

use App\Models\Category;

trait _ProductScopes
{
    public function scopeFilter($ee, $q)
    {
        return $ee->when($q, function ($e, $q) {
            return $e->where('name', 'like', "%$q%")
                ->orWhere('address', 'like', "%$q%")
                ->orWhere('durasi_pembayaran', 'like', "%$q%")
                ->orWhere('note', 'like', "%$q%")
                // ->orWhere('category_id', 'like', "%$q%")
                ->orWhere('no_rumah', 'like', "%$q%");
        });
    }

    public function scopeKategori($ee, $id)
    {
        if ($id) {
            return $ee->where('category_id', $id);
        }
    }

    public function scopeDurasiPembayaran($e, $str)
    {
        if ($str) {
            return $e->where('durasi_pembayaran', $str);
        }
    }

    public function scopeActive($e)
    {
        return $e->where('is_active', 1);
    }

    public function scopeMasihKosong($e)
    {
        return $e->doesntHave('penghuni');
    }
}
