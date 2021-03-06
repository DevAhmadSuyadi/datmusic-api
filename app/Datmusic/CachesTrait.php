<?php
/**
 * Copyright (c) 2017  Alashov Berkeli
 * It is licensed under GNU GPL v. 2 or later. For full terms see the file LICENSE.
 */

namespace App\Datmusic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

trait CachesTrait
{
    /**
     * Get current request cache key
     * @param Request $request
     * @return string
     */
    private function getCacheKey($request)
    {
        $q = strtolower($request->get('q'));
        $page = abs(intval($request->get('page')));

        $q = empty($q) ? md5('popular') : $q;

        return hash(config('app.hash.cache'), ($q . $page));
    }

    /**
     * Whether current request is already cached
     * @param Request $request
     * @return mixed
     */
    private function hasRequestInCache($request)
    {
        return Cache::has($this->getCacheKey($request));
    }

    /**
     * Get audio item from cache or abort with 404 if not found
     * @param string $key
     * @param string $id
     * @return mixed
     */
    public function getAudio($key, $id)
    {
        // get search cache instance
        $data = Cache::get($key);

        if (is_null($data)) {
            abort(404);
        }

        // search audio by audio id/hash
        $key = array_search($id, array_column($data, 'id'));

        if ($key === false) {
            abort(404);
        }

        return $data[$key];
    }
}