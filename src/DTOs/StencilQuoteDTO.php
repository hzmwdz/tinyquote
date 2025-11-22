<?php

namespace Hzmwdz\Tinyquote\DTOs;

use Hzmwdz\Tinycore\Exceptions\InvalidArgumentException;
use Hzmwdz\Tinyquote\Support\TransHelper;

class StencilQuoteDTO
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
     * @var string
     */
    public $frameType;

    /**
     * @var string
     */
    public $sizeMm;

    /**
     * @var float
     */
    public $thicknessMm;

    /**
     * @var string
     */
    public $fiducialType;

    /**
     * @var bool
     */
    public $hasElectropolishing;

    /**
     * @var float
     */
    public $widthMm;

    /**
     * @var float
     */
    public $heightMm;

    /**
     * @param int $qty
     * @param string $frameType
     * @param string $sizeMm
     * @param float $thicknessMm
     * @param string $fiducialType
     * @param bool $hasElectropolishing
     */
    public function __construct(
        $qty,
        $frameType,
        $sizeMm,
        $thicknessMm,
        $fiducialType,
        $hasElectropolishing
    ) {
        $this->qty = $qty;
        $this->leadtimeHours = 0;
        $this->frameType = $frameType;
        $this->sizeMm = $sizeMm;
        $this->thicknessMm = $thicknessMm;
        $this->fiducialType = $fiducialType;
        $this->hasElectropolishing = $hasElectropolishing;
        $this->parseSize();
    }

    /**
     * @return void
     * @throws \Hzmwdz\Tinycore\Exceptions\InvalidArgumentException
     */
    protected function parseSize()
    {
        $parts = explode('x', $this->sizeMm);

        if (count($parts) !== 2 || !is_numeric($parts[0]) || !is_numeric($parts[1])) {
            throw new InvalidArgumentException(
                TransHelper::invalidSizeFormatExpectWidthXHeightInMillimeters($this->sizeMm)
            );
        }

        [$widthMm, $heightMm] = array_map('floatval', $parts);

        if ($widthMm <= 0 || $heightMm <= 0) {
            throw new InvalidArgumentException(
                TransHelper::invalidSizeValuesWidthAndHeightMustBeGreaterThanZero($this->sizeMm)
            );
        }

        $this->widthMm = $widthMm;
        $this->heightMm = $heightMm;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray($data)
    {
        return new self(
            $data['qty'],
            $data['frame_type'],
            $data['size_mm'],
            $data['thickness_mm'],
            $data['fiducial_type'],
            $data['has_electropolishing'],
        );
    }

    /**
     * @return float
     */
    public function areaM2()
    {
        return round(($this->widthMm / 1000) * ($this->heightMm / 1000), 4);
    }

    /**
     * @return float
     */
    public function totalAreaM2()
    {
        return round($this->areaM2() * $this->qty, 4);
    }
}
