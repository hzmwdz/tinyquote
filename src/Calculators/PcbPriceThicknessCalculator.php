<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\PcbPriceThicknessRule;
use Hzmwdz\Tinyquote\Repositories\PcbPriceThicknessRuleRepository;

class PcbPriceThicknessCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceThicknessRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceThicknessRuleRepository $repository
     */
    public function __construct(PcbPriceThicknessRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'thickness';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var PcbPriceThicknessRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->thicknessMm == $rule->thickness_mm;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->totalAreaM2(), 4);
    }
}
