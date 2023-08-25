<?php

namespace Tests\Unit;

use App\Models\Registro;
use App\Services\RegistroService;
use App\Http\Controllers\RegistroController;

use Illuminate\Http\Response;
use Tests\TestCase;
use Mockery;

class RegistroTest extends TestCase
{
    protected $fakeRegistroJson;
    protected $fakeRegistroModel;
    protected $fakeRegistrosList;

    public function setUp(): void
    {
        parent::setUp();
        $this->fakeRegistroJson = [
            'type' => 'denuncia',
            'message' => 'mensagem teste',
            'is_identified' => true,
            'whistleblower_name' => 'fulano da silva',
            'whistleblower_birth' => '1995-03-24',
            'deleted' => false,
            'created_at' => '2023-08-23 23:52:06'
        ];
        $this->fakeRegistroModel = new Registro($this->fakeRegistroJson);
        $this->fakeRegistrosList = [$this->fakeRegistroJson, $this->fakeRegistroJson];
    }

    public function test_registro_list_empty(): void
    {
        $this->instance(RegistroService::class, Mockery::mock(RegistroService::class, function ($mock) {
            $mock->shouldReceive('list')->andReturn(collect([]));
        }));
        $this->get(route('index', ['deleted' => true]))
        ->assertStatus(Response::HTTP_OK)
        ->assertJson([]);
    }

    public function test_registro_list_success(): void
    {
        $this->instance(RegistroService::class, Mockery::mock(RegistroService::class, function ($mock) {
            $mock->shouldReceive('list')->andReturn(collect([$this->fakeRegistroModel, $this->fakeRegistroModel]));
        }));
        $this->get(route('index'))
        ->assertStatus(Response::HTTP_OK)
        ->assertJson($this->fakeRegistrosList);
    }

    public function test_registro_show_success(): void
    {
        $this->instance(RegistroService::class, Mockery::mock(RegistroService::class, function ($mock) {
            $mock->shouldReceive('show')->andReturn($this->fakeRegistroModel);
        }));
        $this->get(route('show', ['id' => 999]))
        ->assertStatus(Response::HTTP_OK)
        ->assertJson($this->fakeRegistroJson);
    }
}
