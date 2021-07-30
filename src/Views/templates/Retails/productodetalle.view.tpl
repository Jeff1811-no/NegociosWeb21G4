<div class="container py-5 mx-auto min-vh-100  ">

<div class="card border-dark text-center mt-5">
  

       <div class="header">
        <div class="row">
            <div class="col-md-9 mt-2">
                <h2>Playstation 4</h2>
            </div>
        </div>
      </div>

      <div class="row">  
        
        <div class="col-lg-10">
            <div class="row">
                <div class="col-md-6"> 
                    <img src="{{PrimaryMediaPath}}" alt="{{PrimaryMediaDoc}}" width="90%"> 
                </div>

                  <div class="card border-dark mb-4 mt-4 text-center" style="width:25rem;">
                   <div class="card-header bg-transparent mr-3" >Descripcion</div>
          
                             <p class="mt-2">
                              La mejor consola de videosjuegos para que disfrutes con tus familiares
                            </p>
                    
                             <form method="POST" action="index.php?page=Retails_productodetalle&ProdId={{ProdId}}">
                             <input type="hidden" name="ProdPrecioVenta" value={{ProdPrecioVenta}}>
                             <input type="hidden" name="ProdStock" value=12>

                            <label class="font-weight-bold mb-2" for="ProdCantidad">Precio</label>
                             <h4 class="mb-2">Lps.12000</h4>

                             <label class="font-weight-bold mb-2" for="ProdCantidad">Cantidad</label>
                             <br/>
                             <div class="ml-3">
                             <input class="form-control col-md-2" style="width:6rem; margin-left:8.8rem" type="number" id="ProdCantidad" name="ProdCantidad" min="1" value="{{ProdCantidad}}">
                             </div>
                             <button class="btn btn-primary mt-4 mb-4" type="submit" id="btnAgregarCarrito"><i class="fas fa-shopping-cart mx-2"></i>Agregar al carrito</button>
                             </form>

      
                      
               </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    function goBack() 
    {
        window.history.back();
    }
</script>