<?php

namespace App\Models;

use App\Models\_TransactionScopes;
use App\Models\_TransactionRelations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    use _TransactionScopes, _TransactionRelations;

    protected $guarded = ['id'];
}
