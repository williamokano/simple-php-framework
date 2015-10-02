<?php

namespace Models;

use App\Model;
use Models\Produto;

class ProdutosRepository extends Model
{
    private $produtos = array();
    public function __construct()
    {
        $json = file_get_contents(ROOTDIR . "Produtos.json");
        $products_json = json_decode($json);
        $this->produtos = array_map(function($item)
        {
            return new Produto($item);
        }, $products_json->Produto);
    }

    public function getProdutosAtivo()
    {
        return array_values(array_filter($this->produtos, function($item)
        {
            return $item->status == 1;
        }));
    }

    public function findByNameOrId($termo = "")
    {
        return array_values(array_filter($this->produtos, function($item) use ($termo)
        {
            return strpos(strtolower($item->nome), $termo) !== false &&
                   $item->status == 1;
        }));
    }
}
