$(document).ready(function() {
  $('#login').click(function(){
    var User = $('#user').val();
    var Pass = $('#pass').val();
    if($.trim(User).length > 0 && $.trim(Pass).length > 0){
      $.ajax({
        url:"modelos/user_autenticar.php",
        method:"POST",
        data:{User:User, Pass:Pass},
        cache:"false",
        beforeSend:function() {
          $('#login').val("Conectando...");
        },
        success:function(data) {
          $('#login').val("Acceder");
          if (data=="1") {
            $(location).attr('href','vistas/');
          } else {
            $("#result").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error de autenticación!</strong> Usuario o contraseña incorrectos.</div>");
          }
        }
      });
    };
  });
});
