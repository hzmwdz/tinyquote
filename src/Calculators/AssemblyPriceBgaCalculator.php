<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\AssemblyPriceBgaRule;
use Hzmwdz\Tinyquote\Repositories\AssemblyPriceBgaRuleRepository;

class AssemblyPriceBgaCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBgaRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBgaRuleRepository $repository
     */
    public function __construct(AssemblyPriceBgaRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'bga';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        if ($quoteDTO->bgaTotal() <= 0) {
            return 0.0;
        }

        /** @var AssemblyPriceBgaRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->bgaTotal() >= $rule->min_count
                && $quoteDTO->bgaTotal() <= $rule->max_count;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->bgaTotal(), 4);
    }
}
