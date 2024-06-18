<?php

namespace App\Models;

use App\Models\_PenghuniScopes;
use App\Models\_PenghuniRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghuni extends Model
{
    use HasFactory;
    use SoftDeletes;

    use _PenghuniRelations, _PenghuniScopes;

    protected $guarded = ['id'];
}
