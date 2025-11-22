<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\PcbPriceSoldermaskColorRule;

class PcbPriceSoldermaskColorRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(PcbPriceSoldermaskColorRule::class);
    }
}
