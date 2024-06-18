<?php

namespace App\Models;

trait _PenghuniScopes
{
    public function scopeKategoriProduk($e, $id = null)
    {
        if ($id) {
            return $e->whereHas('product', function ($ee) use ($id) {
                $ee->where('category_id', $id);
            });
        }
    }

    public function scopeDurasiPembayaran($e, $id = null)
    {
        if ($id) {
            return $e->whereHas('product', function ($ee) use ($id) {
                $ee->where('durasi_pembayaran', $id);
            });
        }
    }

    public function scopeFilter($e, $str = null)
    {
        if ($str) {
            return $e->whereHas('product', function ($ee) use ($str) {
                $ee->where('name', 'like', "%$str%");
            })->orWhereHas('user', function ($ee) use ($str) {
                $ee->where('name', 'like', "%$str%");
            });
        }
    }

    public function scopeUserId($e, $id)
    {
        if ($id) {
            return $e->where('user_id', $id);
        }
    }
}
