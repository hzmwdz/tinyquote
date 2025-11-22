<?php

namespace Hzmwdz\Tinyquote\Validators;

use Illuminate\Support\Facades\Validator;

class AssemblyPriceBgaRuleValidator
{
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate($data)
    {
        return Validator::make($data, [
            'min_count' => 'required|integer|min:0',
            'max_count' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
        ])->validate();
    }
}
