<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\PcbPriceSoldermaskColorRule;
use Hzmwdz\Tinyquote\Repositories\PcbPriceSoldermaskColorRuleRepository;

class PcbPriceSoldermaskColorCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceSoldermaskColorRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceSoldermaskColorRuleRepository $repository
     */
    public function __construct(PcbPriceSoldermaskColorRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'soldermask_color';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var PcbPriceSoldermaskColorRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->soldermaskColor == $rule->soldermask_color;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->totalAreaM2(), 4);
    }
}
