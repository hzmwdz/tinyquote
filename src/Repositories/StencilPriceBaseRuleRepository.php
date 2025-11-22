<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\StencilPriceBaseRule;

class StencilPriceBaseRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(StencilPriceBaseRule::class);
    }
}
