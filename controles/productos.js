//Funciones para productos
function cargarProductos()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp = xmlhttp.responseText;
      mostrarProductos();
    }
  };
  var p = 'opcion=cargar';
  xmlhttp.open("GET","../modelos/productos.php?"+p,true);
  xmlhttp.send();
}
function mostrarProductos()
{
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("contenido").innerHTML = xmlhttp = xmlhttp.responseText;
      $('#tblProductos').DataTable();
    }
  };
  var consulta="SELECT p.Codigo,p.Nombre,p.Cantidad,p.PrecioCompra,p.PrecioVenta,p.Descripcion,pro.Nombre AS Proveedor,c.Nombre AS Categoria,p.Fabricante,p.Fabricante,p.Imagen ";
      consulta+="FROM PRODUCTOS p, PROVEEDORES pro, CATEGORIAS c ";
      consulta+="WHERE pro.IdProveedor=p.Proveedor AND c.IdCategoria=p.Categoria ORDER BY p.Nombre";
  var p = 'opcion=mostrar&consulta='+consulta;
  xmlhttp.open("GET","../modelos/productos.php?"+p,true);
  xmlhttp.send();
}
function buscarProducto()
{
  var buscar=document.getElementById('tfBuscar').value;

  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("contenido").innerHTML = xmlhttp = xmlhttp.responseText;
    }
  };
  var consulta="SELECT p.Codigo,p.Nombre,p.Cantidad,p.PrecioCompra,p.PrecioVenta,p.Descripcion,pro.Nombre AS Proveedor,c.Nombre AS Categoria,p.Fabricante,p.Fabricante,p.Imagen ";
      consulta+="FROM PRODUCTOS p, PROVEEDORES pro, CATEGORIAS c ";
      consulta+="WHERE pro.IdProveedor=p.Proveedor AND c.IdCategoria=p.Categoria and CONCAT(p.Codigo,'',p.Nombre,'',p.Descripcion,'',p.Fabricante) LIKE '%"+buscar+"%' ORDER BY p.Nombre";

  var p = 'opcion=mostrar&consulta='+consulta;
  xmlhttp.open("GET","../modelos/productos.php?"+p,true);
  xmlhttp.send();
}
function mayus()
{
  //combierte a mayusculas
  var buscar = document.getElementById("tfBuscar");
  buscar.value = buscar.value.toUpperCase();
}
function verificarCodigo()
{
  var buscar=document.getElementById('tfCodigo').value;
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("alert-codigo").innerHTML = xmlhttp = xmlhttp.responseText;
    }
  };
  consulta="SELECT * FROM PRODUCTOS WHERE Codigo='"+buscar+"'";
  var p = 'opcion=codigo&consulta='+consulta;
  xmlhttp.open("GET","../modelos/productos.php?"+p,true);
  xmlhttp.send();
}
function nuevoProducto()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-productos").innerHTML = xmlhttp.responseText;
      $("#modalProducto").modal();
    }
  };
   var p='opcion=nuevo';
   xmlhttp.open("GET","../modelos/productos.php?"+p,true);
   xmlhttp.send();
}
function agregarProducto()
{
	/*var tfCodigo     = document.getElementById('tfCodigo').value;
	var tfNombre     = document.getElementById('tfNombre').value;
	var tfDescripcion= document.getElementById('tfDescripcion').value;
	var tfCantidad= document.getElementById('tfCantidad').value;
	var tfCompra     = document.getElementById('tfCompra').value;
	var tfVenta      = document.getElementById('tfVenta').value;
	var tfFabricante = document.getElementById('tfFabricante').value;
	var tfExistencia = document.getElementById('tfExistencia').value;
  var cbCat        = document.getElementById('cbCat').value;
  var cbPro        = document.getElementById('cbPro').value;
  var fImagen      = document.getElementById('fImagen').files[0].name;;

  if (tfCodigo=="" || tfNombre=="" || tfDescripcion=="" || tfCantidad=="" || tfCompra=="" || tfVenta=="" || tfFabricante=="" || tfExistencia=="")
  {
    document.getElementById("mensaje").innerHTML
      = "<div class='alert alert-warning alert-dismissable'>"
      +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
      +   "Campos vacíos."
      +"</div>";
  }
  else if (cbCat=="--Seleccione--" || cbPro=="--Seleccione--")
  {
    document.getElementById("mensaje").innerHTML
      = "<div class='alert alert-warning alert-dismissable'>"
      +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
      +   "Seleccione."
      +"</div>";
  }
  else
  {
  	xmlhttp = new XMLHttpRequest();
  	xmlhttp.onreadystatechange = function()
  	{
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById("contenido").innerHTML = xmlhttp.responseText;
        document.getElementById("alerta").innerHTML
          = "<div class='alert alert-success alert-dismissable'>"
          +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
          +   "Producto agregado."
          +"</div>";
        $("#modalProducto").modal("hide");
      //  mostrarProductos();
      }
    };
    var p='opcion=agregar&codigo='+tfCodigo+'&nombre='+tfNombre+'&descripcion='+tfDescripcion+'&cantidad='+tfCantidad+'&compra='+tfCompra+'&venta='+tfVenta+'&existencia='+tfExistencia+'&fabricante='+tfFabricante+'&categoria='+cbCat+'&proveedor='+cbPro+'&image='+fImagen;
    xmlhttp.open("GET","../modelos/productos.php?"+p,true);
    xmlhttp.send();
  }*/
}
function editarProducto(codigo)
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-productos").innerHTML = xmlhttp.responseText;
      $("#modalProducto").modal();
    }
  };
  var p='opcion=editar&codigo='+codigo;
  xmlhttp.open("GET","../modelos/productos.php?"+p,true);
  xmlhttp.send();
}
function modificarProducto()
{
  var tfCodigo     = document.getElementById('tfCodigo').value;
	var tfNombre     = document.getElementById('tfNombre').value;
	var tfDescripcion= document.getElementById('tfDescripcion').value;
	var tfCantidad= document.getElementById('tfCantidad').value;
	var tfCompra     = document.getElementById('tfCompra').value;
	var tfVenta      = document.getElementById('tfVenta').value;
	var tfFabricante = document.getElementById('tfFabricante').value;
  var cbCat        = document.getElementById('cbCat').value;
  var cbPro        = document.getElementById('cbPro').value;

  if (tfCodigo=="" || tfNombre=="" || tfDescripcion=="" || tfCantidad=="" || tfCompra=="" || tfVenta=="" || tfFabricante=="")
  {
    document.getElementById("mensaje").innerHTML
      = "<div class='alert alert-warning alert-dismissable'>"
      +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
      +   "Campos vacíos."
      +"</div>";
  }
  else if (cbCat=="--Seleccione--" || cbPro=="--Seleccione--")
  {
    document.getElementById("mensaje").innerHTML
      = "<div class='alert alert-warning alert-dismissable'>"
      +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
      +   "Seleccione."
      +"</div>";
  }
  else
  {
  	xmlhttp = new XMLHttpRequest();
  	xmlhttp.onreadystatechange = function()
  	{
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById("contenido").innerHTML = xmlhttp.responseText;
        document.getElementById("alerta").innerHTML
          = "<div class='alert alert-success alert-dismissable'>"
          +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
          +   "Cambios guardados."
          +"</div>";
        $("#modalProducto").modal("hide");
        mostrarProductos();
      }
    };
    var p='opcion=modificar&codigo='+tfCodigo+'&nombre='+tfNombre+'&descripcion='+tfDescripcion+'&cantidad='+tfCantidad+'&compra='+tfCompra+'&venta='+tfVenta+'&fabricante='+tfFabricante+'&categoria='+cbCat+'&proveedor='+cbPro;
    xmlhttp.open("GET","../modelos/productos.php?"+p,true);
    xmlhttp.send();
  }
}
function eliminarProducto(codigo)
{
  var confirmar = confirm("¿Eliminar Producto?");
  if (confirmar==true)
  {
    //window.location.href = '../modelos/config_slider.php?opcion=eliminar&Id='+Id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById("alerta").innerHTML = xmlhttp.responseText;
        mostrarProductos();
      }
    };
     var p='opcion=eliminar&Codigo='+codigo
     xmlhttp.open("GET","../modelos/productos.php?"+p,true);
     xmlhttp.send();
  }
}
function ordenarProductos(ordena)
{
  if (ordena == "")
    {
      mostrarProductos();
    }
    else
    {
      var xmlhttp = new XMLHttpRequest;
      xmlhttp.onreadystatechange = function()
      {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById("contenido").innerHTML = xmlhttp = xmlhttp.responseText;
          $('#tblProductos').DataTable();
        }
      };
      var consulta="SELECT p.Codigo,p.Nombre,p.Cantidad,p.PrecioCompra,p.PrecioVenta,p.Descripcion,pro.Nombre AS Proveedor,c.Nombre AS Categoria,p.Fabricante,p.Imagen ";
          consulta+="FROM PRODUCTOS p, PROVEEDORES pro, CATEGORIAS c ";
          consulta+="WHERE pro.IdProveedor=p.Proveedor AND c.IdCategoria=p.Categoria ORDER BY "+ordena;
      var p = 'opcion=mostrar&consulta='+consulta;
      xmlhttp.open("GET","../modelos/productos.php?"+p,true);
      xmlhttp.send();
    }
}
