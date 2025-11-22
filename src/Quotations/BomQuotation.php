<?php

namespace Hzmwdz\Tinyquote\Quotations;

use Hzmwdz\Tinyquote\Contracts\QuotationInterface;
use Hzmwdz\Tinyquote\DTOs\BomQuoteLineDTO;

class BomQuotation implements QuotationInterface
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
    protected $bomQuoteLines;

    /**
     * @param int $qty
     * @param int $leadtimeHours
     * @param \Illuminate\Support\Collection $bomQuoteLines
     */
    public function __construct(
        $qty,
        $leadtimeHours,
        $bomQuoteLines
    ) {
        $this->qty = $qty;
        $this->leadtimeHours = $leadtimeHours;
        $this->bomQuoteLines = $bomQuoteLines;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->bomQuoteLines->isNotEmpty();
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
    public function bomQuoteLines()
    {
        return $this->bomQuoteLines;
    }

    /**
     * @return float
     */
    public function totalPrice()
    {
        if (!$this->isValid()) {
            return 0.0;
        }

        $totalPrice = $this->bomQuoteLines->sum(function (BomQuoteLineDTO $line) {
            return $line->totalPrice();
        });

        return round($totalPrice, 4);
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

        $totalWeightGram = $this->bomQuoteLines->sum(function (BomQuoteLineDTO $line) {
            return $line->totalWeightGram();
        });

        return round($totalWeightGram / 1000, 4);
    }

    /**
     * @return float
     */
    public function unitWeightKg()
    {
        return round($this->totalWeightKg() / $this->qty, 4);
    }

    /**
     * @return int
     */
    public function qtyPer()
    {
        if (!$this->isValid()) {
            return 0;
        }

        return $this->bomQuoteLines->sum(function (BomQuoteLineDTO $line) {
            return $line->qtyPer;
        });
    }

    /**
     * @return int
     */
    public function totalLineCount()
    {
        if (!$this->isValid()) {
            return 0;
        }

        return $this->bomQuoteLines->count();
    }

    /**
     * @return int
     */
    public function dontInstallLineCount()
    {
        if (!$this->isValid()) {
            return 0;
        }

        return $this->bomQuoteLines->filter(function (BomQuoteLineDTO $line) {
            return $line->dontInstall;
        })->count();
    }

    /**
     * @return int
     */
    public function consignLineCount()
    {
        if (!$this->isValid()) {
            return 0;
        }

        return $this->bomQuoteLines->filter(function (BomQuoteLineDTO $line) {
            return $line->isConsigned();
        })->count();
    }

    /**
     * @return int
     */
    public function purchaseLineCount()
    {
        if (!$this->isValid()) {
            return 0;
        }

        return $this->bomQuoteLines->filter(function (BomQuoteLineDTO $line) {
            return $line->isPurchased();
        })->count();
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
            'bom_quote_lines' => $this->bomQuoteLines()->toArray(),
            'total_price' => $this->totalPrice(),
            'unit_price' => $this->unitPrice(),
            'total_weight_kg' => $this->totalWeightKg(),
            'unit_weight_kg' => $this->unitWeightKg(),
            'qty_per' => $this->qtyPer(),
            'total_line_count' => $this->totalLineCount(),
            'dontinstall_line_count' => $this->dontInstallLineCount(),
            'consign_line_count' => $this->consignLineCount(),
            'purchase_line_count' => $this->purchaseLineCount(),
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
