/*Para geolocalizaciòn*/
    function localize()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(mapa,error);
        }
        else
        {
            alert('Tu navegador no soporta geolocalizacion.');
        }
    }
    
    
    function mapa(pos)
    {
        var latitud = pos.coords.latitude;
        var longitud = pos.coords.longitude;
        var precision = pos.coords.accuracy;
    
        var concadena = latitud + "," + longitud;
        $('#txtcoordenadas').val(concadena);
    }
    
    function error(errorCode)
    {
        if(errorCode.code == 1)
            alert("No has permitido buscar tu localizacion")
        else if (errorCode.code==2)
            alert("Posicion no disponible")
        else
            alert("Ha ocurrido un error")
    }
/**/



