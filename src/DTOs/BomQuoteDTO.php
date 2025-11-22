<?php

namespace Hzmwdz\Tinyquote\DTOs;

use Illuminate\Support\Collection;

class BomQuoteDTO
{
    /**
     * @var int
     */
    public $qty;

    /**
     * @var int
     */
    public $leadtimeHours;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $bomQuoteLines;

    /**
     * @param int $qty
     * @param \Illuminate\Support\Collection $bomQuoteLines
     */
    public function __construct(
        $qty,
        $bomQuoteLines
    ) {
        $this->qty = $qty;
        $this->leadtimeHours = 0;
        $this->bomQuoteLines = $bomQuoteLines;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray($data)
    {
        $bomQuoteLines = Collection::make($data['bom_quote_lines'] ?? [])->map(function ($bomQuoteLine) {
            return BomQuoteLineDTO::fromArray($bomQuoteLine);
        });

        return new self(
            $data['qty'],
            $bomQuoteLines,
        );
    }
}
