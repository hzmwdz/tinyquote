<?php

namespace Hzmwdz\Tinyquote\Imports;

use Hzmwdz\Tinyquote\Repositories\PcbPriceSurfaceFinishRuleRepository;
use Hzmwdz\Tinyquote\Support\NullableValue;
use Hzmwdz\Tinyquote\Validators\PcbPriceSurfaceFinishRuleValidator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PcbSheet6Import extends AbstractQuoteRuleImport implements ToCollection
{
    /**
     * @var \Hzmwdz\Tinyquote\Repositories\PcbPriceSurfaceFinishRuleRepository
     */
    protected $repository;

    /**
     * @param \Hzmwdz\Tinyquote\Repositories\PcbPriceSurfaceFinishRuleRepository $repository
     */
    public function __construct(PcbPriceSurfaceFinishRuleRepository $repository)
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
        return PcbPriceSurfaceFinishRuleValidator::validate([
            'surface_finish' => (string) $data[0],
            'price' => (float) $data[1],
            'description' => NullableValue::string($data[2]),
            'sort_order' => (int) $data[3],
        ]);
    }
}
