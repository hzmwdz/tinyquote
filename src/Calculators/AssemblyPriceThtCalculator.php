<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\AssemblyPriceThtRule;
use Hzmwdz\Tinyquote\Repositories\AssemblyPriceThtRuleRepository;

class AssemblyPriceThtCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceThtRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceThtRuleRepository $repository
     */
    public function __construct(AssemblyPriceThtRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'tht';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        if ($quoteDTO->thtTotal() <= 0) {
            return 0.0;
        }

        /** @var AssemblyPriceThtRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->thtTotal() >= $rule->min_count
                && $quoteDTO->thtTotal() <= $rule->max_count
                && $quoteDTO->leadtimeHours == $rule->leadtime_hours;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->thtTotal(), 4);
    }
}
