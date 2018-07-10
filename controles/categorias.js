//Cargar funciones de categorias

function cargarCategorias()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      mostrarCategorias();
    }
  };
  var p='opcion=cargar';
  xmlhttp.open("GET","../modelos/categorias.php?"+p,true);
  xmlhttp.send();
}

function mostrarCategorias()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("contenido").innerHTML = xmlhttp.responseText;
      $('#tblCategorias').DataTable();
    }
  };
  var p='opcion=mostrar';
  xmlhttp.open("GET","../modelos/categorias.php?"+p,true);
  xmlhttp.send();
}

function nuevoCategoria()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-categorias").innerHTML = xmlhttp.responseText;
      $("#modalCategoria").modal();
    }
  };
   var p='opcion=nuevo';
   xmlhttp.open("GET","../modelos/categorias.php?"+p,true);
   xmlhttp.send();
}
function agregarCategoria()
{
	var tfNombre  = document.getElementById('tfNombre').value;
  if (tfNombre=="")
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
          +   "Categoria agregado."
          +"</div>";
        $("#modalCategoria").modal("hide");
        mostrarCategorias();
      }
    };
    var p='opcion=agregar&Nombre='+tfNombre;
    xmlhttp.open("GET","../modelos/categorias.php?"+p,true);
    xmlhttp.send();
  }
}
function editarCategoria(IdCategoria)
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-categorias").innerHTML = xmlhttp.responseText;
      $("#modalCategoria").modal();
    }
  };
  var p='opcion=editar&IdCategoria='+IdCategoria;
  xmlhttp.open("GET","../modelos/categorias.php?"+p,true);
  xmlhttp.send();
}

function modificarCategoria()
{
  var tfId  = document.getElementById('tfId').value;
  var tfNombre  = document.getElementById('tfNombre').value;

  if (tfNombre=="")
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
        $("#modalCategoria").modal("hide");
        mostrarCategorias();
      }
    };
    var p='opcion=modificar&Id='+tfId+'&Nombre='+tfNombre;
    xmlhttp.open("GET","../modelos/categorias.php?"+p,true);
    xmlhttp.send();
  }
}

function eliminarCategoria(IdCategoria)
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
      mostrarCategorias();
    }
  };
  var p='opcion=eliminar&IdCategoria='+IdCategoria;
  xmlhttp.open("GET","../modelos/categorias.php?"+p,true);
  xmlhttp.send();
}
