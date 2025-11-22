<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\StencilPriceElectropolishingRule;
use Hzmwdz\Tinyquote\Repositories\StencilPriceElectropolishingRuleRepository;

class StencilPriceElectropolishingCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\StencilPriceElectropolishingRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\StencilPriceElectropolishingRuleRepository $repository
     */
    public function __construct(StencilPriceElectropolishingRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'electropolishing';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\StencilQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var StencilPriceElectropolishingRule */
        $rule = $this->repository->firstFromCache();

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->qty, 4);
    }
}
