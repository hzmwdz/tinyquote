<?php

namespace Hzmwdz\Tinyquote\Quoters;

use Hzmwdz\Tinyquote\Calculators\PcbPriceBaseCalculator;
use Hzmwdz\Tinyquote\Calculators\PcbPriceBoardCalculator;
use Hzmwdz\Tinyquote\Calculators\PcbPriceCopperWeightCalculator;
use Hzmwdz\Tinyquote\Calculators\PcbPriceSoldermaskColorCalculator;
use Hzmwdz\Tinyquote\Calculators\PcbPriceSurfaceFinishCalculator;
use Hzmwdz\Tinyquote\Calculators\PcbPriceThicknessCalculator;
use Hzmwdz\Tinyquote\Calculators\PcbWeightCalculator;
use Hzmwdz\Tinyquote\Quotations\PcbQuotation;
use Illuminate\Support\Collection;

class PcbQuoter
{
    /**
     * @var \Hzmwdz\Tinyquote\Calculators\PcbPriceBaseCalculator
     */
    protected $priceBaseCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\PcbPriceBoardCalculator
     */
    protected $priceBoardCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\PcbPriceCopperWeightCalculator
     */
    protected $priceCopperWeightCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\PcbPriceSoldermaskColorCalculator
     */
    protected $priceSoldermaskColorCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\PcbPriceSurfaceFinishCalculator
     */
    protected $priceSurfaceFinishCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\PcbPriceThicknessCalculator
     */
    protected $priceThicknessCalculator;

    /**
     * @var \Hzmwdz\Tinyquote\Calculators\PcbWeightCalculator
     */
    protected $weightCalculator;

    /**
     * @param \Hzmwdz\Tinyquote\Calculators\PcbPriceBaseCalculator $priceBaseCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\PcbPriceBoardCalculator $priceBoardCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\PcbPriceCopperWeightCalculator $priceCopperWeightCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\PcbPriceSoldermaskColorCalculator $priceSoldermaskColorCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\PcbPriceSurfaceFinishCalculator $priceSurfaceFinishCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\PcbPriceThicknessCalculator $priceThicknessCalculator
     * @param \Hzmwdz\Tinyquote\Calculators\PcbWeightCalculator $weightCalculator
     */
    public function __construct(
        PcbPriceBaseCalculator $priceBaseCalculator,
        PcbPriceBoardCalculator $priceBoardCalculator,
        PcbPriceCopperWeightCalculator $priceCopperWeightCalculator,
        PcbPriceSoldermaskColorCalculator $priceSoldermaskColorCalculator,
        PcbPriceSurfaceFinishCalculator $priceSurfaceFinishCalculator,
        PcbPriceThicknessCalculator $priceThicknessCalculator,
        PcbWeightCalculator $weightCalculator
    ) {
        $this->priceBaseCalculator = $priceBaseCalculator;
        $this->priceBoardCalculator = $priceBoardCalculator;
        $this->priceCopperWeightCalculator = $priceCopperWeightCalculator;
        $this->priceSoldermaskColorCalculator = $priceSoldermaskColorCalculator;
        $this->priceSurfaceFinishCalculator = $priceSurfaceFinishCalculator;
        $this->priceThicknessCalculator = $priceThicknessCalculator;
        $this->weightCalculator = $weightCalculator;
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return \Hzmwdz\Tinyquote\Quotations\PcbQuotation
     */
    public function quote($quoteDTO)
    {
        $priceBreakdown = $this->quotePrice($quoteDTO);

        $weightBreakdownKg = $this->quoteWeightKg($quoteDTO);

        return new PcbQuotation(
            $quoteDTO->qty,
            $quoteDTO->leadtimeHours,
            $priceBreakdown,
            $weightBreakdownKg
        );
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return \Illuminate\Support\Collection
     */
    protected function quotePrice($quoteDTO)
    {
        return Collection::make([
            $this->priceBaseCalculator->name() => $this->priceBaseCalculator->quote($quoteDTO),
            $this->priceBoardCalculator->name() => $this->priceBoardCalculator->quote($quoteDTO),
            $this->priceCopperWeightCalculator->name() => $this->priceCopperWeightCalculator->quote($quoteDTO),
            $this->priceSoldermaskColorCalculator->name() => $this->priceSoldermaskColorCalculator->quote($quoteDTO),
            $this->priceSurfaceFinishCalculator->name() => $this->priceSurfaceFinishCalculator->quote($quoteDTO),
            $this->priceThicknessCalculator->name() => $this->priceThicknessCalculator->quote($quoteDTO),
        ]);
    }

    /**
     * @param \Hzmwdz\Tinyquote\DTOs\PcbQuoteDTO $quoteDTO
     * @return \Illuminate\Support\Collection
     */
    protected function quoteWeightKg($quoteDTO)
    {
        return Collection::make([
            $this->weightCalculator->name() => $this->weightCalculator->quote($quoteDTO),
        ]);
    }
}
