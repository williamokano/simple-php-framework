<?php $this->render('header'); ?>
<?php $this->render('components.menu'); ?>
<!-- produtos -->
<div class="col-sm-9">
    <!--
    <div class="products-sorting row">
        <div class="col-sm-6">
            Sort by:
            <select>
                <option>Ascending</option>
                <option>Descending</option>
            </select>
            <select>
                <option>Product name</option>
                <option>Product price</option>
            </select>
            <select>
                <option>Brand name</option>
                <option>Brand type</option>
            </select>
        </div>

        <div class="col-sm-6">
            <span class="pull-right">
                Items per page:
                <a href="#">12</a> /
                <a href="#">20</a> /
                <a href="#">30</a> /
                <a href="#">50</a>
            </span>
        </div>
    </div>
    -->
    <div class="products-listing row">
        <h3>OUR PRODUCTS</h3>
        <div class="row">
        <?php for($i = 0; $i < sizeof($produtos); $i++): ?>
            <?php if ($i % 4 == 0 && $i > 0): ?>
            </div>
            <div class="row">
            <?php endif; ?>
            <div class="col-sm-3 product-item">
                <a href="htp://teste.dev/produto/<?=$produtos[$i]->id?>">
                    <img src="<?=$produtos[$i]->foto?>" width="156" height="115">
                    <h5><?=$produtos[$i]->nome?></h5>
                    <span class="price">
                        Preço: R$ <?=number_format($produtos[$i]->preco, 2, ".", ",")?>
                    </span>
                </a>
            </div>
        <?php endfor; ?>
        </div>
    </div>
    <div class="products-pagination row text-center">
        <?=$paginacao;?>
        <!--
        <nav>
            <ul class="pagination">
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">Next ></a></li>
                <li><a href="#">Last >></a></li>
            </ul>
        </nav>
        -->
        <hr />
    </div>
    <div class="featured-products row">
        <h3>FEATURED PRODUCTS</h3>
        <div class="col-md-12">
            <div class="well position-relative">
                <div class="slider-products">
                    <?php foreach ($produtosFeatured as $p): ?>
                    <div class="text-center">
                        <a href="http://teste.dev/produto/<?=$p->id?>">
                            <img class="img-responsive" src="<?=$p->foto?>" width="156" height="115">
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <img src="/assets/imgs/arrow-previous.fw.png" class="slider-arrow slider-previous">
                <img src="/assets/imgs/arrow-next.fw.png" class="slider-arrow slider-next">
            </div>
        </div>
    </div>
</div>
<!-- /produtos -->

<?php $this->render('footer'); ?>
