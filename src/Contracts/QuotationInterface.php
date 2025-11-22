<?php

namespace Hzmwdz\Tinyquote\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

interface QuotationInterface extends Arrayable, JsonSerializable
{
    /**
     * @return bool
     */
    public function isValid();
}
