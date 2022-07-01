$(document).ready(function () {

    $("#iniciar").click(login.InicioSesion);
  
});

class login {
  static InicioSesion() {
    event.preventDefault();
    var user = $("#Usuario").val();
    var pass = $("#Clave").val();
    if (user != null && user != "") {
        let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/APISICONPrueba/api/Login/'+ user +'/'+ pass);
    xhr.send();
    xhr.onload = function() {
       if (xhr.status != 200) {    
       alert('Usuario o contraseña incorrectos'); 
       } else { 
       window.location.href = "http://localhost/FrontSICONPrueba/CRUD.html"
       }
     };

    xhr.onerror = function() {
     alert("Solicitud fallida");
      };
    }else{
        alert("Debe ingresar usuario y contraseña");
    }
    }
    
}
