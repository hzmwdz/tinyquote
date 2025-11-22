<?php

namespace Hzmwdz\Tinyquote\Validators;

use Illuminate\Support\Facades\Validator;

class StencilPriceBaseRuleValidator
{
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate($data)
    {
        return Validator::make($data, [
            'frame_type' => 'required|string|max:255',
            'width_mm' => 'required|numeric|min:0',
            'height_mm' => 'required|numeric|min:0',
            'thickness_mm' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
        ])->validate();
    }
}
