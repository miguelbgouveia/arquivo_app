

  var destinatario;
  var departamento;
  var utilizador;
  var data;
  var tipo_doc;
  var assunto;

  $('.modelInser').on('click', function(event) {
    departamento=document.getElementById('depart').value;
    destinatario=document.getElementById('dest').value;
    utilizador=document.getElementById('utilizador').value;
    data=document.getElementById('date').value;
    tipo_doc=document.getElementById('type_doc').value;
    assunto=document.getElementById('assunto').value;
    var file=something;
    if(data==null){
      console.log('nada');
    } else{
      console.log('funcionou');
    }
  });

  $('.modelVer').on('click', function(event) {
     event.preventDefault();
     var destinatario;
     var departamento;
     var utilizador;
     var data;
     var tipo_doc;
     var assunto;

 });
 $('.modelEdit').on('click', function(event) {
      event.preventDefault();
  });
