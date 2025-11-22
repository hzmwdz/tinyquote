<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\PcbPriceBaseRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\PcbPriceBaseRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PcbSheet1Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceBaseRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceBaseRuleRepository $repository
     */
    public function __construct(PcbPriceBaseRuleRepository $repository)
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
        return PcbPriceBaseRuleValidator::validate([
            'material' => (string) $data[0],
            'layers' => (int) $data[1],
            'min_area_m2' => (float) $data[2],
            'max_area_m2' => (float) $data[3],
            'price' => (float) $data[4],
            'description' => NullableValue::string($data[5]),
            'sort_order' => (int) $data[6],
        ]);
    }
}
