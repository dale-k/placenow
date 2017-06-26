function SessionStore(key,item){

if (typeof(Storage) !== "undefined") {
    // Code for localStorage/sessionStorage.
    localStorage.setItem(key, item);
} else {
    // Sorry! No Web Storage support..
}

}


function SessionRetrive(key){

if (typeof(Storage) !== "undefined") {
    // Code for localStorage/sessionStorage.
    return localStorage.getItem(key);

} else {
    // Sorry! No Web Storage support..
}


}


function ReloadGeolocation(key_lat,key_lng,key_city,newlat,newlng,dis_toreload){
	var lat1 = SessionRetrive(key_lat);
	var lng1 = SessionRetrive(key_lng);
  var city = SessionRetrive(key_city);
	if(lat1==null || lng1==null) return true;

  if(city==null) return true;

	var distance = PPdistance(lng1,lat1,newlng,newlat);

	if(distance>dis_toreload) return true;

	else return false;
}


// find distance between 2 GPS point
function PPdistance(lon1, lat1, lon2, lat2) {
  var R = 6371; // Radius of the earth in km
  var dLat = toRad(lat2-lat1);  // Javascript functions in radians
  var dLon = toRad(lon2-lon1);
   
  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * 
          Math.sin(dLon/2) * Math.sin(dLon/2);
   
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a))*1000;
   
  var d = R * c; // Distance in m
  
  return d;
}
function toRad(value){
	return value * Math.PI / 180;
}
/** Converts numeric degrees to radians */
if (typeof(Number.prototype.toRad) === "undefined") {
  Number.prototype.toRad = function() {
    return this * Math.PI / 180;
  }
}
