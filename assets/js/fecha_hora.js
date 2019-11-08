function startTime(){
    var datosActuales = new Date();
    var horas = datosActuales.getHours();
    var minutos = datosActuales.getMinutes();
    var segundos = datosActuales.getSeconds();
        minutos = checkTime(minutos);
        segundos = checkTime(segundos);
    var dia = datosActuales.getDate();
    var mes = datosActuales.getMonth();
    var anio = datosActuales.getFullYear();
    
    var am_pm = (datosActuales.getHours() < 12) ? "AM" : "PM";
    

    document.getElementById('fecha').innerHTML = "Fecha: " + dia + "/" + mes + "/" + anio;
    document.getElementById('hora').innerHTML =  " Hora: " + horas + ":" + minutos + ":" +segundos + " " + am_pm + "";
    tiempo = setTimeout('startTime()',500);}
    
    function checkTime(i){
        if (i<10) {i="0" + i;}
        return i;
    }

    window.onload=function(){startTime();
}

/*
var amOrPm = (d.getHours() < 12) ? "AM" : "PM";
var hour = (d.getHours() < 12) ? d.getHours() : d.getHours() - 12;
return   d.getDate() + ' / ' + d.getMonth() + ' / ' + d.getFullYear() + ' ' + hour + ':' + d.getMinutes() + ' ' + amOrPm;
*/
