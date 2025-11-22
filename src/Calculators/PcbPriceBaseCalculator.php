<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\PcbPriceBaseRule;
use Hzmwdz\Tinyquote\Repositories\PcbPriceBaseRuleRepository;

class PcbPriceBaseCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceBaseRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceBaseRuleRepository $repository
     */
    public function __construct(PcbPriceBaseRuleRepository $repository)
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
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var PcbPriceBaseRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->material == $rule->material
                && $quoteDTO->layers == $rule->layers
                && $quoteDTO->totalAreaM2() >= $rule->min_area_m2
                && $quoteDTO->totalAreaM2() <= $rule->max_area_m2;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price, 4);
    }
}
