<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\PcbPriceSoldermaskColorRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\PcbPriceSoldermaskColorRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PcbSheet5Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceSoldermaskColorRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceSoldermaskColorRuleRepository $repository
     */
    public function __construct(PcbPriceSoldermaskColorRuleRepository $repository)
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
        return PcbPriceSoldermaskColorRuleValidator::validate([
            'soldermask_color' => (string) $data[0],
            'price' => (float) $data[1],
            'description' => NullableValue::string($data[2]),
            'sort_order' => (int) $data[3],
        ]);
    }
}
