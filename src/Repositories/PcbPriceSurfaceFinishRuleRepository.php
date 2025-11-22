<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\PcbPriceSurfaceFinishRule;

class PcbPriceSurfaceFinishRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(PcbPriceSurfaceFinishRule::class);
    }
}
