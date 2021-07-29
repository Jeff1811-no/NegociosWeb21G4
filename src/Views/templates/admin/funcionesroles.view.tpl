<h1>Listado de FuncionesRolesPanel</h1>
<section class="WWList container-m">
<table>
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