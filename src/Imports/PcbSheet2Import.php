<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\PcbPriceBoardRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\PcbPriceBoardRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PcbSheet2Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceBoardRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceBoardRuleRepository $repository
     */
    public function __construct(PcbPriceBoardRuleRepository $repository)
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
        return PcbPriceBoardRuleValidator::validate([
            'material' => (string) $data[0],
            'layers' => (int) $data[1],
            'min_area_m2' => (float) $data[2],
            'max_area_m2' => (float) $data[3],
            'leadtime_hours' => (int) $data[4],
            'price' => NullableValue::float($data[5]),
            'description' => NullableValue::string($data[6]),
            'sort_order' => (int) $data[7],
        ]);
    }
}
