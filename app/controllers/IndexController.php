<?php

namespace Controllers;

use App\Controller;
use App\Paginator;
use Models\ProdutosRepository;

/**
 *
 */
class IndexController extends Controller
{
    /**
     * [Index description]
     */
    public function index()
    {
        $produtosModel = new ProdutosRepository();
        $produtosAtivos = $produtosModel->getProdutosAtivo();

        $this->view->set("paginacao", "");
        $this->view->set("produtos", $produtosAtivos);
        $this->view->set("produtosFeatured", array_slice($produtosAtivos, 6));
    }

    /**
     * [busca description]
     * @param  string  $termo  [description]
     * @param  integer $pagina [description]
     * @return [type]          [description]
     */
    public function busca($termo = "", $pagina = 1)
    {
        $produtosModel = new ProdutosRepository();
        $todosProdutos = $produtosModel->getProdutosAtivo();
        $produtos = $produtosModel->findByNameOrId(urldecode($termo));

        $paginator = new Paginator($produtos);
        $paginator->setItemsPerPage(5);
        $paginator->setPage(intval($pagina));

        $this->view->set("paginacao", $paginator->paginate("/busca/{$termo}/%d"));
        $this->view->set("produtos", $paginator->getPaginatedData());
        $this->view->set("produtosFeatured", array_slice($todosProdutos, 6));

        $this->view->setTemplate("index.index");
    }
}
