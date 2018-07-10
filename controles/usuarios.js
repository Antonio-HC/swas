//Cargar funciones de usuarios

function cargarUsuarios()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      mostrarUsuario();
    }
  };
  var p='opcion=cargar';
  xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
  xmlhttp.send();
}

function mostrarUsuario()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("contenido").innerHTML = xmlhttp.responseText;
      $('#tblUsuarios').DataTable();
    }
  };
  var p='opcion=mostrar';
  xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
  xmlhttp.send();
}
function verificarUsuario()
{
  var buscar=document.getElementById('tfUsuario').value;
  var xmlhttp = new XMLHttpRequest;
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("alert-usuario").innerHTML = xmlhttp.responseText;
    }
  };
  consulta="SELECT * FROM USUARIOS WHERE Usuario='"+buscar+"'";
  var p = 'opcion=usuario&consulta='+consulta;
  xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
  xmlhttp.send();
}
function nuevoUsuario()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-usuarios").innerHTML = xmlhttp.responseText;
      $("#modalUsuario").modal();
    }
  };
   var p='opcion=nuevo';
   xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
   xmlhttp.send();
}
function agregarUsuario()
{
	var tfNombre  = document.getElementById('tfNombre').value;
	var tfPaterno = document.getElementById('tfPaterno').value;
	var tfMaterno = document.getElementById('tfMaterno').value;
	var tfUsuario = document.getElementById('tfUsuario').value;
	var pfPassword= document.getElementById('pfPassword').value;
  var cbTipo    = document.getElementById('cbTipo').value;

  if (tfNombre=="" || tfPaterno=="" || tfMaterno=="" || tfUsuario=="" || pfPassword=="")
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
          +   "Usuario agregado."
          +"</div>";
        $("#modalUsuario").modal("hide");
        mostrarUsuario();
      }
    };
    var p='opcion=agregar&Nombre='+tfNombre+'&Paterno='+tfPaterno+'&Materno='+tfMaterno+'&Usuario='+tfUsuario+'&Password='+pfPassword+'&TipoUsuario='+cbTipo;
    xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
    xmlhttp.send();
  }
}
function editarUsuario(IdUsuario)
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-usuarios").innerHTML = xmlhttp.responseText;
      $("#modalUsuario").modal();
    }
  };
  var p='opcion=editar&IdUsuario='+IdUsuario;
  xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
  xmlhttp.send();
}

function modificarUsuario()
{
  var tfId  = document.getElementById('tfId').value;
  var tfNombre  = document.getElementById('tfNombre').value;
	var tfPaterno = document.getElementById('tfPaterno').value;
	var tfMaterno = document.getElementById('tfMaterno').value;
	var tfUsuario = document.getElementById('tfUsuario').value;
	var pfPassword= document.getElementById('pfPassword').value;
  var cbTipo    = document.getElementById('cbTipo').value;

  if (tfNombre=="" || tfPaterno=="" || tfMaterno=="" || tfUsuario=="" || pfPassword=="")
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
        $("#modalUsuario").modal("hide");
        mostrarUsuario();
      }
    };
    var p='opcion=modificar&Id='+tfId+'&Nombre='+tfNombre+'&Paterno='+tfPaterno+'&Materno='+tfMaterno+'&Usuario='+tfUsuario+'&Password='+pfPassword+'&TipoUsuario='+cbTipo;
    xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
    xmlhttp.send();
  }
}

function eliminarUsuario(IdUsuario)
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
      mostrarUsuario();
    }
  };
  var p='opcion=eliminar&IdUsuario='+IdUsuario;
  xmlhttp.open("GET","../modelos/usuarios.php?"+p,true);
  xmlhttp.send();
}
