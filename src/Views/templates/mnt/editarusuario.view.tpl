
<section class="container-m row depth-1 px-4 py-4">
  <h1>{{ModalTitle}}</h1>
</section>
<section class="container-m row depth-1 px-4 py-4">
  <form action="index.php?page=mnt_editarusuario" method="POST" class="col-12 col-m-8 offset-m-2">
    <div class="row my-2 align-center">
     
      <input class="col-12 col-m-9" readonly disabled type="hidden" name="usercodd" id="usercodd" placehoder="Código" value="{{usercod}}"/>
      <input type="hidden" name="mode" value="{{mode}}" />
      <input type="hidden" name="usercod" value="{{usercod}}" />
      <input type="hidden" name="token" value="{{editarusuarios_xss_token}}" />
    </div>
      <div class="row my-2 align-center">
        <label class="col-12 col-m-3" for="useremail">Correo Electronico</label>
        <input class="col-12 col-m-9"{{readonly}} type="text" name="useremail" id="useremail" placehoder="useremail" value="{{useremail}}" />
      </div>
      <div class="row my-2 align-center">
        <label class="col-12 col-m-3" for="username">Usuario</label>
        <input class="col-12 col-m-9"{{readonly}} type="text" name="username" id="username" placehoder="username" value="{{username}}" />
      </div>
     
      <div class="row my-2 align-center">
        <label class="col-12 col-m-3" for="userpswd">Nueva Contraseña</label>
        <input class="col-12 col-m-9"{{readonly}} type="text" name="userpswd" id="userpswd" placehoder="userpswd" value="{{userpswd}}" />
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
      window.location.assign("index.php?page=index");
    });
  });
</script>
