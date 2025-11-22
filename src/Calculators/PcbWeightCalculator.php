<?php

namespace Hzmwdz\Tinyquote\Calculators;

use Hzmwdz\Tinyquote\Models\PcbWeightRule;
use Hzmwdz\Tinyquote\Repositories\PcbWeightRuleRepository;

class PcbWeightCalculator
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbWeightRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbWeightRuleRepository $repository
     */
    public function __construct(PcbWeightRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'pcb';
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return float|null
     */
    public function quote($quoteDTO)
    {
        /** @var PcbWeightRule */
        $rule = $this->repository->firstFromCache();

        if (!$rule) {
            return null;
        }

        return round($rule->weight_kg_m2 * $quoteDTO->totalAreaM2(), 4);
    }
}
