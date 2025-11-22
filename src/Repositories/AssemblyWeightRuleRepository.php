<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\AssemblyWeightRule;

class AssemblyWeightRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(AssemblyWeightRule::class);
    }
}
