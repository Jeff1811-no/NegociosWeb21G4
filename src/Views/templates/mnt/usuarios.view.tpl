<section class="depth-1">
  <h1>Trabajar con Usuarios</h1>
</section>

{{if Admin}}

<a></a>
<a></a>

<button id="roles" data-href="index.php?page=admin_roles">Roles</button>
<button data-href="index.php?page=admin_funcionesroles">Funciones Roles</button>


{{endif Admin}}

<section class="WWList">
  <table >
    <thead>
      <tr>
      <th>Código</th>
      <th>Correo</th>
      <th>Estado</th>
      {{if Admin}}
      <th>Rol</th>
      {{endif Admin}}
      <th>
        {{if CanInsert}}
        <a href="index.php?page=mnt_usuario&mode=INS">Nuevo</a>
        {{endif CanInsert}}
      </th>
      </tr>
    </thead>
    <tbody>
      {{foreach Usuarios}}
      <tr>
        <td>{{usercod}}</td>
        <td>
          {{if CanView}}
             <a href="index.php?page=mnt_usuario&mode=DSP&id={{usercod}}">{{useremail}}</a>
          {{endif CanView}}

          {{ifnot CanView}}
              {{useremail}}
          {{endifnot CanView}}
        </td>
        <td>{{userest}}</td>
        {{if ~Admin}}
        <td>{{roles}}</td>
        {{endif ~Admin}}
        <td>
          {{if ~CanUpdate}}
          <a href="index.php?page=mnt_usuario&mode=UPD&id={{usercod}}"
            class="btn depth-1 w48" title="Editar">
            <i class="fas fa-edit"></i>
          </a>
          {{endif ~CanUpdate}}
          &nbsp;
          {{if ~CanDelete}}
          <a href="index.php?page=mnt_usuario&mode=DEL&id={{usercod}}"
            class="btn depth-1 w48" title="Eliminar">
            <i class="fas fa-trash-alt"></i>
          </a>
          {{endif ~CanDelete}}
        </td>
      </tr>
      {{endfor Usuarios}}
    </tbody>
  </table>
</section>



<script>
$("roles").click(function(){
  var roles = "index.php?page=admin_roles";
  document.location.href = roles;
});

</script>
