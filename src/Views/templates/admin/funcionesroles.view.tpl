<h1>Listado de FuncionesRolesPanel</h1>
<section class="WWList container-m">
<input type="text" id="myInput" onkeyup="buscar()" placeholder="Buscar" style="width: 100%">
<table id="tbldata">
  <thead>
    <tr>
          <th>#</th><th>rolescod</th><th>fncod</th><th>fnrolest</th>
          <th><a href="index.php?page=admin_funcionrol&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach funcionesroles}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=admin_rol&mode=DSP&id={{rolescod}}">{{rolescod}}</a></td>
      <td><a href="index.php?page=admin_funcionrol&mode=DSP&id={{rolescod}}">{{fncod}}</a></td><td>{{fnrolest}}</td>
      <td class="center">
        <a href="index.php?page=admin_funcionrol&mode=DEL&id={{rolescod}}">Eliminar</a>
      </td>
    </tr>
    {{endfor funcionesroles}}

  </tbody>
</table>
</section>

<script>
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