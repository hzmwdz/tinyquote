<?php

namespace Hzmwdz\Tinyquote\Quoters;

use Hzmwdz\Tinyquote\Quotations\BomQuotation;

class BomQuoter
{
    /**
     * @param \Hzmwdz\Tinyquote\DTOs\BomQuoteDTO $quoteDTO
     * @return \Hzmwdz\Tinyquote\Quotations\BomQuotation
     */
    public function quote($quoteDTO)
    {
        return new BomQuotation(
            $quoteDTO->qty,
            $quoteDTO->leadtimeHours,
            $quoteDTO->bomQuoteLines
        );
    }
}
