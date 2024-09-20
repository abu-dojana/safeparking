(function(){
  function initMap() {
    var image = 'data:image/png;base64,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';
    var center = {lat: 23.750, lng: 90.423};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: center,
    });
    const locations = [
      { lat: 23.747663, lng: 90.423433, name: "502-503/C,Khilgaon " },
      { lat: 23.750010, lng: 90.424109, name: "7/43A,Khilgaon" },
      { lat: 23.749686, lng: 90.421760, name: "#210,Road-6,Khilgaon" },
      { lat: 23.751051, lng: 90.422800, name: "17/4,Xian,Khilgaon" },
      { lat: 23.751601, lng: 90.424002, name: "North Square,Khilgaon" },
      { lat: 23.752200, lng: 90.418681, name: "F2 Convention Hall,Khilgaon" },
      { lat: 23.752907, lng: 90.420311, name: "Rangs Corner,Khilgaon" }
    ];
    locations.forEach(function(location) {
      var marker = new google.maps.Marker({
        position: { 
        lat: location.lat, lng: location.lng },
        map: map,
        title: location.name,
        icon:image
      });
      var infowindow = new google.maps.InfoWindow({
        content: `<div id="content">
                    <h1 id="firstHeading" class="firstHeading">${location.name}</h1>
                  </div>`
      });
      marker.addListener('click', function() {
        infowindow.open(map, marker);
      });
    });
  }
  window.addEventListener('load', initMap);
}).call(this);
