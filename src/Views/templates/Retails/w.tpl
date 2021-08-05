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

  function total() {
    let cantidad = 0;
    let precio = 0;
    let total = 0;
    for(var i = 0 ; i < $("[name='cantidad']").length; i++)
    {
      let subtotal = 0;
      cantidad = parseFloat($("[name='precios']").get([i]).val());
      

      precio=  parseFloat($("[name='precios']").get([i]).val());
      
      if(cantidad > 0)
      {
        subtotal = cantidad * precio;
        total += subtotal;
      }
    }
    $("#total").html(total);
    
  };
