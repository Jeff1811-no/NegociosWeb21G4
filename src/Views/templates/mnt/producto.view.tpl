<script src='/{{BASE_DIR}}/public/js/imagen.js'></script>
<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
    <div class="col-12 col-m-8 offset-m-2">
     <div class="row my-2 align-center">
        <label class="col-12 col-m-3"for="ProdIMG">Imagen</label>
        <form id="frmI" method="POST" enctype="multipart/form-data" class="col-12 col-m-9">
          <div class="container" >
            <input id="uploadImage" type="file" name="Imagen" /><br/>
            <img src="/{{BASE_DIR}}{{ProdIMG}}" class="imagen" style="width:60%"><br/>
            <input class="btn btn-success" type="submit" value="Upload">
          </div>
        </form>
     </div>
    </div>
  <form action="index.php?page=mnt_producto" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="ProdIdd">Código</label>
      <input class="col-12 col-m-9" readonly disabled type="text" name="ProdIdd" id="ProdIdd" placehoder="Código" value="{{ProdId}}"/>
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="ProdId" value="{{ProdId}}" />
      <input type="hidden" name="token" value="{{productos_xss_token}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="ProdNombre">ProdNombre</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="ProdNombre" id="ProdNombre" placehoder="ProdNombre" value="{{ProdNombre}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="ProdDescripcion">ProdDescripcion</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="ProdDescripcion" id="ProdDescripcion" placehoder="ProdDescripcion" value="{{ProdDescripcion}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="ProdPrecioVenta">ProdPrecioVenta</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="ProdPrecioVenta" id="ProdPrecioVenta" placehoder="ProdPrecioVenta" value="{{ProdPrecioVenta}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="ProdPrecioCompra">ProdPrecioCompra</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="ProdPrecioCompra" id="ProdPrecioCompra" placehoder="ProdPrecioCompra" value="{{ProdPrecioCompra}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="ProdStock">ProdStock</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="ProdStock" id="ProdStock" placehoder="ProdStock" value="{{ProdStock}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="ProdEst">Estado</label>
      <select name="ProdEst" id="ProdEst" class="col-12 col-m-9" {{if readonly}} readonly disabled {{endif readonly}}>
        <option value="ACT" {{if ProdEst_act}}selected{{endif ProdEst_act}}>Mostrar</option>
        <option value="INA" {{if ProdEst_ina}}selected{{endif ProdEst_ina}}>Ocultar</option>
      </select>
    </div>
      <div class="row my-4 align-center flex-end">
        {{if showCommitBtn}}
        <button class="primary col-12 col-m-2" type="submit" value="Confirmar" name="btnConfirmar">Confirmar</button>
        &nbsp;
        {{endif showCommitBtn}}
        <button class="col-12 col-m-2"type="button" id="btnCancelar">
          {{if showCommitBtn}}
          Cancelar
          {{endif showCommitBtn}}
          {{ifnot showCommitBtn}}
          Regresar
          {{endifnot showCommitBtn}}
        </button>
      </div>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", ()=>{
    const btnCancelar = document.getElementById("btnCancelar");
    btnCancelar.addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_productos");
    });
    var form = document.getElementById("frmI");
    form.addEventListener("submit", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      imagen({{ProdId}});
    });
  });
</script>
