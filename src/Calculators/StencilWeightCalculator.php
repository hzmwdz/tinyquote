<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\StencilWeightRule;
use Hzmwdz\Tinyquote\Repositories\StencilWeightRuleRepository;

class StencilWeightCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\StencilWeightRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\StencilWeightRuleRepository $repository
     */
    public function __construct(StencilWeightRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'stencil';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\StencilQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var StencilWeightRule */
        $rule = $this->repository->firstFromCache();

        if (!$rule) {
            return null;
        }

        return round($rule->weight_kg_m2 * $quoteDTO->totalAreaM2(), 4);
    }
}
