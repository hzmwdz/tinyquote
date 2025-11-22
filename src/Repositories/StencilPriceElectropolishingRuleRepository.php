<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\StencilPriceElectropolishingRule;

class StencilPriceElectropolishingRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(StencilPriceElectropolishingRule::class);
    }
}
