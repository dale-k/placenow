
$(document).ready(function(){
  getUserCity('login');
});

function htmlCityOutput(results,type){

  
  var form = document.getElementById('login_form');

  var cityInput = document.getElementById('city');
  cityInput.setAttribute('value', UserInfo.city);
  form.appendChild(cityInput);

  var latInput = document.getElementById('lat');
  latInput.setAttribute('value', UserInfo.lat);
  form.appendChild(latInput);

  var lngInput = document.getElementById('lng');
  lngInput.setAttribute('value', UserInfo.lng);
  form.appendChild(lngInput);
}



function storeSessionOutput(){

 var lat = SessionRetrive('login_lat');
 var lng = SessionRetrive('login_lng');
 var city = SessionRetrive('login_city');

  var form = document.getElementById('login_form');

  var cityInput = document.createElement('input');
  cityInput.setAttribute('type', 'hidden');
  cityInput.setAttribute("name", 'city');
  cityInput.setAttribute('value', city);
  form.appendChild(cityInput);

  var latInput = document.createElement('input');
  latInput.setAttribute('type', 'hidden');
  latInput.setAttribute("name", 'lat');
  latInput.setAttribute('value', lat);
  form.appendChild(latInput);

  var lngInput = document.createElement('input');
  lngInput.setAttribute('type', 'hidden');
  lngInput.setAttribute("name", 'lng');
  lngInput.setAttribute('value', lng);
  form.appendChild(lngInput);

}