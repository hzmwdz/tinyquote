<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\StencilPriceBaseRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\StencilPriceBaseRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StencilSheet1Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\StencilPriceBaseRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\StencilPriceBaseRuleRepository $repository
     */
    public function __construct(StencilPriceBaseRuleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Illuminate\Support\Collection $collection
     */
    public function collection(Collection $collection)
    {
        $rows = $this->getValidRows($collection);

        $this->repository->import($rows);
    }

    /**
     * @param array $data
     * @return array
     */
    protected function validate($data)
    {
        return StencilPriceBaseRuleValidator::validate([
            'frame_type' => (string) $data[0],
            'width_mm' => (float) $data[1],
            'height_mm' => (float) $data[2],
            'thickness_mm' => (float) $data[3],
            'price' => (float) $data[4],
            'description' => NullableValue::string($data[5]),
            'sort_order' => (int) $data[6],
        ]);
    }
}
