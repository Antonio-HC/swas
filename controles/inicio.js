function cargarEscritorio()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      cantidadProductos();
      cantidadVentas();
      cantidadProveedores();
      productosAgotados();
      productosPorAgotar();
    }
  };
  var p='opcion=cargar';
  xmlhttp.open("GET","../modelos/inicio.php?"+p,true);
  xmlhttp.send();
}
function cargarEscritorioEmpleado()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      cantidadProductos();
      cantidadVentas();
      cantidadProveedores();
      productosAgotados();
      productosPorAgotar();
    }
  };
  var p='opcion=cargarEscritorioEmpleado';
  xmlhttp.open("GET","../modelos/inicio.php?"+p,true);
  xmlhttp.send();
}
function cantidadProductos()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("panelProductos").innerHTML = xmlhttp.responseText;
    }
  };
  var p='opcion=cantidadProductos';
  xmlhttp.open("GET","../modelos/inicio.php?"+p,true);
  xmlhttp.send();
}
function cantidadVentas()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("panelVentas").innerHTML = xmlhttp.responseText;
    }
  };
  var p='opcion=cantidadVentas';
  xmlhttp.open("GET","../modelos/inicio.php?"+p,true);
  xmlhttp.send();
}
function cantidadProveedores()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("panelProveedores").innerHTML = xmlhttp.responseText;
    }
  };
  var p='opcion=cantidadProveedores';
  xmlhttp.open("GET","../modelos/inicio.php?"+p,true);
  xmlhttp.send();
}
function productosAgotados()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("panelAgotados").innerHTML = xmlhttp.responseText;
      document.getElementById("notificacion-agotado").innerHTML = xmlhttp.responseText;
    }
  };
  var p='opcion=productosAgotados';
  xmlhttp.open("GET","../modelos/inicio.php?"+p,true);
  xmlhttp.send();
}
function productosPorAgotar()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("notificacion-por-Agotar").innerHTML = xmlhttp.responseText;
    }
  };
  var p='opcion=productosPorAgotar';
  xmlhttp.open("GET","../modelos/inicio.php?"+p,true);
  xmlhttp.send();
}
