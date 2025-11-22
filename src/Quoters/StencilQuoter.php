<?php

namespace Hzmwdz\Tinyquote\Quoters;

use Hzmwdz\Tinyquote\Calculators\StencilPriceBaseCalculator;
use Hzmwdz\Tinyquote\Calculators\StencilPriceElectropolishingCalculator;
use Hzmwdz\Tinyquote\Calculators\StencilWeightCalculator;
use Hzmwdz\Tinyquote\Quotations\StencilQuotation;
use Illuminate\Support\Collection;

class StencilQuoter
{
    /**
     * @var \Hzmwdz\Tinyquote\Calculators\StencilPriceBaseCalculator
     */
    protected $priceBaseCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\StencilPriceElectropolishingCalculator
     */
    protected $priceElectropolishingCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\StencilWeightCalculator
     */
    protected $weightCalculator;

    /**
     * @param \Hzmwdz\Tinyquote\Calculators\StencilPriceBaseCalculator $priceBaseCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\StencilWeightCalculator $weightCalculator
     */
    public function __construct(
        StencilPriceBaseCalculator $priceBaseCalculator,
        StencilPriceElectropolishingCalculator $priceElectropolishingCalculator,
        StencilWeightCalculator $weightCalculator
    ) {
        $this->priceBaseCalculator = $priceBaseCalculator;
        $this->priceElectropolishingCalculator = $priceElectropolishingCalculator;
        $this->weightCalculator = $weightCalculator;
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\StencilQuoteDTO $quoteDTO
     * @return \Hzmwdz\Tinyquote\Quotations\StencilQuotation
     */
    public function quote($quoteDTO)
    {
        $priceBreakdown = $this->quotePrice($quoteDTO);

        $weightBreakdownKg = $this->quoteWeightKg($quoteDTO);

        return new StencilQuotation(
            $quoteDTO->qty,
            $quoteDTO->leadtimeHours,
            $priceBreakdown,
            $weightBreakdownKg
        );
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\StencilQuoteDTO $quoteDTO
     * @return \Illuminate\Support\Collection
     */
    protected function quotePrice($quoteDTO)
    {
        return Collection::make([
            $this->priceBaseCalculator->name() => $this->priceBaseCalculator->quote($quoteDTO),
            $this->priceElectropolishingCalculator->name() => $this->priceElectropolishingCalculator->quote($quoteDTO),
        ]);
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\StencilQuoteDTO $quoteDTO
     * @return \Illuminate\Support\Collection
     */
    protected function quoteWeightKg($quoteDTO)
    {
        return Collection::make([
            $this->weightCalculator->name() => $this->weightCalculator->quote($quoteDTO),
        ]);
    }
}
