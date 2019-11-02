<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait ApiResponse
{
    /**
     * Return HTTP Success (200)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function success()
    {
        $args = func_get_args();
        return $this->response($this->getData($args), 200);
    }

    /**
     * Return HTTP Created (201)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function created()
    {
        $args = func_get_args();
        return $this->response($this->getData($args), 201);
    }

    /**
     * Return HTTP Bad Request (400)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function bad()
    {
        $args = func_get_args();
        return $this->response($this->getData($args), 400);
    }

    /**
     * Return HTTP Unauthorized (401)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unauthorized()
    {
        $args = func_get_args();
        return $this->response($this->getData($args), 401);
    }

    /**
     * Return HTTP Not Found (404)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound()
    {
        $args = func_get_args();
        return $this->response($this->getData($args), 404);
    }

    /**
     * Return HTTP Bad Request (422)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function unprocessable()
    {
        $args = func_get_args();
        return $this->response($this->getData($args), 422);
    }

    /**
     * Return HTTP Code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $data, int $http_code)
    {
        if (config('odin.queryRequest')) {
            $data['queries'] = $this->getQueries();
        }
        return response()->json($data, $http_code);
    }

    /**
     * Return entity data array or array blank
     *
     * @return array
     */
    private function getData($args)
    {
        $data = [];
        /* Sem argumentos, retorna array em branco */
        if (count($args) < 1) {
            return $data;
        }
        /* Enviou um array como parâmetro */
        if (is_array($args[0])) {
            return $args[0];
        }
        /* Enviou um Paginador como parâmetro */
        if (is_a($args[0], LengthAwarePaginator::class)) {
            $paginator = ($args[0]);
            $data = $paginator->toArray();
        }
        /* Enviou uma Coleção como parâmetro */
        if (is_a($args[0], Collection::class)) {
            $collection = ($args[0]);
            $data = $collection->toArray();
        }
        /* Enviou uma Entidade como parâmetro */
        if (is_a($args[0], Model::class)) {
            $entity = ($args[0]);
            $data = $entity->toArray();
        }
        return $data;
    }

    /**
     * Return entity data array or array blank
     *
     * @return array
     */
    private function getQueries()
    {
        $queries = DB::getQueryLog();
        $formattedQueries = [];
        foreach ($queries as $query) {
            $prep = $query['query'];
            foreach ($query['bindings'] as $binding) {
                $prep = preg_replace("#\?#", $binding, $prep, 1);
            }
            $formattedQueries[] = $prep;
        }
        return $formattedQueries;
    }
}
