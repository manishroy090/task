<?php
use Illuminate\Pagination\LengthAwarePaginator;
use Monolog\Logger;
use Logtail\Monolog\LogtailHandler;


if (!function_exists('paginate')) {
    function paginate($data, $perPage)
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $clientsSlice = array_slice($data, ($page - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator($clientsSlice, count($data), $perPage, $page);
        $data = $paginator->items();
        $paginationData = [
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'total' => $paginator->total(),
        ];

        return [
            'data' => $data,
            'paginationData' => $paginationData
        ];
    }
}

if(!function_exists('applicationLog')){
    function applicationLog(){
        $logger = new Logger("example-app");
        $logger->pushHandler(new LogtailHandler(getenv('LOGTAIL_API_KEY')));
        return $logger;
    }
}