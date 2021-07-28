<div class="container py-5 mx-auto min-vh-100">

    <div class="col-md-4 p-0 mb-4">
        <button class="btn btn-primary" onclick="goBack()"><i class="fas fa-arrow-left mx-2"></i>Regresar</button>
    </div>

<div class="header">
        <div class="row">
            <div class="col-md-9 mt-2">
                <h2>{{ProdNombre}}</h2>
            </div>
        </div>
    </div>

    <div class="row">  
    <!--     <div class="col-lg-2 d-flex flex-column justify-content-center">
            {{foreach AllProductMedia}}
                <div class="my-4 border">
                    <a href="{{MediaPath}}">
                        <img class="rounded mx-auto d-block" src="{{MediaPath}}" width="60%">
                    </a>
                </div>
            {{endfor AllProductMedia}}
        </div>  -->
        <div class="col-lg-10">
            <div class="row">
                <div class="col-md-6"> 
                    <img src="{{PrimaryMediaPath}}" alt="{{PrimaryMediaDoc}}" width="90%"> 
                </div>

                <div class="col-md-6">
                    <h3 class="mb-4">Lps.{{ProdPrecioVenta}}</h3>
                    <h4 class="mb-4">Descripción</h4>
                    <p>
                        {{ProdDescripcion}}
                    </p>
                    
                    <form method="POST" action="index.php?page=visualizarproducto&ProdId={{ProdId}}">
                        <input type="hidden" name="ProdPrecioVenta" value={{ProdPrecioVenta}}>
                        <input type="hidden" name="ProdStock" value={{ProdStock}}>
                        <label class="font-weight-bold" for="ProdCantidad">Cantidad</label>
                        <br/>
                        <input class="form-control col-md-2" type="number" id="ProdCantidad" name="ProdCantidad" min="1" value="{{ProdCantidad}}">
                        <button class="btn btn-primary mt-4" type="submit" id="btnAgregarCarrito"><i class="fas fa-shopping-cart mx-2"></i>Agregar al carrito</button>
                    </form>

                    {{if Error}}
                        <p class="text-danger font-weight-bold my-4">{{Error}}</p>
                    {{endif Error}}

                </div>
            </div>
        </div>
    </div>
</div>