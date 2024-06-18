<?php

namespace App\Models;

use App\Models\Penghuni;

trait _ProductRelations
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'code' => null,
            'name' => null
        ]);
    }

    public function penghuni()
    {
        return $this->hasOne(Penghuni::class, 'product_id');
    }
}
