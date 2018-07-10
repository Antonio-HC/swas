function cargarPedidos()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp = xmlhttp.responseText;
    }
  };
  var p = 'opcion=cargar';
  xmlhttp.open("GET","../modelos/pedidos.php?"+p,true);
  xmlhttp.send();
}
