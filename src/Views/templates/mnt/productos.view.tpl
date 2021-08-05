<h1>Listado de ProductosPanel</h1>
<section class="WWList container-m">
<table>
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