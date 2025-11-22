<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\AssemblyPriceBaseRule;
use Hzmwdz\Tinyquote\Repositories\AssemblyPriceBaseRuleRepository;

class AssemblyPriceBaseCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBaseRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBaseRuleRepository $repository
     */
    public function __construct(AssemblyPriceBaseRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'base';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var AssemblyPriceBaseRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->isDoubleSide == $rule->is_double_side;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price, 4);
    }
}
