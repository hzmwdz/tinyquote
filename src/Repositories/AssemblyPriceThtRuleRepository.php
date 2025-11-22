<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\AssemblyPriceThtRule;

class AssemblyPriceThtRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(AssemblyPriceThtRule::class);
    }
}
