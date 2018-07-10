
function usuario()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("user_name").innerHTML = xmlhttp.responseText;
      tipoUsuario();
      tipoUsuarioEscritorio();
    }
  };
  var usu='opcion=usuario';
  xmlhttp.open("GET","../modelos/principal.php?"+usu,true);
  xmlhttp.send();
}
function tipoUsuario()
{
  xmlhttp2 = new XMLHttpRequest();
  xmlhttp2.onreadystatechange = function()
  {
    if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
    {
      document.getElementById("main-menu").innerHTML = xmlhttp2.responseText;
    }
  };
  var tipo='opcion=menu';
  xmlhttp2.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp2.send();
}
function tipoUsuarioEscritorio()
{
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("main-content").innerHTML = xmlhttp.responseText;
      switch (xmlhttp.responseText) {
        case "Administrador":
          cargarEscritorio();
          break;
        case "Empleado":
          cargarEscritorioEmpleado();
          break;
      }
    }
  };
  var tipo='opcion=escritorio';
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function logout()
{
  var confirmar = confirm("¿Cerrar sesión?");
  if (confirmar==true)
  {
    window.location.href = '../modelos/user_logout.php';
  }
}
function modal()
{
  modal = new XMLHttpRequest();
  modal.onreadystatechange = function()
  {
    if (modal.readyState == 4 && modal.status == 200)
    {
      document.getElementById("modal-body").innerHTML = modal.responseText;
    }
  };
  var tipo='opcion=modal';
  modal.open("GET","../modelos/principal.php?"+tipo,true);
  modal.send();
}
function editarNombreUsuario()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-configurar-usuario").innerHTML = xmlhttp.responseText;
      $('#modalCambiarUsuario').modal();
    }
  };
  var tipo='opcion=editarUsuario';
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function cambiarUser()
{
  var old = document.getElementById('tfUsuarioOld').value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      if (xmlhttp.responseText==old) {
        document.getElementById("input-old").setAttribute('class','form-group has-success has-feedback');
        verificarPassword();
      }
      else {
        document.getElementById("input-old").setAttribute('class','form-group has-error has-feedback');
      }
    }/*Finaliza readyState*/
  };
  var tipo='opcion=user';
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function verificarPassword()
{
  var nuevoUsuario  = document.getElementById('tfUsuario').value;
  var password  = document.getElementById('tfUsuarioPassword').value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      if (xmlhttp.responseText==password) {
        document.getElementById("input-password").setAttribute('class','form-group has-success has-feedback');
        modificarUser(nuevoUsuario);
      }
      else {
        document.getElementById("input-password").setAttribute('class','form-group has-error has-feedback');
      }
    }
  };
  var tipo='opcion=password';
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function modificarUser(usuario)
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      alert(xmlhttp.responseText);
      $('#modalCambiarUsuario').modal('hide');
      window.location.href = '../modelos/user_logout.php';
    }
  };
  var tipo='opcion=modificarUsuario&usuario='+usuario;
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function editarPassword()
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      document.getElementById("modal-configurar-usuario").innerHTML = xmlhttp.responseText;
      $('#modalCambiarPassword').modal();
    }
  };
  var tipo='opcion=editarPassword';
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function cambiarPassword()
{
  var old       = document.getElementById('tfPasswordOld').value;
  var nueva     = document.getElementById('tfPasswordNueva').value;
  var confirmar = document.getElementById('tfPasswordConfirmar').value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      if (xmlhttp.responseText==old) {
        document.getElementById("input-old").setAttribute('class','form-group has-success has-feedback');
        if (nueva==confirmar) {
          document.getElementById("input-confirmar").setAttribute('class','form-group has-success has-feedback');
          modificarPassword(confirmar);
        }
        else {
          document.getElementById("input-confirmar").setAttribute('class','form-group has-error has-feedback');
        }
      }
      else {
        document.getElementById("input-old").setAttribute('class','form-group has-error has-feedback');
      }
    }/*Finaliza readyState*/
  };
  var tipo='opcion=password';
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function modificarPassword(password)
{
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      alert(xmlhttp.responseText);
      $('#modalCambiarPassword').modal('hide');
      window.location.href = '../modelos/user_logout.php';
    }
  };
  var tipo='opcion=modificarPassword&password='+password;
  xmlhttp.open("GET","../modelos/principal.php?"+tipo,true);
  xmlhttp.send();
}
function verificarBD()
{

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function()
  {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    {
      if (xmlhttp.responseText=="ok") {
        mostrarCarousel();
      }
      else {
        alert("Error al conectar con la Base de Datos!");
      }
    }
  };
   var p='opcion=verificar';
   xmlhttp.open("GET","modelos/principal.php?"+p,true);
   xmlhttp.send();
}
