function setPoints(points){
    $('#map').gmap3(
	{ action: 'addMarkers',
	  markers: points, 
	  marker:{
	      options:{
		  draggable: false
	      },
	      events:{
		  click: function(marker, event, data){
		      var map = $(this).gmap3('get'),
		      infowindow = $(this).gmap3({action:'get', name:'infowindow'});
		      if (infowindow){
			  infowindow.open(map, marker);
			  infowindow.setContent(data);
		      } else {
			  $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
		      }
		  }
	      }
	  }
	}
    )
};


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

