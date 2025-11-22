<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\AssemblyPriceThtRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\AssemblyPriceThtRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AssemblySheet4Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceThtRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceThtRuleRepository $repository
     */
    public function __construct(AssemblyPriceThtRuleRepository $repository)
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
        return AssemblyPriceThtRuleValidator::validate([
            'min_count' => (int) $data[0],
            'max_count' => (int) $data[1],
            'leadtime_hours' => (int) $data[2],
            'price' => NullableValue::float($data[3]),
            'description' => NullableValue::string($data[4]),
            'sort_order' => (int) $data[5],
        ]);
    }
}
