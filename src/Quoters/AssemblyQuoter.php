<?php

namespace Hzmwdz\Tinyquote\Quoters;

use Hzmwdz\Tinyquote\Calculators\AssemblyPriceBaseCalculator;
use Hzmwdz\Tinyquote\Calculators\AssemblyPriceBgaCalculator;
use Hzmwdz\Tinyquote\Calculators\AssemblyPriceBomLineCalculator;
use Hzmwdz\Tinyquote\Calculators\AssemblyPriceSmtCalculator;
use Hzmwdz\Tinyquote\Calculators\AssemblyPriceThtCalculator;
use Hzmwdz\Tinyquote\Calculators\AssemblyWeightCalculator;
use Hzmwdz\Tinyquote\Quotations\AssemblyQuotation;
use Illuminate\Support\Collection;

class AssemblyQuoter
{
    /**
     * @var \Hzmwdz\Tinyquote\Calculators\AssemblyPriceBaseCalculator
     */
    protected $priceBaseCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\AssemblyPriceSmtCalculator
     */
    protected $priceSmtCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\AssemblyPriceThtCalculator
     */
    protected $priceThtCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\AssemblyPriceBgaCalculator
     */
    protected $priceBgaCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\AssemblyPriceBomLineCalculator
     */
    protected $priceBomLineCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\AssemblyWeightCalculator
     */
    protected $weightCalculator;

    /**
     * @param \Hzmwdz\Tinyquote\Calculators\AssemblyPriceBaseCalculator $priceBaseCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\AssemblyPriceSmtCalculator $priceSmtCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\AssemblyPriceThtCalculator $priceThtCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\AssemblyPriceBgaCalculator $priceBgaCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\AssemblyPriceBomLineCalculator $priceBomLineCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\AssemblyWeightCalculator $weightCalculator
     */
    public function __construct(
        AssemblyPriceBaseCalculator $priceBaseCalculator,
        AssemblyPriceSmtCalculator $priceSmtCalculator,
        AssemblyPriceThtCalculator $priceThtCalculator,
        AssemblyPriceBgaCalculator $priceBgaCalculator,
        AssemblyPriceBomLineCalculator $priceBomLineCalculator,
        AssemblyWeightCalculator $weightCalculator
    ) {
        $this->priceBaseCalculator = $priceBaseCalculator;
        $this->priceSmtCalculator = $priceSmtCalculator;
        $this->priceThtCalculator = $priceThtCalculator;
        $this->priceBgaCalculator = $priceBgaCalculator;
        $this->priceBomLineCalculator = $priceBomLineCalculator;
        $this->weightCalculator = $weightCalculator;
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return \Hzmwdz\Tinyquote\Quotations\AssemblyQuotation
     */
    public function quote($quoteDTO)
    {
        $priceBreakdown = $this->quotePrice($quoteDTO);

        $weightBreakdownKg = $this->quoteWeightKg($quoteDTO);

        return new AssemblyQuotation(
            $quoteDTO->qty,
            $quoteDTO->leadtimeHours,
            $priceBreakdown,
            $weightBreakdownKg
        );
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return \Illuminate\Support\Collection
     */
    protected function quotePrice($quoteDTO)
    {
        return Collection::make([
            $this->priceBaseCalculator->name() => $this->priceBaseCalculator->quote($quoteDTO),
            $this->priceSmtCalculator->name() => $this->priceSmtCalculator->quote($quoteDTO),
            $this->priceThtCalculator->name() => $this->priceThtCalculator->quote($quoteDTO),
            $this->priceBgaCalculator->name() => $this->priceBgaCalculator->quote($quoteDTO),
            $this->priceBomLineCalculator->name() => $this->priceBomLineCalculator->quote($quoteDTO),
        ]);
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\AssemblyQuoteDTO $quoteDTO
     * @return \Illuminate\Support\Collection
     */
    protected function quoteWeightKg($quoteDTO)
    {
        return Collection::make([
            $this->weightCalculator->name() => $this->weightCalculator->quote($quoteDTO),
        ]);
    }
}
