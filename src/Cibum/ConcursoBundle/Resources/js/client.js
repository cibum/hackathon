var points;

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
        },
	{ action: 'addMarkers',
	  markers:[ points ]
	}
    );

    $('#filter_distrito').change(function(){
	var sel = $("#filter_distrito option:selected").text();
	updateParams(sel.toLowerCase());
    });


    function updateParams(val){
	var address_lima = val + ", Lima, Peru";
	$('#map').gmap3(
	    {
		action:'getLatLng',
		address: address_lima,
		callback: function(result){
		    if(result){
			$(this).gmap3({
			    action: 'setCenter',
			    zoom: 17,
			    args: [ result[0].geometry.location ]
			});
		    } else {
			alert('foo');
		    }
		}
	    }
	);

    }


});

