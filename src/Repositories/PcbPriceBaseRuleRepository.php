<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\PcbPriceBaseRule;

class PcbPriceBaseRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(PcbPriceBaseRule::class);
    }
}
