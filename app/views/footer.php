</div>
</div>

<div class="container">
<div class="footer-preto row">
   <div class="col-sm-4">
       <img src="/assets/imgs/site-protected.png" />
       Shop Online with us safely &amp; securely
   </div>
   <div class="col-sm-4">
       <img src="/assets/imgs/box.jpg" />
       We ship your orders anywhere!
   </div>
   <div class="col-sm-4">
       <div class="search">
           <div class="input-group buscar-rodape">
               <input type="text" name="search" class="form-control search-website-text"
                      placeholder="Search website"
                      aria-describedby="bottom-search"
                      id="bottom-search-form">
               <span class="input-group-addon search-website-button" id="bottom-search">
                   <span class="go">GO</span>
               </span>
           </div>
       </div>
   </div>
</div>
<div class="row footer-vermelho">
   <div class="col-sm-2">
       <h4>Company</h4>
       <ul class="info-rodape">
           <li><a href="#">Home</a></li>
           <li><a href="#">About Us</a></li>
           <li><a href="#">Blog</a></li>
           <li><a href="#">Latest News</a></li>
           <li><a href="#">Login</a></li>
           <li><a href="#">Join Us</a></li>
       </ul>
   </div>
   <div class="col-sm-3">
       <h4>Categories</h4>
       <ul class="info-rodape">
           <li><a href="#">Lorem Ipsum Dolor</a></li>
           <li><a href="#">Consectetur Adipiscing Elit</a></li>
           <li><a href="#">Suspendisse Non Turpis</a></li>
           <li><a href="#">Fringilla Lectus Et</a></li>
           <li><a href="#">Eget Accumsan Lectus</a></li>
           <li><a href="#">Aliquam Eget Leo Id</a></li>
       </ul>
   </div>
   <div class="col-sm-2">
       <h4>Information</h4>
       <ul class="info-rodape">
           <li><a href="#">My Account</a></li>
           <li><a href="#">Rewards</a></li>
           <li><a href="#">Terms &amp; Conditions</a></li>
           <li><a href="#">Buying Guide</a></li>
           <li><a href="#">FAQ</a></li>
       </ul>
   </div>
   <div class="col-sm-2">
       <h4>Social Network</h4>
       <ul class="info-rodape">
           <li><a href="#">My Account</a></li>
           <li><a href="#">Rewards</a></li>
           <li><a href="#">Terms &amp; Conditions</a></li>
           <li><a href="#">Buying Guide</a></li>
           <li><a href="#">FAQ</a></li>
       </ul>
   </div>
   <div class="col-sm-3">
       <h4>Contact Us</h4>
       <ul class="info-rodape">
           <li>Phone: 1.234.567.8901</li>
           <li>Toll Free: 1.234.567.8901</li>
           <li>Fax: 1.234.567.8901</li>
           <li>Email: <a href="#">Send us an email</a></li>
       </ul>
   </div>
   <div class="col-sm-3 col-sm-offset-9">
       <span class="">
           MON - SAT 9am to 7:30pm</br>
           Sundays, holidays closed
       </span>
   </div>
</div>
</div>
</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/slick/slick.min.js"></script>
<script>
$(document).ready(function() {
    $(".slider-products").slick({
       arrows: false,
       dots: false,
       infinite: true,
       speed: 300,
       slidesToShow: 4,
       slidesToScroll: 1,
       responsive: [
           {
               breakpoint: 1024,
               settings: {
                   slidesToShow: 3,
                   slidesToScroll: 1,
                   infinite: true,
                   dots: false
               }
           },
           {
               breakpoint: 600,
               settings: {
                   slidesToShow: 2,
                   slidesToScroll: 1
               }
           },
           {
               breakpoint: 480,
               settings: {
                   slidesToShow: 1,
                   slidesToScroll: 1
               }
           }
       ]
    });

    $(".slider-previous").on("click", function(event) {
        event.preventDefault();
        $(".slider-products").slick('slickPrev');
    });

    $(".slider-next").on("click", function(event) {
        event.preventDefault();
        $(".slider-products").slick('slickNext');
    });

    $("#top-search").on("click", OnClickBusca("#top-search-form"));
    $("#bottom-search").on("click", OnClickBusca("#bottom-search-form"));
});

function OnClickBusca(idElemento) {
    return function (event) {
        event.preventDefault();
        var termo = $(idElemento).val();
        location.href = "/busca/" + encodeURI(termo);
    }
}
</script>
</body>
</html>
