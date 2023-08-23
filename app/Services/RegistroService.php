<?php

namespace App\Services;

use App\Models\Registro;

class RegistroService
{
    public function list(array $params)
    {
        return Registro::when(isset($params['deleted']), function ($subQuery) use($params){
            $subQuery->where('deleted', $params['deleted']);
        })
        ->when(isset($params['type']), function ($subQuery) use($params){
            $subQuery->where('type', $params['type']);
        })
        ->get();
    }
}
