<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\AssemblyPriceBomLineRule;
use Hzmwdz\Tinyquote\Repositories\AssemblyPriceBomLineRuleRepository;

class AssemblyPriceBomLineCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBomLineRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBomLineRuleRepository $repository
     */
    public function __construct(AssemblyPriceBomLineRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'bom_line';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        if ($quoteDTO->bomLineCount <= 0) {
            return 0.0;
        }

        /** @var AssemblyPriceBomLineRule */
        $rule = $this->repository->firstFromCache();

        if (!$rule) {
            return null;
        }

        if ($quoteDTO->bomLineCount <= $rule->start_lines) {
            return $rule->start_price;
        }

        if ($rule->step_qty <= 0) {
            return null;
        }

        $steps = ceil(($quoteDTO->bomLineCount - $rule->start_lines) / $rule->step_qty);

        return round($rule->step_price * $steps, 4);
    }
}
