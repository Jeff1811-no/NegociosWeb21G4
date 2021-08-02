
<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_usuario" method="POST" class="col-12 col-m-8 offset-m-2">
    <div  class="row my-2 align-center">
      <input  class="col-12 col-m-9" readonly disabled type="hidden" name="usercodd" id="usercodd" placehoder="Código" value="{{usercod}}"/>
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="usercod" value="{{usercod}}" />
      <input type="hidden" name="token" value="{{users_xss_token}}" />
    </div>
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="useremail">Email</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="useremail" id="useremail" placehoder="useremail" value="{{useremail}}" />
    </div>

    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="username">Username</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="username" id="username" placehoder="username" value="{{username}}" />
    </div>
     {{ifnot userupdate}}
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="userpswd">Contraseña</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="userpswd" id="userpswd" placehoder="userpswd" value="{{userpswd}}" />
    </div>
    {{endifnot userupdate}}

    {{if userupdate}}
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="userpswd">Nueva Contraseña</label>
      <input class="col-12 col-m-9"{{readonly}} type="text" name="userpswd" id="userpswd" placehoder="userpswd" value="{{userpswd}}" />
    </div>
   {{endif userupdate}}
    
   {{if userinsert}}
    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="userest">Estado</label>
      <select name="userest" id="userest" class="col-12 col-m-9" {{if readonly}} readonly disabled {{endif readonly}}>
        <option value="ACT" {{if userest_act}}selected{{endif userest_act}}>Mostrar</option>
        <option value="INA" {{if userest_ina}}selected{{endif userest_ina}}>Ocultar</option>
      </select>
    </div>

    <div class="row my-2 align-center">
      <label class="col-12 col-m-3" for="rolescod">Rolescod</label>
      <select name="rolesCombo" id="rolescod" class="col-12 col-m-9" {{if readonly}} readonly disabled {{endif readonly}}>
        {{rolesCombo}}
      </select>
    </div>
    {{endif userinsert}}
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
      window.location.assign("index.php?page=mnt_usuarios");
    });
  });
</script>