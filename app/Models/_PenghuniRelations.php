<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;

trait _PenghuniRelations
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => null,
            'email' => null,
            'no_hp' => null,
            'no_kk' => null,
            'no_ktp' => null,
            'tanggal_lahir' => null,
            'status_perkawinan' => null
        ]);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault([
            'name' => '<span style="color:red;">*Berhenti Menghuni*</span>'
        ]);
    }
}
