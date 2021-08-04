<section>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
  <div class="carousel-item active">
      <img class="d-block w-100" src="/{{BASE_DIR}}/public/img/Cheems.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://holatelcel.com/wp-content/uploads/2020/09/cheems-1280x720.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://los40.cl/wp-content/uploads/2020/06/167a5b9eb045e51326067d784a827539.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://www.elsiglodetorreon.com.mx/m/i/2021/06/1438795.jpeg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</section>
<section>
<div class="card-deck">
  {{foreach items}}
    <div class="col-4 mt-5">
     <div class="card">
        <img class="card-img-top" src="https://holatelcel.com/wp-content/uploads/2020/09/cheems-memes-9.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{ProdNombre}}</h5>
          <p class="card-text">{{ProdDescripcion}}</p>
          <p class="font-weight-light">{{ProdPrecioVenta}}</p>
          <button data-href="index.php?page=retails_productodetalle&id={{ProdId}}" class="btn btn-primary id">Ver producto</button>
        </div>
    </div>  
    </div>
  {{endfor items}}
  </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", ()=>{
    const botones = document.getElementsByClassName("id");
    for(i=0;i<botones.length;i++){
      botones[i].addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      console.log(e.target);
      var url=e.target.dataset.href;
      window.location.assign(url);
    });
    }
  });
</script>

<section>
  Top 5 Pianos a la venta
</section>

<section>
  Top 5 Partituras
</section>

<style>
.card {}
</style>


