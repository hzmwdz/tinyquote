<?php

namespace Hzmwdz\Tinyquote\Support;

use Illuminate\Support\Facades\Lang;

class TransHelper
{
    public const NAMESPACE = 'tinyquote';

    /**
     * @param string $key
     * @param array $replace
     * @return string
     */
    public static function get($key, $replace = [])
    {
        return Lang::get(static::NAMESPACE . "::messages.{$key}", $replace);
    }

    /**
     * @param string $size
     * @return string
     */
    public static function invalidSizeFormatExpectWidthXHeightInMillimeters($size)
    {
        return self::get('invalid_size_format_expect_width_x_height_in_millimeters', [
            'size' => $size,
        ]);
    }

    /**
     * @param string $size
     * @return string
     */
    public static function invalidSizeValuesWidthAndHeightMustBeGreaterThanZero($size)
    {
        return self::get('invalid_size_values_width_and_height_must_be_greater_than_zero', [
            'size' => $size,
        ]);
    }

    /**
     * @param string $model
     * @param int $id
     * @return string
     */
    public static function quoteRuleNotFoundForModelWithId($model, $id)
    {
        $modelName = class_basename($model);

        return self::get('quote_rule_not_found_for_model_with_id', [
            'model' => $modelName,
            'id' => $id,
        ]);
    }

    /**
     * @return string
     */
    public static function theConsignQuantityCannotBeGreaterThanTheTotalQuantity()
    {
        return self::get('the_consign_quantity_cannot_be_greater_than_the_total_quantity');
    }

    /**
     * @param string $class
     * @return string
     */
    public static function theProvidedClassDoesNotExistOrIsNotAValidSubclassOfModel($class)
    {
        $className = class_basename($class);

        return self::get('the_provided_class_does_not_exist_or_is_not_a_valid_subclass_of_model', [
            'class' => $className,
        ]);
    }

    /**
     * @return string
     */
    public static function theTotalQuantityMustBeEqualToQtyPerMultipliedByTheParentQty()
    {
        return self::get('the_total_quantity_must_be_equal_to_qty_per_multiplied_by_the_parent_qty');
    }
}
