<h1>Catalogo</h1>
<section class="WWList container-m">
<input type="text" id="myInput" onkeyup="buscar()" placeholder="Buscar" style="width: 100%">


<section>
<div class="card-deck" id="tbldata">
  {{foreach productos}}
    <div class="col-4 mt-5" >
     <div class="card">
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

  var input, filter, div, card, h5, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("tbldata");
  card = div.getElementsByClassName("card");

 
  for (i = 0; i < card.length; i++) {
    h5 = card[i].getElementsByTagName("h5")[0];
    if (h5) {
      txtValue = h5.textContent || h5.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        card[i].style.display = "";
      } else {
        card[i].style.display = "none";
      }
    }
  }
}
</script>