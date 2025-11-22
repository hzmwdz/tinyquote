<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class StencilPriceElectropolishingRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'price',
        'description',
        'sort_order',
    ];
}
