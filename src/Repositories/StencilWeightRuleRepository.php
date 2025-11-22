<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\StencilWeightRule;

class StencilWeightRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(StencilWeightRule::class);
    }
}
