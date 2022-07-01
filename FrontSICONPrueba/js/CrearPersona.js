$(document).ready(function () {

    
    CrearPersona.CargaTipoDoc();
    $("#tipodoc").change(CrearPersona.CargaSexo);
    $("#sexo").change(CrearPersona.CargaDepartamento);
    $("#departamento").change(CrearPersona.CargaMunicipioPorIdDepart);
    $("#GuardarPersona").click(CrearPersona.GuardarPersona);
});

class CrearPersona {

  static GuardarPersona() {
   
    $("#formCrear").validate({
        event: "blur",
        rules: {
            "tipodoc": "required",
            "documentos": "required",
            "nombres": "required",
            "apellidos": "required",
            "sexo": "required",
            "departamento": "required",
            "municipio": "required",
            "email": "required",
            "clave": "required"
        },
        messages: {
          "tipodoc": "Debe seleccionar tipo documento",
          "documentos": "Debe ingresar documento",
          "nombres": "Debe ingresar nombres",
         "apellidos": "Debe ingresar apellidos",
         "sexo": "Debe seleccionar sexo",
         "departamento": "Debe seleccionar departamento",
         "municipio": "Debe seleccionar municipio",
          "email": "Debe ingresar email sexo",
          "clave": "Debe ingresar clave sexo"
        },
       // debug: true,
        errorElement: "small",
        submitHandler: function (form) {
          event.preventDefault();
            let xhr = new XMLHttpRequest();  
            let persona = {};
            persona.tipoDocumento1 = $("#tipodoc").val();
            persona.documento1 = $("#documentos").val();
            persona.nombres1 = $("#nombres").val();
            persona.apellidos1 = $("#apellidos").val();
            persona.sexo1 = $("#sexo").val();
            persona.departamento1 = $("#departamento").val();
            persona.municipio1 = $("#municipio").val();
            persona.email1 = $("#email").val();
            persona.contrasena1 = $("#clave").val();           
            //let data = JSON.stringify(user);
            //let data =JSON.stringify({"tipodocumento1": tipoDoc, "documento1": documento, "nombres1":nombres,"apellidos1":apellidos,"sexo1":sexo, "departamento1":departamento,"municipio1":municipio,"email1":email,"contrasena1":clave});
            //let envio = JSON.parse(data);
            let envio = JSON.stringify(persona);
            xhr.open('POST', 'http://localhost/APISICONPrueba/api/CreaPersona');
            xhr.send(envio);
            xhr.onload = function() {
            if (xhr.status == 201) {  
              alert("Se registro correctamente persona");
              window.location.reload();
            } else { 
               alert("Error al registrar persona");
              
            }
          };
     
         xhr.onerror = function() {
          alert("Solicitud fallida");
           };
        }
    });
}

  static CargaTipoDoc() {  
   // event.preventDefault();
    let xhr = new XMLHttpRequest();     
    xhr.open('GET', 'http://localhost/APISICONPrueba/api/ConsultaTipoDocumento');
    xhr.send();
    xhr.onload = function() {
       if (xhr.status == 200) {  
        var jsonResponse = JSON.parse(xhr.responseText);  
        var count = jsonResponse.data.length;
        $("#tipodoc").empty();
        $("#tipodoc").append("<option value=''>Seleccione tipo documento..</option>");
        for (var i = 0; i < count; i++) {
            $("#tipodoc").append("<option value=" + jsonResponse.data[i].id_tipo_doc + ">" + jsonResponse.data[i].descripcion + "</option>");
        }
       } else { 
          alert("Error al cargar tipo documento");
         $("#tipodoc").append("<option>No tipo documento</option>");
         $("#tipodoc").attr("disabled", true);
       }
     };

    xhr.onerror = function() {
     alert("Solicitud fallida");
      };   
    }   
    
    static CargaSexo() {  
      // event.preventDefault();
       let xhr = new XMLHttpRequest();     
       xhr.open('GET', 'http://localhost/APISICONPrueba/api/ConsultaSexo');
       xhr.send();
       xhr.onload = function() {
          if (xhr.status == 200) {  
           var jsonResponse = JSON.parse(xhr.responseText);  
           var count = jsonResponse.data.length;
           $("#sexo").empty();
           $("#sexo").append("<option value=''>Seleccione sexo..</option>");
           for (var i = 0; i < count; i++) {
               $("#sexo").append("<option value=" + jsonResponse.data[i].id_sexo + ">" + jsonResponse.data[i].descripcion + "</option>");
           }
          } else { 
             alert("Error al cargar tipo documento");
            $("#sexo").append("<option>No tipo documento</option>");
            $("#sexo").attr("disabled", true);
          }
        };
   
       xhr.onerror = function() {
        alert("Solicitud fallida");
         };   
       }
       
       static CargaDepartamento() {  
        // event.preventDefault();
         let xhr = new XMLHttpRequest();     
         xhr.open('GET', 'http://localhost/APISICONPrueba/api/ConsultaDepartamento');
         xhr.send();
         xhr.onload = function() {
            if (xhr.status == 200) {  
             var jsonResponse = JSON.parse(xhr.responseText);  
             var count = jsonResponse.data.length;
             $("#departamento").empty();
             $("#departamento").append("<option value=''>Seleccione departamento..</option>");
             for (var i = 0; i < count; i++) {
                 $("#departamento").append("<option value=" + jsonResponse.data[i].id_depart + ">" + jsonResponse.data[i].descripcion_depart + "</option>");
             }
            } else { 
               alert("Error al cargar tipo documento");
              $("#departamento").append("<option>No tipo documento</option>");
              $("#departamento").attr("disabled", true);
            }
          };
     
         xhr.onerror = function() {
          alert("Solicitud fallida");
           };   
         } 

         static CargaMunicipioPorIdDepart() {  
          let idDepart = $("#departamento").val();
          if(idDepart != ""){           
            // event.preventDefault();
           let xhr = new XMLHttpRequest();     
           xhr.open('GET', 'http://localhost/APISICONPrueba/api/ConsultaMunicipioPorIdDepart/'+ idDepart);
           xhr.send();
           xhr.onload = function() {
              if (xhr.status == 200) {  
                $("#municipio").attr("disabled", false);
               var jsonResponse = JSON.parse(xhr.responseText);  
               var count = jsonResponse.data.length;
               $("#municipio").empty();
               $("#municipio").append("<option value=''>Seleccione municipio..</option>");
               for (var i = 0; i < count; i++) {
                   $("#municipio").append("<option value=" + jsonResponse.data[i].id_muni + ">" + jsonResponse.data[i].descripcion_muni + "</option>");
               }
              } else { 
                 alert("Error al cargar tipo documento");
                $("#municipio").append("<option>No tipo documento</option>");
                $("#municipio").attr("disabled", true);
              }
            };
       
           xhr.onerror = function() {
            alert("Solicitud fallida");
             };   
           }else{
            $("#municipio").append("<option></option>");
            $("#municipio").attr("disabled", true);
           }

          }
          
}
