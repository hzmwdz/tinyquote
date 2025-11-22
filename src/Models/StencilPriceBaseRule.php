<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class StencilPriceBaseRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'frame_type',
        'width_mm',
        'height_mm',
        'thickness_mm',
        'price',
        'description',
        'sort_order',
    ];
}
