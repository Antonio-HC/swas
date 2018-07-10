//Cargar funciones de proveedores

function cargarProveedores()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      mostrarProveedores();
    }
  };
  var p='opcion=cargar';
  xmlhttp.open("GET","../modelos/proveedores.php?"+p,true);
  xmlhttp.send();
}

function mostrarProveedores()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("contenido").innerHTML = xmlhttp.responseText;
      $('#tblProveedores').DataTable();
    }
  };
  var p='opcion=mostrar';
  xmlhttp.open("GET","../modelos/proveedores.php?"+p,true);
  xmlhttp.send();
}

function nuevoProveedor()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-proveedores").innerHTML = xmlhttp.responseText;
      $("#modalProveedor").modal();
    }
  };
   var p='opcion=nuevo';
   xmlhttp.open("GET","../modelos/proveedores.php?"+p,true);
   xmlhttp.send();
}
function agregarProveedor()
{
	var tfNombre  = document.getElementById('tfNombre').value;
	var tfTelefono = document.getElementById('tfTelefono').value;


  if (tfNombre=="" || tfTelefono=="")
  {
    document.getElementById("mensaje").innerHTML
      = "<div class='alert alert-warning alert-dismissable'>"
      +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
      +   "Campos vacíos."
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
          +   "Proveedor agregado."
          +"</div>";
        $("#modalProveedor").modal("hide");
        mostrarProveedores();
      }
    };
    var p='opcion=agregar&Nombre='+tfNombre+'&Telefono='+tfTelefono;
    xmlhttp.open("GET","../modelos/proveedores.php?"+p,true);
    xmlhttp.send();
  }
}
function editarProveedor(IdProveedor)
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-proveedores").innerHTML = xmlhttp.responseText;
      $("#modalProveedor").modal();
    }
  };
  var p='opcion=editar&IdProveedor='+IdProveedor;
  xmlhttp.open("GET","../modelos/proveedores.php?"+p,true);
  xmlhttp.send();
}

function modificarProveedor()
{
  var tfId  = document.getElementById('tfId').value;
  var tfNombre  = document.getElementById('tfNombre').value;
	var tfTelefono = document.getElementById('tfTelefono').value;

  if (tfNombre=="" || tfTelefono=="")
  {
    document.getElementById("mensaje").innerHTML
      = "<div class='alert alert-warning alert-dismissable'>"
      +   "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>"
      +   "Campos vacíos."
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
        $("#modalProveedor").modal("hide");
        mostrarProveedores();
      }
    };
    var p='opcion=modificar&Id='+tfId+'&Nombre='+tfNombre+'&Telefono='+tfTelefono;
    xmlhttp.open("GET","../modelos/proveedores.php?"+p,true);
    xmlhttp.send();
  }
}

function eliminarProveedor(IdProveedor)
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
        +   "Usuario eliminado!"
        +"</div>";
      mostrarProveedores();
    }
  };
  var p='opcion=eliminar&IdProveedor='+IdProveedor;
  xmlhttp.open("GET","../modelos/proveedores.php?"+p,true);
  xmlhttp.send();
}
