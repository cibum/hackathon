function setPoints(points){
    $('#map').gmap3(
	{ action: 'addMarkers',
	  markers: points, 
	  marker:{
	      options:{
		  draggable: false,
		  icon: new google.maps.MarkerImage("../img/marker.png")
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

    // Updates points and marks district
    var sel = $("#filter_distrito option:selected").text();
    updateParams(sel.toLowerCase());

    // updates points display
    function updateParams(val){
	var address_lima = val + ", Lima, Peru";

	var ftLM = 5286944;
	var cond = "NOMBDIST = '" + val.toUpperCase() + "'";
	var dstLayer = new google.maps.FusionTablesLayer({
	    query: {
		select: 'geometry',
		from: ftLM,
		where: cond
	    },
	    styles: [
		{
		    polygonOptions: {
			fillColor: "#ccff00"
		    }
		}
	    ]
	});


	$('#map').gmap3(
	    {
		action:'getLatLng',
		address: address_lima,
		callback: function(result){
		    if(result){
			$(this).gmap3({
			    action: 'setCenter',
			    zoom: 18,
			    args: [ result[0].geometry.location ]
			});
			dstLayer.setMap($(this).gmap3('get'));
		    }
		}
	    }
	);

    }


});

