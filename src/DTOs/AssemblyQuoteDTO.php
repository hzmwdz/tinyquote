<?php

namespace Hzmwdz\Tinyquote\DTOs;

class AssemblyQuoteDTO
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
     * @var bool
     */
    public $isDoubleSide;

    /**
     * @var int
     */
    public $bomLineCount;

    /**
     * @var int
     */
    public $smtCount;

    /**
     * @var int
     */
    public $thtCount;

    /**
     * @var int
     */
    public $bgaCount;

    /**
     * @var bool
     */
    public $requiresConformalCoating;

    /**
     * @var bool
     */
    public $requiresLeadFree;

    /**
     * @var bool
     */
    public $requiresXrayInspection;

    /**
     * @param int $qty
     * @param int $leadtimeHours
     * @param bool $widthMm
     * @param bool $heightMm
     * @param bool $isDoubleSide
     * @param int $bomLineCount
     * @param int $smtCount
     * @param int $thtCount
     * @param int $bgaCount
     * @param bool $requiresConformalCoating
     * @param bool $requiresLeadFree
     * @param bool $requiresXrayInspection
     */
    public function __construct(
        $qty,
        $leadtimeHours,
        $widthMm,
        $heightMm,
        $isDoubleSide,
        $bomLineCount,
        $smtCount,
        $thtCount,
        $bgaCount,
        $requiresConformalCoating,
        $requiresLeadFree,
        $requiresXrayInspection
    ) {
        $this->qty = $qty;
        $this->leadtimeHours = $leadtimeHours;
        $this->widthMm = $widthMm;
        $this->heightMm = $heightMm;
        $this->isDoubleSide = $isDoubleSide;
        $this->bomLineCount = $bomLineCount;
        $this->smtCount = $smtCount;
        $this->thtCount = $thtCount;
        $this->bgaCount = $bgaCount;
        $this->requiresConformalCoating = $requiresConformalCoating;
        $this->requiresLeadFree = $requiresLeadFree;
        $this->requiresXrayInspection = $requiresXrayInspection;
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
            $data['is_double_side'],
            $data['bom_line_count'],
            $data['smt_count'],
            $data['tht_count'],
            $data['bga_count'],
            $data['requires_conformal_coating'],
            $data['requires_lead_free'],
            $data['requires_xray_inspection'],
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

    /**
     * @return int
     */
    public function smtTotal()
    {
        return $this->smtCount * $this->qty;
    }

    /**
     * @return int
     */
    public function thtTotal()
    {
        return $this->thtCount * $this->qty;
    }

    /**
     * @return int
     */
    public function bgaTotal()
    {
        return $this->bgaCount * $this->qty;
    }
}
