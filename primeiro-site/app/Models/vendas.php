<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cliente_id',
        'vendedor_id',
        'dt_venda'
    ];

    protected $table = 'Vendas';

    public function cliente(){
        return $this->belongsTo(Clientes::class, 'cliente_id', 'id');
    }

    public function produtos() {
        return $this->hasMany(ProdutosVenda::class, 'venda_id', 'id');
    }

    public function notaFiscal(){
        return $this->hasOne(NotasFiscais::class, 'venda_id', 'id');
    }

}
