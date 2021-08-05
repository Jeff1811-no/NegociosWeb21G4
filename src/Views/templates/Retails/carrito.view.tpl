<h1>Carrito</h1>

<section class="WWList container-m">
  <table>
    <thead>
        <tr>
          <th>Imagen</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Eliminar de Carrito</th>
        </tr>
    </thead>
    <tbody>
      {{foreach carrito}}
        <tr>
            <td><img class="img" src="/{{img}}"/></td>
            <td>{{dsc}}</td>
            <td>
                <input value="{{precio}}" name="precio" type="hidden" id="precio" readonly />
                <p>{{precio}}</p>
            </td>
            <td>
              <form action="index.php?page=retails_carrito" method="post">
                  <input value="{{producto}}" name="producto" type="hidden" />
                  <input value="{{cantidad}}" name="cantidad" type="number" min="1" id="cantidad" onclick="totalb()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
              </form>
            </td>
            <td>
              <form action="index.php?page=retails_carrito" method="post">
                  <input value="{{producto}}" name="producto" type="hidden" />
                  <input name="btnEliminar" id="btnEliminar" type="submit" value="Eliminar" />
              </form>
            </td>
            <td>
                <input name="subtotal" type="hidden" readonly />
            </td>
        </tr>
      {{endfor carrito}}
    </tbody>
  </table>
  <div>
      <p>Total</p>
      <p id="total" name="total"></p>
  </div>
  <hr width=100% />
  <form method="post" action="index.php?page=retails_carrito">
      <button type="submit" name="btnComprar" id="comprar" >Efectuar compra</button>
  </form>
</section>

<style>
  .img{
    width: 150px; 
    height:150px; 
    object-fit: cover;
  }
</style>

<script>

  totalb();

  function totalb() {
    let cantidad = 0;
    let precio = 0;
    let total = 0;
    var txttotal = document.getElementById("total");
    var cantidades = document.getElementsByName("cantidad");
    var precios = document.getElementsByName("precio");
    console.log(cantidades);
    for(var i = 0; i < cantidades.length; i++)
    {
      let subtotal = 0;
      cantidad = parseFloat(cantidades[i].value);
      precio = parseFloat(precios[i].value);
      if(cantidad > 0)
      {
        subtotal = cantidad * precio;
        total += subtotal;
      } else {
        document.getElementById("comprar").disabled=false;
      }
    }
    txttotal.innerHTML = total;
  };

  var cantidades = document.getElementsByName("cantidad");
  for(var i = 0; i < cantidades.length; i++)
  {
    cantidades[i].addEventListener("change",datoscan);
  }
  function datoscan(e)
  {
    e.preventDefault();
    e.stopPropagation();
    console.log(e.target.parentNode);
    e.target.parentNode.submit();
  }

  

</script>