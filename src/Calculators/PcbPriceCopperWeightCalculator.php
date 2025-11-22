<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\PcbPriceCopperWeightRule;
use Hzmwdz\Tinyquote\Repositories\PcbPriceCopperWeightRuleRepository;

class PcbPriceCopperWeightCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceCopperWeightRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceCopperWeightRuleRepository $repository
     */
    public function __construct(PcbPriceCopperWeightRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'copper_weight';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var PcbPriceCopperWeightRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->copperOz == $rule->copper_oz;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->totalAreaM2(), 4);
    }
}
