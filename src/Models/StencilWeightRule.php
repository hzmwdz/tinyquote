<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class StencilWeightRule extends Model
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
