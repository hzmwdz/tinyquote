<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class AssemblyWeightRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'weight_kg_m2',
        'description',
        'sort_order',
    ];
}
