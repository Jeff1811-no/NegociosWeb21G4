<h1>Listado de BitacorasPanel</h1>
<section class="WWList container-m">
<input type="text" id="myInput" onkeyup="buscar()" placeholder="Buscar" style="width: 100%">
<table id="tbldata">
  <thead>
    <tr>
          <th>#</th>
          <th class="hidden-s">Acción</th>
          <th class="hidden-s">Fecha</th>
          <th>Descripción</th>
    </tr>
  </thead>
  <tbody>
    {{foreach bitacoras}}
    <tr>
      <td>{{rownum}}</td>
      <td>{{accion}}</td>
      <td class="hidden-s">{{fecha_accion}}</td>
      <td>{{descripcion}}</td>
    </tr>
    {{endfor bitacoras}}

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