<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class PcbPriceSurfaceFinishRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'surface_finish',
        'price',
        'description',
        'sort_order',
    ];
}
