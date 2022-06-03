<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Clientes;

class ClientesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $cliente = Clientes::create([   'nome' => 'Gui Tester',
                                        'endereco' => 'Planeta Terra',
                                        'endereco' => 'guiteste@email.com',
                                        'telefone' => '119450264817'

        ]);

        $this->assertDatabaseHas('clientes', ['nome' => 'Gui Tester']);
    }
}
