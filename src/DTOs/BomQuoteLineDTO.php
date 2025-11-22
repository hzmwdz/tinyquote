<?php

namespace Hzmwdz\Tinyquote\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class BomQuoteLineDTO implements Arrayable, JsonSerializable
{
    /**
     * @var string
     */
    public $partNumber;

    /**
     * @var int
     */
    public $qtyPer;

    /**
     * @var int
     */
    public $totalQty;

    /**
     * @var bool
     */
    public $dontInstall;

    /**
     * @var int
     */
    public $consignQty;

    /**
     * @var float
     */
    public $unitPrice;

    /**
     * @var float
     */
    public $unitWeightGram;

    /**
     * @param string $partNumber
     * @param int $qtyPer
     * @param int $totalQty
     * @param bool $dontInstall
     * @param int $consignQty
     * @param float $unitPrice
     * @param float $unitWeightGram
     */
    public function __construct(
        $partNumber,
        $qtyPer,
        $totalQty,
        $dontInstall,
        $consignQty,
        $unitPrice,
        $unitWeightGram
    ) {
        $this->partNumber = $partNumber;
        $this->qtyPer = $qtyPer;
        $this->totalQty = $totalQty;
        $this->dontInstall = $dontInstall;
        $this->consignQty = $consignQty;
        $this->unitPrice = $unitPrice;
        $this->unitWeightGram = $unitWeightGram;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray($data)
    {
        return new self(
            $data['part_number'],
            $data['qty_per'],
            $data['total_qty'],
            $data['dont_install'],
            $data['consign_qty'],
            $data['unit_price'],
            $data['unit_weight_gram'],
        );
    }

    /**
     * @return bool
     */
    public function isConsigned()
    {
        if ($this->dontInstall) {
            return false;
        }

        return $this->consignQty > 0;
    }

    /**
     * @return int
     */
    public function purchaseQty()
    {
        if ($this->dontInstall) {
            return 0;
        }

        return $this->totalQty - $this->consignQty;
    }

    /**
     * @return bool
     */
    public function isPurchased()
    {
        if ($this->dontInstall) {
            return false;
        }

        return $this->purchaseQty() > 0;
    }

    /**
     * @return float
     */
    public function totalPrice()
    {
        if ($this->dontInstall) {
            return 0.0;
        }

        return round($this->unitPrice * $this->purchaseQty(), 4);
    }

    /**
     * @return float
     */
    public function totalWeightGram()
    {
        if ($this->dontInstall) {
            return 0.0;
        }

        return round($this->unitWeightGram * $this->totalQty, 4);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'part_number' => $this->partNumber,
            'qty_per' => $this->qtyPer,
            'total_qty' => $this->totalQty,
            'dont_install' => $this->dontInstall,
            'consign_qty' => $this->consignQty,
            'unit_price' => $this->unitPrice,
            'unit_weight_gram' => $this->unitWeightGram,
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
