<?php

namespace Hzmwdz\Tinyquote\Quotations;

use Hzmwdz\Tinyquote\Contracts\QuotationInterface;

class StencilQuotation implements QuotationInterface
{
    /**
     * @var int
     */
    protected $qty;

    /**
     * @var int
     */
    protected $leadtimeHours;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $priceBreakdown;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $weightBreakdownKg;

    /**
     * @param int $qty
     * @param int $leadtimeHours
     * @param \Illuminate\Support\Collection $priceBreakdown
     * @param \Illuminate\Support\Collection $weightBreakdownKg
     */
    public function __construct(
        $qty,
        $leadtimeHours,
        $priceBreakdown,
        $weightBreakdownKg
    ) {
        $this->qty = $qty;
        $this->leadtimeHours = $leadtimeHours;
        $this->priceBreakdown = $priceBreakdown;
        $this->weightBreakdownKg = $weightBreakdownKg;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->priceBreakdown->containsStrict(null)) {
            return false;
        }

        if ($this->weightBreakdownKg->containsStrict(null)) {
            return false;
        }

        return true;
    }

    /**
     * @return int
     */
    public function qty()
    {
        return $this->qty;
    }

    /**
     * @return int
     */
    public function leadtimeHours()
    {
        return $this->leadtimeHours;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function priceBreakdown()
    {
        return $this->priceBreakdown;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function weightBreakdownKg()
    {
        return $this->weightBreakdownKg;
    }

    /**
     * @return float
     */
    public function totalPrice()
    {
        if (!$this->isValid()) {
            return 0.0;
        }

        return round($this->priceBreakdown->sum(), 4);
    }

    /**
     * @return float
     */
    public function unitPrice()
    {
        return round($this->totalPrice() / $this->qty, 4);
    }

    /**
     * @return float
     */
    public function totalWeightKg()
    {
        if (!$this->isValid()) {
            return 0.0;
        }

        return round($this->weightBreakdownKg->sum(), 4);
    }

    /**
     * @return float
     */
    public function unitWeightKg()
    {
        return round($this->totalWeightKg() / $this->qty, 4);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'is_valid' => $this->isValid(),
            'qty' => $this->qty(),
            'leadtime_hours' => $this->leadtimeHours(),
            'price_breakdown' => $this->priceBreakdown()->toArray(),
            'weight_breakdown_kg' => $this->weightBreakdownKg()->toArray(),
            'total_price' => $this->totalPrice(),
            'unit_price' => $this->unitPrice(),
            'total_weight_kg' => $this->totalWeightKg(),
            'unit_weight_kg' => $this->unitWeightKg(),
        ];
    }

    /**
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
