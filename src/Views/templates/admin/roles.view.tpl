<h1>Listado de RolesPanel</h1>
<section class="WWList container-m">
<table>
  <thead>
    <tr>
          <th>#</th>
          <th class="hidden-s">rolesdsc</th>
          <th>rolesest</th>
          <th><a href="index.php?page=admin_rol&mode=INS" class="button">+</a></th>
    </tr>
  </thead>
  <tbody>
    {{foreach roles}}
    <tr>
      <td>{{rownum}}</td>
      <td><a href="index.php?page=admin_rol&mode=DSP&id={{rolescod}}">{{rolesdsc}}</a></td>
      <td>{{rolesest}}</td>
      <td class="center">
        <a href="index.php?page=admin_rol&mode=UPD&id={{rolescod}}">Editar</a>
        &nbsp;
        <a href="index.php?page=admin_rol&mode=DEL&id={{rolescod}}">Eliminar</a>
      </td>
    </tr>
    {{endfor roles}}

  </tbody>
</table>
</section>