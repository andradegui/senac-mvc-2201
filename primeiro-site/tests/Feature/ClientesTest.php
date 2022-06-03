<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Clientes;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientesTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreate()
    {
        $cliente = Clientes::create([   'nome' => 'Gui Tester',
                                        'endereco' => 'Planeta Terra',
                                        'email' => 'guiteste@email.com',
                                        'telefone' => '119450264817'

        ]);

        $this->assertDatabaseHas('clientes', ['nome' => 'Gui Tester']);

        // Método não elegante mais não funcional
        // $cliente->destroy($cliente->id);

        // $this->assertDatabaseMissing('clientes', ['nome' => 'Gui Tester']);
    }
}
