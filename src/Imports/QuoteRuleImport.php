<?php

namespace Hzmwdz\Tinyquote\Imports;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class QuoteRuleImport implements WithMultipleSheets
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = Str::title($type);
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $files = glob(__DIR__ . "/{$this->type}*.php");

        foreach ($files as $file) {
            $classname = pathinfo($file, PATHINFO_FILENAME);

            $class = __NAMESPACE__ . '\\' . $classname;

            if (class_exists($class)) {
                $sheets[] = App::make($class);
            }
        }

        return $sheets;
    }
}
