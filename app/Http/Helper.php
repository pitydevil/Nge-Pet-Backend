<?php

namespace App\Http;

use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Helper {
    public static function paginate($paginator) {
        $totalPage = (($paginator->total() - ($paginator->total() % $paginator->perPage())) / $paginator->perPage()) + 1;
        $result = [
            'limit' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'total_page' => $totalPage,
            'count' => $paginator->count(),
            'total' => $paginator->total(),
            'data' => $paginator->items(),
        ];
        return $result;
    }

    public static function paginateArray($items, $perPage = 25, $page = null, $options = []){
        $page = $page ?: Paginator::resolveCurrentPage();
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return Helper::paginate(new LengthAwarePaginator($items->forPage($page, $perPage)->flatten(), $items->count(), $perPage, $page, $options));
    }

    // Contoh Use Case
    // return response()->json([
    //     'status' => 200,
    //     'error' => null,
    //     'data' => Helper::paginate($contacts),
    // ], 200);
}