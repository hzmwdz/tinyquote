<?php

namespace Hzmwdz\Tinyquote\Validators;

use Hzmwdz\Tinyquote\Support\TransHelper;
use Illuminate\Support\Facades\Validator;

class BomQuoteValidator
{
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate($data)
    {
        $validator = Validator::make($data, [
            'qty' => 'required|integer|gt:0',
            'bom_quote_lines' => 'required|array',
            'bom_quote_lines.*.part_number' => 'required|string',
            'bom_quote_lines.*.qty_per' => 'required|integer|gt:0',
            'bom_quote_lines.*.total_qty' => 'required|integer|gt:0',
            'bom_quote_lines.*.dont_install' => 'required|boolean',
            'bom_quote_lines.*.consign_qty' => 'required|integer|min:0',
            'bom_quote_lines.*.unit_price' => 'required|numeric|min:0',
            'bom_quote_lines.*.unit_weight_gram' => 'required|numeric|min:0',
        ]);

        $validator->after(function ($validator) use ($data) {
            foreach ($data['bom_quote_lines'] as $index => $line) {
                if ($line['total_qty'] != $line['qty_per'] * $data['qty']) {
                    $validator->errors()->add(
                        "bom_quote_lines.$index.total_qty",
                        TransHelper::theTotalQuantityMustBeEqualToQtyPerMultipliedByTheParentQty()
                    );
                }

                if (($line['consign_qty']) > ($line['total_qty'])) {
                    $validator->errors()->add(
                        "bom_quote_lines.$index.consign_qty",
                        TransHelper::theConsignQuantityCannotBeGreaterThanTheTotalQuantity()
                    );
                }
            }
        });

        return $validator->validate();
    }
}
