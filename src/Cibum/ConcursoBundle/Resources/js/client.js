$(function () {
    $('#map').gmap3(
        { action:'init',
            options:{
                center:[-12.047816, -77.062203],
                zoom:12,
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		mapTypeControl: false,
		navigationControl: false,
		streetViewControl: false
            }
        }
    );
});
