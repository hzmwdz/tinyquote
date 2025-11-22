<?php

namespace Hzmwdz\Tinyquote\Validators;

use Illuminate\Support\Facades\Validator;

class PcbPriceBaseRuleValidator
{
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate($data)
    {
        return Validator::make($data, [
            'material' => 'required|string|max:255',
            'layers' => 'required|integer|min:1',
            'min_area_m2' => 'required|numeric|min:0',
            'max_area_m2' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
        ])->validate();
    }
}
