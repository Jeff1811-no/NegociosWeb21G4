
<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_bitacora" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="idbitacorad">Código</label>
      <input class="col-12 col-m-9" readonly disabled type="text" name="idbitacorad" ="idbitacorad" placehoder="Código" value="{{idbitacora}}"/>
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="idbitacora" value="{{idbitacora}}" />
      <input type="hidden" name="token" value="{{bitacoras_xss_token}}" />
    </div>
    <div class="row my-2 align-center">
<label class="col-12 col-m-3" for="accion">accion</label>
<input class="col-12 col-m-9"{{readonly}} type="text" name="accion" id="accion" placehoder="accion" value="{{accion}}" />
</div><div class="row my-2 align-center">
<label class="col-12 col-m-3" for="fecha_accion">fecha_accion</label>
<input class="col-12 col-m-9"{{readonly}} type="text" name="fecha_accion" id="fecha_accion" placehoder="fecha_accion" value="{{fecha_accion}}" />
</div>
<div class="row my-2 align-center">
<label class="col-12 col-m-3" for="descripcion">Descripción</label>
<textarea class="col-12 col-m-9"{{readonly}} type="text" name="descripcion" id="descripcion" placehoder="descripcion">{{descripcion}}</textarea>
</div>
    <div class="row my-4 align-center flex-end">
      {{if showCommitBtn}}
      <button class="primary col-12 col-m-2" type="submit" name="btnConfirmar">Confirmar</button>
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
    </div>
  </form>
</section>


<script>
  document.addEventListener("DOMContentLoaded", ()=>{
    const btnCancelar = document.getElementById("btnCancelar");
    btnCancelar.addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=mnt_bitacoras");
    });
  });
</script>
