<h1>Listado de BitacorasPanel</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th><th class="hidden-s">accion</th><th class="hidden-s">fecha_accion</th><th>descripcion</th>
          <th><a href="index.php?page=mnt_bitacora&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach bitacoras}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=mnt_bitacora&mode=DSP&id={{idbitacora}}">{{accion}}</a></td><td class="hidden-s">{{fecha_accion}}</td><td>{{descripcion}}</td>
      <td class="center">
        <a href="index.php?page=mnt_bitacora&mode=UPD&id={{idbitacora}}">Editar</a>
        &nbsp;
        <a href="index.php?page=mnt_bitacora&mode=DEL&id={{idbitacora}}"">Eliminar</a>
      </td>
    </tr>
    {{endfor bitacoras}}

  </tbody>
</table>
</section>