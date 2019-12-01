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
  </style>
  <style>
    
  </style>
  
  <link rel="stylesheet" href="maptalks.css">
  <link rel="stylesheet" type="text/css" href="pikaday.css">
  <script type="text/javascript" src="maptalks.min.js"></script>
  <script src="pikaday.js"></script>

  <script>
    // She's ugly, but, she'll do
    var currentlySelectedLocation = ""
    function send(){
      var date = document.getElementById("date").innerHTML;
      var time = document.getElementById("time").innerHTML;
      var room = document.getElementById("roomN").innerHTML;
      var pressure = document.getElementById("pressure").innerHTML;
      var humidity = document.getElementById("humidity").innerHTML;
      var light = document.getElementById("light").innerHTML;
      var classStatus = document.getElementById("classStatus").innerHTML;
      var profID = document.getElementById("profID").innerHTML;
      var enrollment = document.getElementById("enrollment").innerHTML;
      var transcriptionConfidence = document.getElementById("transcriptConfidence").innerHTML;
      var nSignIns = document.getElementById("nSignIn").innerHTML;
      var nScan = document.getElementById("nScan").innerHTML;
      var avgGpa = document.getElementById("gpa").innerHTML;
      
      var theData = [
        {
          "Date": date,
          "Time": time,
          "Room Number": room,
          "Pressure": pressure.replace("kPa" , ""),
          "Humidity": humidity.replace("%" , ""),
          "Light": light.replace("%" , ""),
          "Class": classStatus,
          "Professor": profID,
          "Enrolled Students": enrollment,
          "Lecture Vocal Clarity": transcriptionConfidence.replace("%" , ""),
          "Sign-ins": nSignIns.replace(" sign-ins" , ""),
          "Note Scans": nScan.replace(" scans" , ""),
          "Average GPA": avgGpa
        },
      ];
      //Exporting JSON to a file: https://stackoverflow.com/questions/33780271/export-a-json-object-to-a-text-file
	  // and here: https://www.codevoila.com/post/30/export-json-data-to-downloadable-file-using-javascript
      var jsonFile = date+"_"+time+"_"+room+".json";
      var str = JSON.stringify(theData);
      //Save the file contents as a DataURI
      var dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(str);
      var linkElement = document.createElement('a');
      linkElement.setAttribute('href', dataUri);
      linkElement.setAttribute('download', jsonFile);
      linkElement.click();
    
    }
  </script>

  <body>

    <nav class="floating-menu-topleft">
      <button type="button" class="collapsible" onclick="changeIcon()"><h3>Hello, Nada&nbsp;&nbsp;<span class="ti-arrow-circle-down" style="vertical-align: -1px" id="theIcon"></span></h3></button>
      <div class="content">
      <a href= ""><h5>Add/Remove Classes</h5></a>
      <a href=""><h5>Sign Out</h5></a>
      </div>
    </nav>

    <nav class="floating-menu-topRight">
        <button type="button" class="collapsible" onclick="changeIcon2()"><h3>X-ray&nbsp;&nbsp;<span class="ti-arrow-circle-down" style="vertical-align: -1px" id="theIcon2"></span></h3></button>
        <div class="content" id="dataTable"><h5>
        <!-- assign each variable value an id, then reference that id in the export form -->
        
      </h5>
    </div>
    </nav>

    <nav class="floating-menu-bottomRight">
        <h3>Time Machine</h3>
        
        <input type="text" id="datepicker" placeholder="MM/DD/YYYY" value="Thu Dec 05 2019" onchange='fetchData(document.getElementById("datepicker").value,document.getElementById("timepicker").options[document.getElementById("timepicker").selectedIndex].text,currentlySelectedLocation)'><br />
        <select id="timepicker" onchange='fetchData(document.getElementById("datepicker").value,document.getElementById("timepicker").options[document.getElementById("timepicker").selectedIndex].text,currentlySelectedLocation)'> <!-- Yo lol i gotta come up with a cleaner solution than this-->
          <option value="0000">7:00AM</option>
          <option value="0000">7:30AM</option>
          <option value="0000">8:00AM</option>
          <option value="0000">8:30AM</option>
          <option value="0000">9:00AM</option>
          <option value="0000">9:30AM</option>
          <option value="0000">10:00AM</option>
          <option value="0000">10:30AM</option>
          <option value="0000">11:00AM</option>
          <option value="0000">11:30AM</option>
          <option value="0000">12:00PM</option>
          <option value="0000">12:30PM</option>
          <option value="0000">1:00PM</option>
          <option value="0000">1:30PM</option>
          <option value="0000">2:00PM</option>
          <option value="0000">2:30PM</option>
          <option value="0000">3:00PM</option>
          <option value="0000">3:30PM</option>
          <option value="0000">4:00PM</option>
          <option value="0000">4:30PM</option>
          <option value="0000">5:00PM</option>
          <option value="0000">5:30PM</option>
          <option value="0000">6:00PM</option>
          <option value="0000">6:30PM</option>
          <option value="0000">7:00PM</option>
          <option value="0000">7:30PM</option>
          <option value="0000">8:00PM</option>
          <option value="0000">8:30PM</option>
          <option value="0000">9:00PM</option>
          <option value="0000">9:30PM</option>
          <option value="0000">10:00PM</option>
          <option value="0000">10:30PM</option>
          <option value="0000">11:00PM</option>
          <option value="0000">11:30PM</option>
        </select>
        
    </nav>

    <nav class="floating-menu-bottomLeft">
              
        <button type="button" onclick="window.open('test.php')"><span class="ti-user"></span></button>
        <br /><br />
        
        <button type="button" onclick="send()" download="example.json"><span class="ti-export"></span></button>

      
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
        function openXrayPanel() {
          document.getElementById("dataTable").style.display="block"
          document.getElementById("theIcon2").className = "ti-arrow-circle-up"
           
        }

        function parseTime(selectedTime) {
          if (selectedTime.includes(":")) 
          {
            selectedTime=selectedTime.replace(":","")
          }
          if (selectedTime.includes("AM")) 
          {
            selectedTime=selectedTime.replace("AM","")
            if (selectedTime.includes("1200"))
            selectedTime="0000"
            if (selectedTime.includes("1230"))
            selectedTime="0030"
            selectedTime=parseInt(selectedTime, 10)
          }
          else if (selectedTime.includes("PM")) 
          {
            selectedTime=selectedTime.replace("PM","")
            if (!selectedTime.includes("12"))
            selectedTime=parseInt(selectedTime, 10)+1200
            selectedTime=parseInt(selectedTime, 10)
          
          } 
          return selectedTime

        }

        function parseDayOfWeek(selectedDate) {
          switch (selectedDate.substring(0,3)) {
            case "Mon":
              return 1;
            case "Tue":
              return 2;
            case "Wed":
              return 3;
            case "Thu":
              return 4;
            case "Fri":
              return 5;
            default:
              return 0;
          }
        }

        function parseDate(selectedDate) { //Thu Aug 15 2019 -> 20190815
          switch (selectedDate.substring(4,7)) {
            case "Jan":
              return selectedDate.substring(11,15)+"01"+selectedDate.substring(8,10)
            case "Feb":
              return selectedDate.substring(11,15)+"02"+selectedDate.substring(8,10)
            case "Mar":
              return selectedDate.substring(11,15)+"03"+selectedDate.substring(8,10)
            case "Apr":
              return selectedDate.substring(11,15)+"04"+selectedDate.substring(8,10)
            case "May":
              return selectedDate.substring(11,15)+"05"+selectedDate.substring(8,10)
            case "Jun":
              return selectedDate.substring(11,15)+"06"+selectedDate.substring(8,10)
            case "Jul":
              return selectedDate.substring(11,15)+"07"+selectedDate.substring(8,10)
            case "Aug":
              return selectedDate.substring(11,15)+"08"+selectedDate.substring(8,10)
            case "Sep":
              return selectedDate.substring(11,15)+"09"+selectedDate.substring(8,10)
            case "Oct":
              return selectedDate.substring(11,15)+"10"+selectedDate.substring(8,10)
            case "Nov":
              return selectedDate.substring(11,15)+"11"+selectedDate.substring(8,10)
            case "Dec":
              return selectedDate.substring(11,15)+"12"+selectedDate.substring(8,10)
           
          }
        }

        function fetchData(date, time, roomN) { 
        if (currentlySelectedLocation != "")
        openXrayPanel()
        console.log(parseTime(time))
        
        
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dataTable").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajax.php?room="+roomN+"&day="+parseDayOfWeek(date)+"&time="+parseTime(time)+"&date="+date+"&humanTime="+time+"&parsedDate="+parseDate(date),true);
        xmlhttp.send();
        
        
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
        zoom: 18,
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
      $roomNameArray = array();

      while($row = mysqli_fetch_array($result)) {
        array_push($positionArray,$row['latLongList']);
        array_push($roomNameArray,$row['roomN']);
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


      var locationsDictionary = { 

        <?php 
        for ($i=0; $i<count($roomNameArray); $i++)
        {
          if ($i<count($roomNameArray)-1)
          {
            echo '"' . $roomNameArray[$i] . '": ' . substr($positionArray[$i], 1, -1) . ',';
          }
          else
          {
            echo '"' . $roomNameArray[$i] . '": ' . substr($positionArray[$i], 1, -1);
          }
        } 
         ?>

      }

      
      
      map.on('click', function (param) {
        for (x in locationsDictionary) {
          if (inside(param.coordinate.toFixed(5).toArray(), locationsDictionary[x]))
          {
            currentlySelectedLocation=x
            fetchData(document.getElementById('datepicker').value,document.getElementById("timepicker").options[document.getElementById("timepicker").selectedIndex].text,currentlySelectedLocation)
            

          }
        }
      });


      

      

      
    </script>

<script src="pikaday.js"></script>

</body>
</html>

