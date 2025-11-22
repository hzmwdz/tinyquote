<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\AssemblyPriceBomLineRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\AssemblyPriceBomLineRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AssemblySheet2Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBomLineRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBomLineRuleRepository $repository
     */
    public function __construct(AssemblyPriceBomLineRuleRepository $repository)
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
        return AssemblyPriceBomLineRuleValidator::validate([
            'start_lines' => (int) $data[0],
            'start_price' => (float) $data[1],
            'step_qty' => (int) $data[2],
            'step_price' => (float) $data[3],
            'description' => NullableValue::string($data[4]),
            'sort_order' => (int) $data[5],
        ]);
    }
}
