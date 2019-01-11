import InfoBox from './map/infobox';
import {styles as StyleMap} from './map/style';

export default function contactsMap() {

  let MarkerWithLabel = require('./map/markerwithlabel.js')(google.maps);
  let newMarkers = [];
  let {zoom, placemarks} = initConfig;

  let mapProp = {
    center: new google.maps.LatLng(placemarks[0].lat, placemarks[0].lng),
    zoom: zoom,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    styles: StyleMap,
    scrollwheel: false,
  };

  let map = new google.maps.Map(document.getElementById('map'), mapProp);

  for (var i = 1; i <= placemarks.length; i++) {

    var data = placemarks[i - 1];
    var myLatlng = new google.maps.LatLng(data.lat, data.lng);

    var block = `<div><img src="${data.icon}" alt=""></div>`;

    var marker = new MarkerWithLabel({
      position: myLatlng,
      map: map,
      title: data.title,
      icon: ' ',
      labelContent: block,
      labelAnchor: new google.maps.Point(28, 63),
      labelClass: 'marker-title',
      labelInBackground: false
    });

    newMarkers.push(marker);

    (function(marker, data) {

      var div = `<div class="locationBox">
              <div style="background-image: url('${data.infoBox.img}')" class="locationBox__photo"></div>
              <div class="locationBox__body">
                <div class="locationBox__title">${data.infoBox.title}</div>
                <div class="locationBox__text">${data.infoBox.text}</div>
              </div>
            </div>`;

      var myOptions = {
        content: div,
        disableAutoPan: false,
        maxWidth: 0,
        pixelOffset: new google.maps.Size(80, -90),
        zIndex: null,
        boxStyle: {
          background: '',
          width: '25rem'
        },
        closeBoxMargin: '10px 10px 2px 2px',
        closeBoxURL: '',
        infoBoxClearance: new google.maps.Size(1, 1),
        isHidden: false,
        pane: 'floatPane',
        enableEventPropagation: false
      };

      marker.infobox = new InfoBox(myOptions);

      google.maps.event.addListener(marker, 'click', function() {

      	if ($(window).width() > 900) {
          var curMarker = this;
          marker.infobox.open(map, marker);
          marker.set('labelClass', 'marker-title active');

          $.each(newMarkers, function(index, marker) {

            if (marker !== curMarker) {
              marker.infobox.close();
              marker.set('labelClass', 'marker-title');
            }
          });

          var latUrl = parseFloat(marker.position.toUrlValue().split(',', 2)[0]);
          var lngUrl = parseFloat(marker.position.toUrlValue().split(',', 2)[1]);

          map.panTo({lat: latUrl, lng: lngUrl});
        }

      });

    })(marker, data);

    var bounds = new google.maps.LatLngBounds();
    for (var i = 0; i < newMarkers.length; i++) {
      bounds.extend(newMarkers[i].getPosition());
    }

    map.fitBounds(bounds);

    $(window).on('resize', function() {
      google.maps.event.trigger(map, 'resize');
      map.fitBounds(bounds);
    });

  }
};
