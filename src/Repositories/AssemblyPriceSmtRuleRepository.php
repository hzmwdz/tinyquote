<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinyquote\Models\AssemblyPriceSmtRule;

class AssemblyPriceSmtRuleRepository extends AbstractQuoteRuleRepository
{
    public function __construct()
    {
        parent::__construct(AssemblyPriceSmtRule::class);
    }
}
