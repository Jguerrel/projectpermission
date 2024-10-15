function ippaddres(e,url2)
{
    let token = '@csrf';
var sucursal = e.params.data;
//   Limpiar las opciones del segundo select
  var direccionip = document.getElementById('direccionip');
  direccionip.innerHTML = '<option value="">Selecciona un IP</option>';
  // Obtener los ip de la categoría seleccionada
  if (sucursal.id) {
    var id=sucursal.id;
    token = token.substr(42, 40);
    alert(url2);
    $.ajax({
    url: url2,
    type: 'POST',
    dataType: "json",
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {id: id},
    success: function (response) {
        for (var clave in response) {
        if (response.hasOwnProperty(clave)) {
                 var option = document.createElement('option');
                  option.value = response[clave].id;
                  option.textContent = response[clave].ip;
                  direccionip.appendChild(option);
        }}
      },
         error : function(xhr, textStatus, errorThrown){
                console.log('error'+JSON.stringify(xhr))
        }
   });
  }
}

/* llama proceso que cambia modelo al cambiar marca*/
function modelos(e,url2)
{

let token = '@csrf';
var marca = e.params.data;
//   Limpiar las opciones del segundo select
  var modelo_id = document.getElementById('carmodel');

  modelo_id.innerHTML = '<option value="">Seleccione un modelo</option>';
  // Obtener los ip de la categoría seleccionada
  if (marca.id) {
    var id=marca.id;
    token = token.substr(42, 40);
    $.ajax({
    url: url2,
    type: 'POST',
    dataType: "json",
    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {id: id},
    success: function (response) {
        for (var clave in response) {
        if (response.hasOwnProperty(clave)) {
                 var option = document.createElement('option');
                  option.value = response[clave].id;
                  option.textContent = response[clave].name;
                  modelo_id.appendChild(option);

        }}
      },
         error : function(xhr, textStatus, errorThrown){
                console.log('error'+JSON.stringify(xhr))
        }
   });
  }
}
