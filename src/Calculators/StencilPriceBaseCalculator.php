<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\StencilPriceBaseRule;
use Hzmwdz\Tinyquote\Repositories\StencilPriceBaseRuleRepository;

class StencilPriceBaseCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\StencilPriceBaseRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\StencilPriceBaseRuleRepository $repository
     */
    public function __construct(StencilPriceBaseRuleRepository $repository)
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
     * @param \Hzmwdz\Tinyquote\DTOs\StencilQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var StencilPriceBaseRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->frameType == $rule->frame_type
                && $quoteDTO->widthMm == $rule->width_mm
                && $quoteDTO->heightMm == $rule->height_mm
                && $quoteDTO->thicknessMm == $rule->thickness_mm;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->qty, 4);
    }
}
