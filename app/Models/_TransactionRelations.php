<?php

namespace App\Models;

use App\Models\User;
use App\Models\Penghuni;
use App\Models\TransactionLine;

trait _TransactionRelations
{
    public function penghuni_r()
    {
        return $this->belongsTo(Penghuni::class, 'penghuni_id');
    }

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
            'name' => null
        ]);
    }

    public function lines()
    {
        return $this->hasMany(TransactionLine::class, 'transaction_id');
    }
}
