<h1>Listado de ProductosPanel</h1>
<section class="WWList container-m">
<input type="text" id="myInput" onkeyup="buscar()" placeholder="Buscar" style="width: 100%">
<table id= "tbldata">
  <thead>
    <tr>
          <th>#</th><th class="hidden-s">ProdNombre</th><th class="hidden-s">ProdDescripcion</th><th class="hidden-s">ProdPrecioVenta</th><th class="hidden-s">ProdPrecioCompra</th><th class="hidden-s">ProdStock</th><th>ProdEst</th>
          <th><a href="index.php?page=mnt_producto&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>


    {{foreach productos}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=mnt_producto&mode=DSP&id={{ProdId}}">{{ProdNombre}}</a></td>
      <td class="hidden-s">{{ProdDescripcion}}</td>
      <td class="hidden-s">{{ProdPrecioVenta}}</td>
      <td class="hidden-s">{{ProdPrecioCompra}}</td><td class="hidden-s">{{ProdStock}}</td>
      <td>{{ProdEst}}</td>
      <td class="center">
        <a href="index.php?page=mnt_producto&mode=UPD&id={{ProdId}}">Editar</a>
        &nbsp;
        <a href="index.php?page=mnt_producto&mode=DEL&id={{ProdId}}">Eliminar</a>
      </td>
    </tr>
    {{endfor productos}}

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