<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class PcbPriceThicknessRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'thickness_mm',
        'price',
        'description',
        'sort_order',
    ];
}
