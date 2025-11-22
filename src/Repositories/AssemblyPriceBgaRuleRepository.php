<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\AssemblyPriceBgaRule;

class AssemblyPriceBgaRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(AssemblyPriceBgaRule::class);
    }
}
