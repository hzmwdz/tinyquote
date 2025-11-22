<?php

namespace Hzmwdz\Tinyquote\Imports;

use Illuminate\Support\Collection;

abstract class AbstractQuoteRuleImport
{
    /**
     * @param \Illuminate\Support\Collection $collection
     * @return array
     */
    protected function getValidRows(Collection $collection)
    {
        if ($collection->count() <= 2) {
            return [];
        }

        return $collection->skip(2)->map(function ($row) {
            return $this->validate($row);
        })->filter()->all();
    }

    /**
     * @param array $data
     * @return array
     */
    abstract protected function validate($data);
}
