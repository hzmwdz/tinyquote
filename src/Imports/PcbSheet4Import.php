<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\PcbPriceCopperWeightRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\PcbPriceCopperWeightRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PcbSheet4Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceCopperWeightRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceCopperWeightRuleRepository $repository
     */
    public function __construct(PcbPriceCopperWeightRuleRepository $repository)
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
        return PcbPriceCopperWeightRuleValidator::validate([
            'copper_oz' => (float) $data[0],
            'price' => (float) $data[1],
            'description' => NullableValue::string($data[2]),
            'sort_order' => (int) $data[3],
        ]);
    }
}
