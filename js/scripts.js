$(document).ready(function(){
  	ajaxForm('searchForm');
});
function ajaxForm (formId) { 
	$('#'+formId).submit(function(e) {
	    var url = $('#'+formId).attr('action'); 

	    $.ajax({
	           type: "POST",
	           url: url,
	           data: $('#'+formId).serialize(), 
	           success: function(data)
	           {
	                response = JSON.parse(data);
	               
	                if(response.success == true) {
		                var contentString = '<div id="content" class="marker">'+response.INFO+'</div>';
					    var infowindow = new google.maps.InfoWindow({
						    content: contentString
						});
		                var marker = new google.maps.Marker({
						    position: {lat: response.GEO.lat, lng:response.GEO.lng},
						    map: map,
						    icon: '/img/caution.png',
						    title: 'Airport'
						  });

						google.maps.event.addListener(marker, 'click', function() {
					        infowindow.open(map,marker);
					    });
					} else {
						alert(response.msg);
					}
	           }
	         });
	    e.preventDefault(); 
	});
}

function initMap() {
    var mapDiv = document.getElementById('map');

    map = new google.maps.Map(mapDiv, {
        center: {lat: 51.8747222222222, lng:-0.368333333333333},
        zoom: 2
    });
    image = {
	    url: '/img/warning-icon-th.png',
	    // This marker is 20 pixels wide by 32 pixels high.
	    size: new google.maps.Size(20, 64),
	    // The origin for this image is (0, 0).
	    origin: new google.maps.Point(0, 0),
	    // The anchor for this image is the base of the flagpole at (0, 32).
	    anchor: new google.maps.Point(0, 32)
	};
}
<!-- Size: 140 px -- >





