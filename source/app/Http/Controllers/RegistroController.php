<?php

namespace App\Http\Controllers;

use \App\Http\Requests\IndexRegistroRequest;
use \App\Http\Requests\StoreRegistroRequest;
use \App\Http\Requests\UpdateRegistroRequest;
use App\Services\RegistroService;

class RegistroController extends Controller
{
    protected RegistroService $service;

    public function __construct(RegistroService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexRegistroRequest $request)
    {
        return $this->service->list($request->validated());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistroRequest $request)
    {
        return $this->service->store($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistroRequest $request, int $id)
    {
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->service->delete($id);
    }
}
