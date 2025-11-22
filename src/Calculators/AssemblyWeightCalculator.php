<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\AssemblyWeightRule;
use Hzmwdz\Tinyquote\Repositories\AssemblyWeightRuleRepository;

class AssemblyWeightCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyWeightRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyWeightRuleRepository $repository
     */
    public function __construct(AssemblyWeightRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'assembly';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var AssemblyWeightRule */
        $rule = $this->repository->firstFromCache();

        if (!$rule) {
            return null;
        }

        return round($rule->weight_kg_m2 * $quoteDTO->totalAreaM2(), 4);
    }
}
