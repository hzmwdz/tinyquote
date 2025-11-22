<?php

namespace Hzmwdz\Tinyquote\Validators;

use Illuminate\Support\Facades\Validator;

class AssemblyQuoteValidator
{
    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate($data)
    {
        return Validator::make($data, [
            'qty' => 'required|integer|gt:0',
            'leadtime_hours' => 'required|integer|gt:0',
            'width_mm' => 'required|numeric|gt:0',
            'height_mm' => 'required|numeric|gt:0',
            'is_double_side' => 'required|boolean',
            'bom_line_count' => 'required|integer|min:0',
            'smt_count' => 'required|integer|min:0',
            'tht_count' => 'required|integer|min:0',
            'bga_count' => 'required|integer|min:0',
            'requires_conformal_coating' => 'required|boolean',
            'requires_lead_free' => 'required|boolean',
            'requires_xray_inspection' => 'required|boolean',
        ])->validate();
    }
}
