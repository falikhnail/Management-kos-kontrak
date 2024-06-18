<?php

namespace App\Models;

use App\Models\_CategoryScopes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use _CategoryScopes;

    protected $fillable = [
        'code',
        'name',
        'is_active',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];
}
