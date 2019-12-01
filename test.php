
<!DOCTYPE html>
<html>
<head>
  <title>Student Heatmap</title>
  <link type="text/css" rel="stylesheet" href="maptalks.css">
  <script type="text/javascript" src="maptalks.min.js"></script>
  <script type="text/javascript" src="maptalks.heatmap.js"></script>

  <style>
    html,body{
        margin:0px;
        height:100%;
        width: 100%;
    }
    #map { width: 100%; height: 100%; }
  </style>
</head>
<body>
<div id="map"></div>
<script>

var map = new maptalks.Map("map",{
    center : [-78.51047,38.03289],
    zoom   :  18,
    
    baseLayer : new maptalks.TileLayer('tile',{
        urlTemplate: 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png',
        subdomains: ['a','b','c','d']
    })
});

<?php
      $con = mysqli_connect('cs4750.cs.virginia.edu','rm4mp','Niw6ogha','rm4mp');
      if (!$con) {
          die('Could not connect: ' . mysqli_error($con));
      }

      mysqli_select_db($con,"rm4mp");
      $sql="SELECT * FROM Takes NATURAL JOIN Class NATURAL JOIN BuildingLocations";
      $result = mysqli_query($con,$sql);
      
      $positionArray = array();
      $roomNameArray = array();

      while($row = mysqli_fetch_array($result)) {
        array_push($positionArray,$row['latLongList']);
    }
      ?>

var addressPoints = [
  <?php 
        
        for ($i=0; $i<count($positionArray); $i++)
        {
          if ($i<count($positionArray)-1)
          {
            $endPos = strpos($positionArray[$i],']');
            echo substr($positionArray[$i], 2, $endPos-2) . ",''],";
          }
          else
          {
            $endPos = strpos($positionArray[$i],']');
            echo substr($positionArray[$i], 2, $endPos-2) . ",'']";
          }
        } ?>
];

var data = addressPoints.map(function (p) { return [p[0], p[1]]; });
var heatlayer = new maptalks.HeatLayer('heat', data, {
    'heatValueScale': 0.3,
    'forceRenderOnRotating' : true,
    'forceRenderOnMoving' : true
}).addTo(map);

</script>
</body>
</html>