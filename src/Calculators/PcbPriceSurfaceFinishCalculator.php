<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\PcbPriceSurfaceFinishRule;
use Hzmwdz\Tinyquote\Repositories\PcbPriceSurfaceFinishRuleRepository;

class PcbPriceSurfaceFinishCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceSurfaceFinishRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceSurfaceFinishRuleRepository $repository
     */
    public function __construct(PcbPriceSurfaceFinishRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'surface_finish';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var PcbPriceSurfaceFinishRule */
        $rule = $this->repository->firstFromCache(function ($rule) use ($quoteDTO) {
            return $quoteDTO->surfaceFinish == $rule->surface_finish;
        });

        if (!$rule || is_null($rule->price)) {
            return null;
        }

        return round($rule->price * $quoteDTO->totalAreaM2(), 4);
    }
}
