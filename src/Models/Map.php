<?php

namespace Chai17\Models;

class Map
{

    public function getMap($latitude, $longitude)
    {
        $this->mapDiv = "
            <div id='mapdiv'></div>
            <script src='http://www.openlayers.org/api/OpenLayers.js'></script>
            <script>
              map = new OpenLayers.Map('mapdiv');
              map.addLayer(new OpenLayers.Layer.OSM());

              var lonLat = new OpenLayers.LonLat( $longitude , $latitude )
                    .transform(
                      new OpenLayers.Projection('EPSG:4326'), // transform from WGS 1984
                      map.getProjectionObject() // to Spherical Mercator Projection
                    );

              var zoom=15;

              var markers = new OpenLayers.Layer.Markers( 'Markers' );
              map.addLayer(markers);

              markers.addMarker(new OpenLayers.Marker(lonLat));

              map.setCenter (lonLat, zoom);
            </script>
        ";

        return $this->mapDiv;
    }
}
