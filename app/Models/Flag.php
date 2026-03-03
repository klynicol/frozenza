<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasUuid;

    protected $fillable = [
        'row_id',
        'table_name',
        'f_value_1',
        'f_value_2',
    ];
}
