<?php

namespace Hzmwdz\Tinyquote\Repositories;

use Hzmwdz\Tinycore\Exceptions\InvalidArgumentException;
use Hzmwdz\Tinyquote\Support\ConfigHelper;
use Hzmwdz\Tinyquote\Support\TransHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class AbstractQuoteRuleRepository
{
    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @param string $modelClass
     * @throws \Hzmwdz\Tinycore\Exceptions\InvalidArgumentException
     */
    public function __construct($modelClass)
    {
        if (class_exists($modelClass) && is_subclass_of($modelClass, Model::class)) {
            $this->modelClass = $modelClass;
        } else {
            throw new InvalidArgumentException(
                TransHelper::theProvidedClassDoesNotExistOrIsNotAValidSubclassOfModel($modelClass)
            );
        }
    }

    /**
     * @param array $columns
     * @return \Illuminate\Support\Collection
     */
    public function all($columns = ['*'])
    {
        return Cache::remember($this->getCacheKey(), $this->getCacheTTL(), function () use ($columns) {
            return $this->modelClass::all($columns);
        });
    }

    /**
     * @param int $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->modelClass::find($id, $columns);
    }

    /**
     * @param callable|null $callback
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function firstFromCache($callback = null)
    {
        $all = $this->all();

        return $callback ? $all->first($callback) : $all->first();
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data)
    {
        $model = $this->modelClass::create($data);

        Cache::forget($this->getCacheKey());

        return $model;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     * @throws \Hzmwdz\Tinycore\Exceptions\InvalidArgumentException
     */
    public function update($id, $data)
    {
        $model = $this->find($id);

        if (!$model) {
            throw new InvalidArgumentException(
                TransHelper::quoteRuleNotFoundForModelWithId($this->modelClass, $id)
            );
        }

        $updated = $model->update($data);

        Cache::forget($this->getCacheKey());

        return $updated;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Hzmwdz\Tinycore\Exceptions\InvalidArgumentException
     */
    public function delete($id)
    {
        $model = $this->find($id);

        if (!$model) {
            throw new InvalidArgumentException(
                TransHelper::quoteRuleNotFoundForModelWithId($this->modelClass, $id)
            );
        }

        $deleted = $model->delete();

        Cache::forget($this->getCacheKey());

        return $deleted;
    }

    /**
     * @param array $rows
     * @param bool $truncate
     * @return void
     */
    public function import($rows, $truncate = true)
    {
        if (empty($rows)) {
            return;
        }

        DB::transaction(function () use ($rows, $truncate) {
            if ($truncate) {
                $this->modelClass::truncate();
            }

            $this->modelClass::insert($rows);
        });

        Cache::forget($this->getCacheKey());
    }

    /**
     * @param string $key
     * @return string
     */
    protected function getCacheKey($key = 'all')
    {
        $prefix = ConfigHelper::cachePrefix();

        $modelName = Str::snake(class_basename($this->modelClass));

        return sprintf('%s.%s.%s', $prefix, $modelName, $key);
    }

    /**
     * @return int
     */
    protected function getCacheTTL()
    {
        return ConfigHelper::cacheTTL();
    }
}
