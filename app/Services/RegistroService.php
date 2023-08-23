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

    public function store(array $params)
    {
        return Registro::create($params);
    }

    public function show(int $id)
    {
        return Registro::findOrFail($id);
    }

    public function update(array $params, int $id)
    {
        $registro = Registro::findOrFail($id);
        return $registro->update($params);
    }

    public function delete(int $id)
    {
        return Registro::destroy($id);
    }
}
