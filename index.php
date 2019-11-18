<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Living Classrooms</title>
  <link rel="stylesheet" href="themify-icons.css">
  <link rel="stylesheet" href="stylesheet.css">
  <style type="text/css">
    html,body{margin:0px;height:100%;width:100%;font-family: 'Source Sans Pro', sans serif;}
    .container{width:100%;height:100%}
    #info{position:fixed;background-color:rgba(13, 13, 13, 0.5);padding:10px 10px 10px 10px;font:13px bold sans-serif;color:#fff;left:0px;top:0px;width:100%;height:140px;overflow:hidden}
  </style>
  <style>
    
  </style>
  
  <link rel="stylesheet" href="maptalks.css">
  <link rel="stylesheet" type="text/css" href="pikaday.css">
  <script type="text/javascript" src="maptalks.min.js"></script>
  <script src="pikaday.js"></script>


  <body>

    <nav class="floating-menu-topleft">
      <button type="button" class="collapsible" onclick="changeIcon()"><h3>Hello, Nada&nbsp;&nbsp;<span class="ti-arrow-circle-down" style="vertical-align: -1px" id="theIcon"></span></h3></button>
      <div class="content">
      <a href= ""><h5>Add/Remove Classes</h5></a>
      <a href=""><h5>Sign Out</h5></a>
      </div>
    </nav>

    <nav class="floating-menu-topRight">
        <button type="button" class="collapsible" onclick="changeIcon2()"><h3>Ambient Room Conditions&nbsp;&nbsp;<span class="ti-arrow-circle-down" style="vertical-align: -1px" id="theIcon2"></span></h3></button>
        <div class="content"><h5>
        <table>
          <tr>
          <th>Room Name</th>
          <td>Rice 130</td>
          </tr>
          <tr>
          <th>Temperature</th>
          <td>73 F</td>
          </tr>
          <tr>
          <th>Pressure</th>
          <td>780 kPa</td>
          </tr>
          <tr>
          <th>Humidity</th>
          <td>54%</td>
          </tr>
          <tr>
          <th>Light</th>
          <td>100</td>
          </tr>
          <tr>
          <th>Class Present?</th>
          <td>Yes</td>
          </tr>
          <tr>
          <th>Lecture Vocal Clarity&nbsp;&nbsp;</th>
          <td>87%</td>
          </tr>
          <tr>
          <th>Sign-ins</th>
          <td>89</td>
          </tr>
          <tr>
          <th>Note Scans</th>
          <td>248</td>
          </tr>
        </table>
      </h5>
    </div>
    </nav>

    <nav class="floating-menu-bottomRight">
        <button type="button" class="collapsible" onclick="changeIcon3()"><h3>Time Travel&nbsp;&nbsp;<span class="ti-arrow-circle-down" style="vertical-align: -1px" id="theIcon3"></span></h3></button>
        <div class="content">
        <input type="text" id="datepicker" placeholder="MM/DD/YYYY"><br />
        <select> <!-- Yo lol i gotta come up with a cleaner solution than this-->
          <option value="0000">12AM</option>
          <option value="0000">12:30AM</option>
          <option value="0000">1AM</option>
          <option value="0000">12AM</option>
          <option value="0000">2AM</option>
          <option value="0000">2:30AM</option>
          <option value="0000">3AM</option>
          <option value="0000">3:30AM</option>
          <option value="0000">4AM</option>
          <option value="0000">4:30AM</option>
          <option value="0000">5AM</option>
          <option value="0000">5:30AM</option>
          <option value="0000">6AM</option>
          <option value="0000">6:30AM</option>
          <option value="0000">7AM</option>
          <option value="0000">7:30AM</option>
          <option value="0000">8AM</option>
          <option value="0000">8:30AM</option>
          <option value="0000">9AM</option>
          <option value="0000">9:30AM</option>
          <option value="0000">10AM</option>
          <option value="0000">10:30AM</option>
          <option value="0000">11AM</option>
          <option value="0000">11:30AM</option>
          <option value="0000">12PM</option>
          <option value="0000">12:30PM</option>
          <option value="0000">1PM</option>
          <option value="0000">1:30PM</option>
          <option value="0000">2PM</option>
          <option value="0000">2:30PM</option>
          <option value="0000">3PM</option>
          <option value="0000">3:30PM</option>
          <option value="0000">4PM</option>
          <option value="0000">4:30PM</option>
          <option value="0000">5PM</option>
          <option value="0000">5:30PM</option>
          <option value="0000">6PM</option>
          <option value="0000">6:30PM</option>
          <option value="0000">7PM</option>
          <option value="0000">7:30PM</option>
          <option value="0000">8PM</option>
          <option value="0000">8:30PM</option>
          <option value="0000">9PM</option>
          <option value="0000">9:30PM</option>
          <option value="0000">10PM</option>
          <option value="0000">10:30PM</option>
          <option value="0000">11PM</option>
          <option value="0000">11:30PM</option>
        </select>
      </div>
    </nav>

    <nav class="floating-menu-bottomLeft">
        <h3><span class="ti-layers-alt" title="3D mode"></span>
        <br /><br />
        <span class="ti-user" title="Student Heatmap"></span>
        <br /><br />
        <span class="ti-export" title="Student Heatmap"></span>
      </h3>
    </nav>



    <div id="map" class="container"></div>
      
    <script>
        function changeIcon() {
          if (document.getElementById("theIcon").className == "ti-arrow-circle-up")
          {
            document.getElementById("theIcon").className = "ti-arrow-circle-down";
          }
          else{
            document.getElementById("theIcon").className = "ti-arrow-circle-up";
          }
        }
        function changeIcon2() {
          if (document.getElementById("theIcon2").className == "ti-arrow-circle-up")
          {
            document.getElementById("theIcon2").className = "ti-arrow-circle-down";
          }
          else{
            document.getElementById("theIcon2").className = "ti-arrow-circle-up";
          }
        
        }
        function changeIcon3() {
          if (document.getElementById("theIcon3").className == "ti-arrow-circle-up")
          {
            document.getElementById("theIcon3").className = "ti-arrow-circle-down";
          }
          else{
            document.getElementById("theIcon3").className = "ti-arrow-circle-up";
          }
        
        }
        var coll = document.getElementsByClassName("collapsible");
        var i;
        
        for (i = 0; i < coll.length; i++) {
          coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
              content.style.display = "none";
            } else {
              content.style.display = "block";
            }
          });
        }

        var picker = new Pikaday({ field: document.getElementById('datepicker') });
        </script>
        
        
    <script>
      var map = new maptalks.Map('map', {
        center: [-78.51047,38.03289],
        zoom: 19,
        baseLayer: new maptalks.TileLayer('base', {
          urlTemplate: 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png',
          subdomains: ['a','b','c','d'],
          attribution: ''
        })
      });
      
      <?php
      $con = mysqli_connect('cs4750.cs.virginia.edu','rm4mp','Niw6ogha','rm4mp');
      if (!$con) {
          die('Could not connect: ' . mysqli_error($con));
      }

      mysqli_select_db($con,"rm4mp");
      $sql="SELECT * FROM BuildingLocations";
      $result = mysqli_query($con,$sql);
      
      $positionArray = array();

      while($row = mysqli_fetch_array($result)) {
        array_push($positionArray,$row['latLongList']);
    }
      ?>


      var multiPolygon = new maptalks.MultiPolygon(
        [

        <?php 
        for ($i=0; $i<count($positionArray); $i++)
        {
          if ($i<count($positionArray)-1)
          {
            echo $positionArray[$i] . ",";
          }
          else
          {
            echo $positionArray[$i];
          }
        } ?>,
        ], {
        visible : true,
        editable : true,
        cursor : null,
        shadowBlur : 0,
        draggable : false,
        dragShadow : false, // display a shadow during dragging
        drawOnAxis : null,  // force dragging stick on a axis, can be: x, y
        symbol: {
          'lineColor' : '',
          'lineWidth' : 0,
          'polygonFill' : 'rgb(255,80,31)',
          'polygonOpacity' : 0.5
        }
      });

      new maptalks.VectorLayer('vector', multiPolygon).addTo(map);


      function inside(point, vs) {
          // ray-casting algorithm based on
          // http://www.ecse.rpi.edu/Homepages/wrf/Research/Short_Notes/pnpoly.html

          var x = point[0], y = point[1];

          var inside = false;
          for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
              var xi = vs[i][0], yi = vs[i][1];
              var xj = vs[j][0], yj = vs[j][1];

              var intersect = ((yi > y) != (yj > y))
                  && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
              if (intersect) inside = !inside;
          }

          return inside;
      };

      var polygon = [[-78.51081,38.03216], [-78.51061,38.03211], [-78.51059,38.03217], [-78.51077,38.03223] ];

      var locationsDictionary = { //needs to be pulled from PHP dynamically
          "Olsson120": [[-78.51081,38.03216], [-78.51061,38.03211], [-78.51059,38.03217], [-78.51077,38.03223]],
          "Rice Hall 130":  [[-78.51042,38.03171], [-78.51044,38.03167], [-78.5107,38.03175], [-78.51067,38.0318]] ,
          "Thornton Hall E316":  [[-78.5097,38.03253], [-78.50972,38.03248], [-78.50989,38.03253], [-78.50986,38.03258]] ,
          "Mechanical Engr Bldg 205":  [[-78.51108,38.03275], [-78.51114,38.03263], [-78.51124,38.03267], [-78.51119,38.03277]] ,
          "Chemistry Bldg 402":  [[-78.51177,38.03365], [-78.51159,38.03359], [-78.51151,38.03371], [-78.5117,38.03378]] 
      }
      
      map.on('click', function (param) {
        for (x in locationsDictionary) {
          if (inside(param.coordinate.toFixed(5).toArray(), locationsDictionary[x]))
          {
            console.log(x)
          }
        }
      });

      

      

      <?php
      mysqli_close($con);
      ?>

    </script>

<script src="pikaday.js"></script>

</body>
</html>

