<h1>Listado de BitacorasPanel</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th><th class="hidden-s">Acción</th><th class="hidden-s">Fecha</th><th>Descripción</th>
    </tr>
  </thead>
  <tbody>
    {{foreach bitacoras}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=mnt_bitacora&mode=DSP&id={{idbitacora}}">{{accion}}</a></td><td class="hidden-s">{{fecha_accion}}</td><td>{{descripcion}}</td>
    </tr>
    {{endfor bitacoras}}

  </tbody>
</table>
</section>