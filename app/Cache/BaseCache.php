<?php

namespace App\Cache;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use App\Models\ModelContract;

abstract class BaseCache
{
    /**
     * @var string
     */
    protected string $keyCollection;

    /**
     * @var string
     */
    protected string $key;

    public function __construct()
    {
        $this->setDefaultKey();
    }

    abstract protected function setDefaultKey();

    /**
     * @param string $key
     * @param bool $collection
     * @return void
     */
    public function setKey(string $key, bool $collection = false)
    {
        if ($collection) {
            $this->keyCollection = $key;
        } else {
            $this->key = $key;
        }
    }

    /**
     * @param ModelContract $model
     * @param string $event
     */
    public function recycle(ModelContract $model, string $event)
    {
        if (Cache::has($this->keyCollection)) {
            $cacheCollection = Cache::get($this->keyCollection);

            if ($event == 'created') {
                $this->created($cacheCollection, $model);
            }

            if (in_array($event, ['updated', 'restored'])) {
                $this->updated($cacheCollection, $model);
            }

            if (in_array($event, ['deleted', 'forceDeleted'])) {
                $this->deleted($cacheCollection, $model);
            }
        }

        if (Cache::has($this->key)) {
            Cache::forget($this->key);
        }
    }

    /**
     * @param Paginator $cacheCollection
     * @param ModelContract $model
     * @return void
     */
    private function created(Paginator $cacheCollection, ModelContract $model)
    {
        Cache::forget($this->keyCollection);
        $cacheCollection->push($model);
        Cache::forever($this->keyCollection, $cacheCollection);
    }

    /**
     * @param Paginator $cacheCollection
     * @param ModelContract $model
     * @return void
     */
    private function updated(Paginator $cacheCollection, ModelContract $model)
    {
        Cache::forget($this->keyCollection);

        $collection = $cacheCollection->filter(function ($cacheAccount) use ($model) {
            return $cacheAccount->id != $model->id;
        });

        $cacheCollection->push($collection);

        Cache::forever($this->keyCollection, $collection->simplePaginate(env('SIMPLE_PAGINATE_PER_PAGE')));
    }

    /**
     * @param Paginator $cacheCollection
     * @param ModelContract $model
     * @return void
     */
    private function deleted(Paginator $cacheCollection, ModelContract $model)
    {
        Cache::forget($this->keyCollection);

        $collection = $cacheCollection->filter(function ($cacheItem) use ($model) {
            return $cacheItem->id != $model->id;
        });

        Cache::forever($this->keyCollection, $collection->simplePaginate(env('SIMPLE_PAGINATE_PER_PAGE')));
    }
}
