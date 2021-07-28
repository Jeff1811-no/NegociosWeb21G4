
<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_funcionrol" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="rolescodd">Código</label>
      <input class="col-12 col-m-9" readonly disabled type="text" name="rolescodd" id="rolescodd" placehoder="Código" value="{{rolescod}}"/>
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="rolescod" value="{{rolescod}}" />
      <input type="hidden" name="token" value="{{funcionesroles_xss_token}}" />
    </div>
    <div class="row my-2 align-center">
<label class="col-12 col-m-3" for="fncod">fncod</label>
<input class="col-12 col-m-9"{{readonly}} type="text" name="fncod" id="fncod" placehoder="fncod" value="{{fncod}}" />
</div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="fnrolest">Estado</label>
      <select name="fnrolest" id="fnrolest" class="col-12 col-m-9" {{if readonly}} readonly disabled {{endif readonly}}>
        <option value="ACT" {{if fnrolest_act}}selected{{endif fnrolest_act}}>Mostrar</option>
        <option value="INA" {{if fnrolest_ina}}selected{{endif fnrolest_ina}}>Ocultar</option>
      </select>
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
      window.location.assign("index.php?page=mnt_funcionesroles");
    });
  });
</script>
