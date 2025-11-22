<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\PcbPriceCopperWeightRule;

class PcbPriceCopperWeightRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(PcbPriceCopperWeightRule::class);
    }
}
