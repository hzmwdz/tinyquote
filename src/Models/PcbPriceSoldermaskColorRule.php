<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class PcbPriceSoldermaskColorRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'soldermask_color',
        'price',
        'description',
        'sort_order',
    ];
}
