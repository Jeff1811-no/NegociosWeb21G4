<h1>Carrito</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>Descripción</th>
          <th>Cantidad</th>
          <th>Precio</th>
    </tr>
  </thead>
  <tbody>
    {{foreach carrito}}
    <tr>
      <td><a href="">{{producto}}</a></td>
      <td>{{cantidad}}</td>
      <td>{{precio}}</td>
      <td class="center">
        <button href="#" class="btn btn-primary">Eliminar</button>
      </td>
    </tr>
    {{endfor carrito}}

  </tbody>
</table>
</section>