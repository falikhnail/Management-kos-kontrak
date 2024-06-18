<?php

namespace App\Models;

use App\Models\_ProductScopes;
use App\Models\_ProductAsesors;
use App\Models\_ProductRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    use _ProductScopes, _ProductAsesors, _ProductRelations;

    protected $guarded = ['id'];
    protected $appends = [
        'photo_path',
        'harga'
    ];
}
