
function cargarConfigSlider()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      mostrarSliders();
    }
  };
  var p='opcion=cargar';
  xmlhttp.open("GET","../modelos/config_slider.php?"+p,true);
  xmlhttp.send();
}
function mostrarSliders()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("contenido").innerHTML = xmlhttp.responseText;
    }
  };
  var p='opcion=mostrar';
  xmlhttp.open("GET","../modelos/config_slider.php?"+p,true);
  xmlhttp.send();
}
function nuevoSlider()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-slider").innerHTML = xmlhttp.responseText;
      $("#modalSlider").modal();
    }
  };
   var p='opcion=nuevo';
   xmlhttp.open("GET","../modelos/config_slider.php?"+p,true);
   xmlhttp.send();
}
function agregarSlider()
{
  /*document.getElementById('frmSlider').submit();
  cargarConfigSlider();*/
  var formulario = document.getElementById("frmSlider");
  var dato = formulario[0];

  if (dato.value=="enviar"){
    alert("Enviando el formulario");
    formulario.submit();
    return true;
  } else {
    alert("No se envía el formulario");
    return false;
  }
}

function editarSlider(Id)
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-slider").innerHTML = xmlhttp.responseText;
      $("#modalSlider").modal();
    }
  };
   var p='opcion=editar&Id='+Id;
   xmlhttp.open("GET","../modelos/config_slider.php?"+p,true);
   xmlhttp.send();
}

function eliminarSlider(Id)
{
  var confirmar = confirm("¿Eliminar Slider?");
  if (confirmar==true)
  {
    //window.location.href = '../modelos/config_slider.php?opcion=eliminar&Id='+Id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById("alerta").innerHTML = xmlhttp.responseText;
        mostrarSliders();
      }
    };
     var p='opcion=eliminar&Id='+Id;
     xmlhttp.open("GET","../modelos/config_slider.php?"+p,true);
     xmlhttp.send();
  }
}

function mostrarCarousel()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("contenido-carousel").innerHTML = xmlhttp.responseText;
    }
  };
   var p='opcion=mostrarCarousel';
   xmlhttp.open("GET","modelos/config_slider.php?"+p,true);
   xmlhttp.send();
}
