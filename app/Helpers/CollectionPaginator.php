<?php

namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CollectionPaginator
{
    /**
     * Creates LengthAwarePaginator from array or collection.
     * 
     * @param array|Illuminate\Support\Collection $items Data that needs pagination.
     * @param integer $perPage Item count per page.
     */
    public static function paginate($items, $perPage)
    {
        $items  = Collection::make($items);
        $page   = Paginator::resolveCurrentPage('page');
        $total  = $items->count();

        return self::paginator($items->forPage($page, $perPage), $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }

    /**
     * Create a new length-aware paginator instance.
     * 
     * @param array|Illuminate\Support\Collection $items
     * @param integer $total
     * @param integer $perPage
     * @param integer $currentPage
     * @param array $options
     */
    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(
            LengthAwarePaginator::class,
            compact(
                'items',
                'total',
                'perPage',
                'currentPage',
                'options'
            )
        );
    }
}
