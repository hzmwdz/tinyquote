<?php

namespace Hzmwdz\Tinyquote\DTOs;

class PcbQuoteDTO
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
     * @var float
     */
    public $widthMm;

    /**
     * @var float
     */
    public $heightMm;

    /**
     * @var string
     */
    public $material;

    /**
     * @var int
     */
    public $layers;

    /**
     * @var float
     */
    public $thicknessMm;

    /**
     * @var float
     */
    public $copperOz;

    /**
     * @var float
     */
    public $minDrillMm;

    /**
     * @var float
     */
    public $minTraceMil;

    /**
     * @var string
     */
    public $soldermaskColor;

    /**
     * @var string
     */
    public $silkscreenColor;

    /**
     * @var string
     */
    public $surfaceFinish;

    /**
     * @var int
     */
    public $designCount;

    /**
     * @var bool
     */
    public $hasArray;

    /**
     * @var int
     */
    public $arrayXCount;

    /**
     * @var int
     */
    public $arrayYCount;

    /**
     * @var bool
     */
    public $hasTabRoute;

    /**
     * @var bool
     */
    public $hasVScoring;

    /**
     * @var bool
     */
    public $acceptsXOut;

    /**
     * @param int $qty
     * @param int $leadtimeHours
     * @param float $widthMm
     * @param float $heightMm
     * @param string $material
     * @param int $layers
     * @param float $thicknessMm
     * @param float $copperOz
     * @param float $minDrillMm
     * @param float $minTraceMil
     * @param string $soldermaskColor
     * @param string $silkscreenColor
     * @param string $surfaceFinish
     * @param int $designCount
     * @param bool $hasArray
     * @param int $arrayXCount
     * @param int $arrayYCount
     * @param bool $hasTabRoute
     * @param bool $hasVScoring
     * @param bool $acceptsXOut
     */
    public function __construct(
        $qty,
        $leadtimeHours,
        $widthMm,
        $heightMm,
        $material,
        $layers,
        $thicknessMm,
        $copperOz,
        $minDrillMm,
        $minTraceMil,
        $soldermaskColor,
        $silkscreenColor,
        $surfaceFinish,
        $designCount,
        $hasArray,
        $arrayXCount,
        $arrayYCount,
        $hasTabRoute,
        $hasVScoring,
        $acceptsXOut
    ) {
        $this->qty = $qty;
        $this->leadtimeHours = $leadtimeHours;
        $this->widthMm = $widthMm;
        $this->heightMm = $heightMm;
        $this->material = $material;
        $this->layers = $layers;
        $this->thicknessMm = $thicknessMm;
        $this->copperOz = $copperOz;
        $this->minDrillMm = $minDrillMm;
        $this->minTraceMil = $minTraceMil;
        $this->soldermaskColor = $soldermaskColor;
        $this->silkscreenColor = $silkscreenColor;
        $this->surfaceFinish = $surfaceFinish;
        $this->designCount = $designCount;
        $this->hasArray = $hasArray;
        $this->arrayXCount = $arrayXCount;
        $this->arrayYCount = $arrayYCount;
        $this->hasTabRoute = $hasTabRoute;
        $this->hasVScoring = $hasVScoring;
        $this->acceptsXOut = $acceptsXOut;
    }

    /**
     * @param array $data
     * @return self
     */
    public static function fromArray($data)
    {
        return new self(
            $data['qty'],
            $data['leadtime_hours'],
            $data['width_mm'],
            $data['height_mm'],
            $data['material'],
            $data['layers'],
            $data['thickness_mm'],
            $data['copper_oz'],
            $data['min_drill_mm'],
            $data['min_trace_mil'],
            $data['soldermask_color'],
            $data['silkscreen_color'],
            $data['surface_finish'],
            $data['design_count'],
            $data['has_array'],
            $data['array_x_count'],
            $data['array_y_count'],
            $data['has_tab_route'],
            $data['has_v_scoring'],
            $data['accepts_x_out'],
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
