<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\VendoresController;

class VendedoresControllerTest extends TestCase
{
    public function __construct()
    {
        //Chamando classe pai
        parent::__construct();
        $this->vendedores = new VendoresController;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCheckVendedor()
    {
        $this->assertTrue($this->vendedores->checkVendedor(1));
        $this->assertFalse($this->vendedores->checkVendedor(20));
    }

    public function testGetVendedor()
    {
        $this->assertEquals('Rafael', $this->vendedores->getVendedor(2));
    }
}
