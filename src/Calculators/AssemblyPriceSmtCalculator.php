<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\AssemblyPriceSmtRule;
use Hzmwdz\Tinyquote\Repositories\AssemblyPriceSmtRuleRepository;

class AssemblyPriceSmtCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceSmtRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceSmtRuleRepository $repository
     */
    public function __construct(AssemblyPriceSmtRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'smt';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        if ($quoteDTO->smtTotal() <= 0) {
            return 0.0;
        }

        /** @var AssemblyPriceSmtRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->smtTotal() >= $rule->min_count
                && $quoteDTO->smtTotal() <= $rule->max_count
                && $quoteDTO->leadtimeHours == $rule->leadtime_hours;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->smtTotal(), 4);
    }
}
