<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\PcbWeightRule;

class PcbWeightRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(PcbWeightRule::class);
    }
}
