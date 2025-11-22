<?php

namespace Hzmwdz\Tinyquote\Validators;

use Illuminate\Support\Facades\Validator;

class PcbQuoteValidator
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
            'material' => 'required|string',
            'layers' => 'required|integer|min:1',
            'thickness_mm' => 'required|numeric|gt:0',
            'copper_oz' => 'required|numeric|gt:0',
            'min_drill_mm' => 'required|numeric|gt:0',
            'min_trace_mil' => 'required|numeric|gt:0',
            'soldermask_color' => 'required|string',
            'silkscreen_color' => 'required|string',
            'surface_finish' => 'required|string',
            'design_count' => 'required|integer|min:1',
            'has_array' => 'required|boolean',
            'array_x_count' => 'required|integer|min:1',
            'array_y_count' => 'required|integer|min:1',
            'has_tab_route' => 'required|boolean',
            'has_v_scoring' => 'required|boolean',
            'accepts_x_out' => 'required|boolean',
        ])->validate();
    }
}
