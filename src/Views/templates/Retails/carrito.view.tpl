<h1>Carrito</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th>
          <th>Descripción</th>
          <th>Cantidad</th>
          <th>Precio</th>
    </tr>
  </thead>
  <tbody>
    {{foreach carrito}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="">{{producto}}</a></td>
      <td>{{cantidad}}</td>
      <td>{{precio}}</td>
      <td>{{fechacompra}}</td>
      <td class="center">
        <a>Eliminar</a>
      </td>
    </tr>
    {{endfor carrito}}

  </tbody>
</table>
</section>