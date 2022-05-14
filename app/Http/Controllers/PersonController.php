<?php

namespace App\Http\Controllers;

use App\Helpers\CollectionPaginator;
use App\Models\Person;
use Illuminate\Support\Facades\Cache;

class PersonController extends Controller
{
    public function index()
    {
        $people     = null;
        $year       = request('birth-year');
        $month      = request('birth-month');
        $duration   = 60;     // cache duration
        $limit      = 20;     // items to display per page

        if ($year && $month) {
            $tags       = ['people', 'birth_year_and_month'];
            $keyHash    = md5(sprintf('people.list.birth_year:%1$d.birth_month:%2$d', $year, $month));

            if (!Cache::tags($tags)->has($keyHash)) {
                $value = Person::whereYear('dob', '=', $year)->whereMonth('dob', '=', $month)->get();
                $this->addTaggedCache($tags, $keyHash, $value, $duration);
            }

            $people = $this->paginateFromCache($tags, $keyHash, $limit);
        } elseif ($year) {
            $tags       = ['people', 'birth_year'];
            $keyHash    = md5(sprintf('people.list.birth_year:%1$d', $year));

            if (!Cache::tags($tags)->has($keyHash)) {
                $value = Person::whereYear('dob', '=', $year)->get();
                $this->addTaggedCache($tags, $keyHash, $value, $duration);
            }

            $people = $this->paginateFromCache($tags, $keyHash, $limit);
        } elseif ($month) {
            $tags       = ['people', 'birth_month'];
            $keyHash    = md5(sprintf('people.list.birth_month:%1$d', $month));

            if (!Cache::tags($tags)->has($keyHash)) {
                $value = Person::whereMonth('dob', '=', $month)->get();
                $this->addTaggedCache($tags, $keyHash, $value, $duration);
            }

            $people = $this->paginateFromCache($tags, $keyHash, $limit);
        } else {
            $people = Person::paginate($limit);
        }

        return view('people', ['people' => $people]);
    }

    /**
     * Removes existing caches by tags and adds new cache entry.
     * 
     * @param array $tags Cache tags.
     * @param string $key Cache key.
     * @param mixed $value Query result from database to be stored in cache.
     * @param integer $duration Cache duration.
     */
    protected function addTaggedCache($tags, $key, $value, $duration)
    {
        Cache::tags($tags)->flush();
        Cache::tags($tags)->put($key, $value, $duration);
    }

    /**
     * Creates lengthAwarePagination from cache and returns it.
     * 
     * @param array $tags Cache tags.
     * @param string $key Cache key.
     * @param integer $limit Items to display per page.
     */
    protected function paginateFromCache($tags, $key, $limit)
    {
        $result = Cache::tags($tags)->get($key);
        return CollectionPaginator::paginate($result, $limit);
    }
}
