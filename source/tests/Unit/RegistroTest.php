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
    protected $registroUnicoFake;
    protected $registro_data;

    public function setUp(): void
    {
        parent::setUp();
        $this->registro_data = [
            'type' => 'denuncia',
            'message' => 'mensagem teste',
            'is_identified' => true,
            'whistleblower_name' => 'fulano da silva',
            'whistleblower_birth' => '1995-03-24',
            'deleted' => false,
            'created_at' => '2023-08-23 23:52:06'
        ];
        $this->registroUnicoFake = new Registro($this->registro_data);
    }

    public function test_registro_insert_success(): void
    {
        $this->instance(RegistroService::class, Mockery::mock(RegistroService::class, function ($mock) {
            $mock->shouldReceive('list')->andReturn($this->registroUnicoFake);
        }));
        $this->get(route('index'))
        ->assertStatus(Response::HTTP_OK)
        ->assertJson($this->registro_data);
    }

    public function test_registro_show_success(): void
    {
        $this->instance(RegistroService::class, Mockery::mock(RegistroService::class, function ($mock) {
            $mock->shouldReceive('show')->andReturn($this->registroUnicoFake);
        }));
        $this->get(route('show', ['id' => 999]))
        ->assertStatus(Response::HTTP_OK)
        ->assertJson($this->registro_data);
    }
}
