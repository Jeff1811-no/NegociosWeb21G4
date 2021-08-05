<section class="depth-1">
  <h1>Trabajar con Usuarios</h1>
</section>

{{if Admin}}


<button data-href="index.php?page=admin_roles" id="roles">Roles</button>
<button data-href="index.php?page=admin_funcionesroles" id="funcionesroles">Funciones Roles</button>


{{endif Admin}}

<section class="">

<input type="text" id="myInput" onkeyup="buscar()" placeholder="Buscar" style="width: 100%">

<section class="">
  <table class="table" id= "tbldata">
    <thead class="table-dark">
      <tr>
      <th scope="col">Código</th>
      <th scope="col">Correo</th>
      <th scope="col">Estado</th>
      {{if Admin}}
      <th scope="col">Rol</th>
      {{endif Admin}}
      <th scope="col">
        {{if CanInsert}}
        <a href="index.php?page=mnt_usuario&mode=INS" class="text-white">Nuevo +</a>
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
$("#roles").click(function(){
  var roles = $(this).data('href');
  document.location.href = roles;
});

$("#funcionesroles").click(function(){
  var roles = $(this).data('href');
  document.location.href = roles;
});


buscar();

function buscar() {

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tbldata");
  tr = table.getElementsByTagName("tr");

 
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

</script>

