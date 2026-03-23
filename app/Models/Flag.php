<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag query()
 * @property string $id
 * @property string $flagable_id
 * @property string $table_name
 * @property string $f_value_1
 * @property string|null $f_value_2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag whereFValue1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag whereFValue2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag whereFlagableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Flag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Flag extends Model
{
    use HasUuid;

    protected $fillable = [
        'table_name',
        'f_value_1',
        'f_value_2',
        'flagable_id',
    ];
}
