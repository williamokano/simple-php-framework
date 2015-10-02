<?php

namespace Models;

class Produto
{
    public $id;
    public $nome;
    public $preco;
    public $status;
    public $foto;
    public $estoque;

    public function __construct($dados = null)
    {
        if (is_object($dados)) {
            $this->id = $dados->ProdutoId;
            $this->nome = $dados->Nome;
            $this->preco = $dados->PrecoPor;
            $this->status = $dados->Status;
            $this->foto = $dados->Foto;
            $this->estoque = $dados->Estoque->Disponivel;
        }
    }

}
