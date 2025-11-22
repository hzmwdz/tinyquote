<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\AssemblyPriceBgaRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\AssemblyPriceBgaRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AssemblySheet5Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBgaRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\AssemblyPriceBgaRuleRepository $repository
     */
    public function __construct(AssemblyPriceBgaRuleRepository $repository)
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
        return AssemblyPriceBgaRuleValidator::validate([
            'min_count' => (int) $data[0],
            'max_count' => (int) $data[1],
            'price' => (float) $data[2],
            'description' => NullableValue::string($data[3]),
            'sort_order' => (int) $data[4],
        ]);
    }
}
