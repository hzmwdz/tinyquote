<?php

namespace Hzmwdz\Tinyquote\Validators;

use Illuminate\Support\Facades\Validator;

class StencilQuoteValidator
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
            'frame_type' => 'required|string',
            'size_mm' => ['required', 'string', 'regex:/^\d+x\d+$/'],
            'thickness_mm' => 'required|numeric|gt:0',
            'fiducial_type' => 'required|string',
            'has_electropolishing' => 'required|bool',
        ])->validate();
    }
}
