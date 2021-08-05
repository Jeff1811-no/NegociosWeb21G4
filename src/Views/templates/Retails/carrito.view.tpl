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
              <input value="{{updown}}" min="0" max="1" id="updown" name="updown" type="hidden" />
                  <input value="{{producto}}" name="producto" type="hidden" />
                  <input value="{{cantidad}}" name="cantidad" type="number" min="1" max={{existencia}} id="cantidad" onclick="total()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" />
              </form>
            </td>
            <td>
              <form action="index.php?page=retails_carrito" method="post">
                <input value="{{cantidad}}" name="can" type="hidden" id="can"  />
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
  <form action="index.php?page=checkout_checkout" method="post">
    <button type="submit">Efectuar Compra</button>
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

  total();
  
  function total(){
    let cantidad = 0;
    let precio = 0;
    let total = 0;
    var txttotal = document.getElementById("total");
    var cantidades = document.getElementsByName("cantidad");
    var precios = document.getElementsByName("precio");
    for(var i = 0; i < cantidades.length; i++){
      let subtotal = 0;
      cantidad = parseFloat(cantidades[i].value);
      precio = parseFloat(precios[i].value);
      if(cantidad > 0)
      {
        subtotal = cantidad * precio;
        total += subtotal;
      }
    }
    txttotal.innerHTML = total;
  };
  
  if($("#total").is(':empty')) {$('#comprar').prop('disabled', true);}
  
  $("[name='cantidad']").each(function(){
    $(this).on("change ", function (e) {
      var direction = this.defaultValue < this.value;
      this.defaultValue = this.value;
      if (direction) {$("#updown").val("0");
        $(this).parent().submit();
      }else {
        $("#updown").val("1");
        $(this).parent().submit();
      }
    });
  });

  

</script>