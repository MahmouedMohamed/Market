<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PaginationService
{
    public function paginate(Builder $model, $pageName, $min, $max): LengthAwarePaginator
    {
        $model = $model->skip($min * ((request()->$pageName ?? 1) - 1))
            ->take(min($min, $max - ($min * (request()->$pageName - 1 ?? 0))))
            ->get();

        return new LengthAwarePaginator(
            $model->toArray(),
            max($model->count(), $max),
            $min,
            request()->$pageName ?? 1,
            [
                'pageName' => $pageName,
                'path' => Paginator::resolveCurrentPath(),
            ]
        );
    }
}
