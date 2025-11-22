<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\PcbPriceBoardRule;
use Hzmwdz\Tinyquote\Repositories\PcbPriceBoardRuleRepository;

class PcbPriceBoardCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceBoardRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceBoardRuleRepository $repository
     */
    public function __construct(PcbPriceBoardRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'board';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var PcbPriceBoardRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->material == $rule->material
                && $quoteDTO->layers == $rule->layers
                && $quoteDTO->totalAreaM2() >= $rule->min_area_m2
                && $quoteDTO->totalAreaM2() <= $rule->max_area_m2
                && $quoteDTO->leadtimeHours == $rule->leadtime_hours;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->totalAreaM2(), 4);
    }
}
