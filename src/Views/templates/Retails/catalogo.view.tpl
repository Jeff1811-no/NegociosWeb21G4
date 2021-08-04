<h1>Catalogo</h1>
<section class="WWList container-m">
<input type="text" id="myInput" onkeyup="buscar()" placeholder="Buscar" style="width: 100%">


<section>
<div class="card-deck" id="tbldata">
  {{foreach productos}}
    <div class="col-4 mt-5" >
     <div class="card">
     <tr class="hidden"><td class="hidden">  </td></tr>
        <img class="card-img-top" src="/{{ProdIMG}}"  alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">{{ProdNombre}}</h5>
          <p class="card-text">{{ProdDescripcion}}</p>
          <p class="font-weight-light">{{ProdPrecioVenta}}</p>
          <button data-href="index.php?page=retails_productodetalle&id={{ProdId}}" class="btn btn-primary id">Ver producto</button>
        </div>
    </div>  
    </div>
  {{endfor productos}}
  </div>
</section>
</section>

<script>

buscar();

function buscar() {

  document.addEventListener("DOMContentLoaded", ()=>{
    const botones = document.getElementsByClassName("id");
    for(i=0;i<botones.length;i++){
      botones[i].addEventListener("click", (e)=>{
      e.preventDefault();
      e.stopPropagation();
      console.log(e.target);
      var url=e.target.dataset.href;
      window.location.assign(url);
    });
    }
  });

  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tbldata");
  tr = table.getElementsByClassName("card");

 
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("h5")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>