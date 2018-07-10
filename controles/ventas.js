function cargarVentas()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      mostrarVentas();
    }
  };
  var p = 'opcion=cargar';
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function mostrarVentas()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("opciones").style.display='block';
      document.getElementById("contenido").innerHTML = xmlhttp.responseText;
      $('#tblVentas').DataTable();
    }
  };
  var consulta='SELECT v.IdVenta,v.ProductosVendidos,v.Fecha,v.Total,u.Nombre AS Usuario FROM VENTAS v,USUARIOS u WHERE u.IdUsuario=v.Usuario';
  var p = 'opcion=mostrar&consulta='+consulta;
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function verDetalleVenta(id,fecha,cantidad,total)
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("opciones").style.display='none';
      document.getElementById("contenido").innerHTML = xmlhttp.responseText;
      document.getElementById("idVentaDetalle").innerHTML = id;
      document.getElementById("fechaVentaDetalle").innerHTML = fecha;
      document.getElementById("cantidadVentaDetalle").innerHTML = cantidad;
      document.getElementById("totalVentaDetalle").innerHTML = total;
      $('#tblDetalleVenta').DataTable();
    }
  };
  var consulta = "SELECT p.Codigo,CONCAT_WS(' ',p.Nombre,p.Descripcion) AS Producto,dv.Cantidad,dv.PrecioUnitario,dv.Total ";
      consulta+= " FROM DETALLEVENTA dv, PRODUCTOS p WHERE p.Codigo=dv.Producto AND dv.IdVenta='"+id+"'";
  var p = 'opcion=verDetalleVenta&consulta='+consulta;
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function puntoDeVenta()
{
  cargarVentas();
  setTimeout(function(){nuevaVenta()},500); // 500ms = 0.5s
}
function nuevaVenta()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("opciones").style.display='none';
      document.getElementById("contenido").innerHTML  = xmlhttp.responseText;
      numeroVenta();
    }
  };
  var p = 'opcion=nuevo';
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function agregarProducto_venta()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-ventas").innerHTML = xmlhttp.responseText;
      listaProductos();
      $('#modalVenta').modal();
    }
  };
  var p = 'opcion=agregar';
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function listaProductos()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("venta-lista-productos").innerHTML = xmlhttp.responseText;
      $('#tblListaProductos').dataTable({
              "bPaginate": false,
              "bLengthChange": true,
              "bFilter": true,
              "bSort": false,
              "bInfo": false,
              "bAutoWidth": false
        });
    }
  };

  var p = 'opcion=listaProductos';
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function cantidadProducto_venta(codigo)
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      $('#modalVenta').modal('hide');
      document.getElementById("modal-ventas").innerHTML = xmlhttp.responseText;
      maxCantidad(codigo);
      $('#modalVentaCantidad').modal();
    }
  };
  var p = 'opcion=cantidadProducto_venta&codigo='+codigo;
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function seleccionarProducto_venta(codigo)
{
  var cantidad = document.getElementById('tfCantidadProducto').value;
  var tabla    = document.getElementById('tblVentaAgregar');
  var noFilas  = (tabla.rows.length);
  var xmlhttp  = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
     if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
     {
        var row = tabla.insertRow(noFilas).outerHTML  = xmlhttp.responseText;
        document.getElementById("tfTotal").value = totalVenta();
        document.getElementById("btnRealizarVenta").disabled=false;
        $('#modalVentaCantidad').modal('hide');
     }
   };
   var p = 'opcion=seleccionar&codigo='+codigo+'&cantidad='+cantidad;
   xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
   xmlhttp.send();
}
function guardarVenta()
{
  var idVenta = document.getElementById('tfIdVenta').value;
  var date    = new Date();
  var fecha   = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
	var vendido = totalProductos();
	var total   = document.getElementById('tfTotal').value;

	var  xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      guardarDetalleVenta(idVenta);
      $('#modalVentaCobrar').modal('hide');
      document.getElementById("contenido").innerHTML = xmlhttp.responseText;
      mostrarVentas();
    }
  };
  var p='opcion=guardar&id='+idVenta+'&fecha='+fecha+'&vendido='+vendido+'&total='+total;
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function guardarDetalleVenta(idVenta)
{
  var tabla   = document.getElementById('tblVentaAgregar');
  var noFilas = (tabla.rows.length)-1;

  for (var i = 1; i < noFilas; i++) {
    var codigo   = document.getElementById('tblVentaAgregar').tBodies[0].rows[i].cells[0].innerHTML;
    var cantidad = document.getElementById('tblVentaAgregar').tBodies[0].rows[i].cells[2].innerHTML;
    var precio   = document.getElementById('tblVentaAgregar').tBodies[0].rows[i].cells[3].innerHTML;
    var total    = document.getElementById('tblVentaAgregar').tBodies[0].rows[i].cells[4].innerHTML;

    var  xmlhttp = new XMLHttpRequest();
  	xmlhttp.onreadystatechange = function()
  	{
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        //No accion
      }
    };
    var p='opcion=guardarDetalleVenta&codigo='+codigo+'&cantidad='+cantidad+'&precio='+precio+'&total='+total+'&id='+idVenta;
    xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
    xmlhttp.send();
  }
}
function numeroVenta()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("tfIdVenta").setAttribute('value',xmlhttp.responseText);
      document.getElementById("lblIdVenta").innerHTML = xmlhttp.responseText;
    }
  };
  var p = 'opcion=nVenta';
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function quitarProducto(fila)
{
  var i = fila.parentNode.parentNode.rowIndex;
  document.getElementById("tblVentaAgregar").deleteRow(i);
  document.getElementById("tfTotal").value = totalVenta();
}
function limpiarTabla()
{
  var confirmar = confirm("¿Cancelar venta?");
  if (confirmar==true)
  {
    mostrarVentas();
  }
}
function limpiarTablaEmpleado()
{
  var confirmar = confirm("¿Cancelar venta?");
  if (confirmar==true)
  {
    nuevaVenta();
  }
}
function totalVenta()
{
  var suma = 0;
  $('#tblVentaAgregar tr.trDato').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
   suma += parseInt($(this).find('td').eq(4).text()||0,10) //numero de la celda 5
  })
  return suma;
}
function totalProductos()
{
  var suma = 0;
  $('#tblVentaAgregar tr.trDato').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
   suma += parseInt($(this).find('td').eq(2).text()||0,10) //numero de la celda 3
  })
  return suma;
}
function cobrarVenta()
{
  var  xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()
	{
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-ventas").innerHTML = xmlhttp.responseText;
      $('#modalVentaCobrar').modal();
    }
  };
  var p='opcion=cobrar';
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function cambio()
{
  var recibe = parseFloat(document.getElementById('tfRecibe').value);
  var total  = parseFloat(document.getElementById('tfTotal').value);

  if (recibe >= total) {
    var cambio = parseFloat(recibe-total);
    document.getElementById("tfCambio").value = cambio;
    document.getElementById("btnGuardarVenta").disabled=false;
    document.getElementById("input-recibe").setAttribute('class','form-group has-success has-feedback');
  }
  else if (recibe<total)
  {
    document.getElementById("input-recibe").setAttribute('class','form-group has-error has-feedback');
    document.getElementById("btnGuardarVenta").disabled=true;
  }
  else {
    document.getElementById("input-recibe").setAttribute('class','form-group has-error has-feedback');
    document.getElementById("btnGuardarVenta").disabled=true;
  }
}
function eliminarVenta(id)
{
  var confirmar = confirm("¿Eliminar registro?");
  if (confirmar==true)
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById("contenido").innerHTML = xmlhttp.responseText;
        document.getElementById("alerta").innerHTML
          = "<div class='alert alert-success alert-dismissable'>"
          +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
          +   "Venta eliminada!"
          +"</div>";
        mostrarVentas();
      }
    };
    var p='opcion=eliminarVenta&id='+id;
    xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
    xmlhttp.send();
  }
}
function maxCantidad(codigo)
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("tfCantidadProducto").setAttribute('max',xmlhttp.responseText);
      $("[type='number']").keypress(function (evt) {
          evt.preventDefault();
      });
    }
  };
  var p='opcion=maxCantidad&codigo='+codigo;
  xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
  xmlhttp.send();
}
function ordenarVentas(condicion)
{
  var date    = new Date();
  var fecha   = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

  switch (condicion) {
    case "hoy":
      {
        var xmlhttp = new XMLHttpRequest;
        xmlhttp.onreadystatechange = function()
        {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
          {
            document.getElementById("contenido").innerHTML = xmlhttp.responseText;
            $('#tblVentas').DataTable();
          }
        };
        var consulta='SELECT v.IdVenta,v.ProductosVendidos,v.Fecha,v.Total,u.Nombre AS Usuario ';
            consulta+=' FROM VENTAS v,USUARIOS u WHERE u.IdUsuario=v.Usuario AND Fecha="'+fecha+'"';
        var p = 'opcion=mostrar&consulta='+consulta;
        xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
        xmlhttp.send();
      }
      break;
    case "todo":
      mostrarVentas();
      break;
  }
  /*if (condicion=="todo") {
    mostrarVentas();
    alert("aqui estoy")
  }
  else {
    var xmlhttp = new XMLHttpRequest;
    xmlhttp.onreadystatechange = function()
    {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById("contenido").innerHTML = xmlhttp.responseText;
        $('#tblVentas').DataTable();
      }
    };
    var consulta='SELECT v.IdVenta,v.ProductosVendidos,v.Fecha,v.Total,u.Nombre AS Usuario';
        consulta+='FROM VENTAS v,USUARIOS u WHERE u.IdUsuario=v.Usuario AND Fecha="'+condicion+'"';
        alert(consulta);
    var p = 'opcion=mostrar&consulta='+consulta;
    xmlhttp.open("GET","../modelos/ventas.php?"+p,true);
    xmlhttp.send();
  }*/

}
