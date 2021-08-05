<div class="container py-5 mx-auto min-vh-100  ">

<div class="card border-dark text-center mt-5">
  

       <div class="header">
        <div class="row">
            <div class="col-md-9 mt-2">
                <h2>{{ProdNombre}}</h2>
            </div>
        </div>
      </div>

      <div class="row">  
        
        <div class="col-lg-10">
            <div class="row">
                <div class="col-md-6"> 
                    <img src="/{{img}}" alt="Imagen" width="90%"> 
                </div>

                <div class="card border-dark mb-4 mt-4 text-center" style="width:25rem;">
                    <div class="card-header bg-transparent mr-3" >Descripcion</div>
            
                    <p class="mt-2">{{ProdDescripcion}}</p>
            
                    <form method="POST" action="index.php?page=Retails_productodetalle&ProdId={{ProdId}}">
                        <label class="font-weight-bold mb-2" for="ProdPrecioVenta">Precio</label>
                        <h4 class="mb-2">Lps {{ProdPrecioVenta}}</h4>
                        <input value="{{ProdId}}" name="ProdId" type="hidden" />
                        <input value="{{ProdPrecioVenta}}" name="ProdPrecioVenta" type="hidden" />
                        <label class="font-weight-bold mb-2" for="ProdStock">Cantidad</label>
                        <br/>
                        <div class="ml-3">
                            <input class="form-control col-md-2" style="width:6rem; margin-left:8.8rem" type="number" id="ProdStock" name="ProdStock" min="1" max="{{ProdStock}}" />
                        </div>
                        <button class="btn btn-primary mt-4 mb-4" type="submit"name="btnAgregarCarrito" id="btnAgregarCarrito"><i class="fas fa-shopping-cart mx-2"></i>Agregar al carrito</button>
                    </form>
               </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>

$("#ProdStock").val("1") ;

</script>