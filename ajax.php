<!DOCTYPE html>
<html>
  <head>
    <style>
      th {
        text-align: left;
        padding-left: 1%;
        padding-top: 1%;
        padding-bottom: 1%;
        }
        td {
        text-align: right;
        
        }
      </style>
  </head>
<body>


<?php 
        $room = $_GET['room'];
        $time = $_GET['humanTime'];
        $date = $_GET['date'];

        $lampDate = $_GET['parsedDate'];

        $computedDate = $_GET['day'];
        $computedTime = $_GET['time'];

        if (substr($computedTime,-2)=="00")
          $minus30MinTime = $computedTime - 70;
        else
          $minus30MinTime = $computedTime - 30;

        $plus15time=$computedTime + 15;

        $con = mysqli_connect('cs4750.cs.virginia.edu','rm4mp','Niw6ogha','rm4mp'); #secret!
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        
        mysqli_select_db($con,"rm4mp");

        


        $roomConditionSQL="SELECT * FROM RoomCondition WHERE roomN ='" . $room . "' AND date=" . $lampDate . " AND time=" . $computedTime ;
        $roomConditionResult = mysqli_query($con,$roomConditionSQL);
        

      

          $row = mysqli_fetch_array($roomConditionResult);
          
          

          $classroomSQL="SELECT * FROM `Class` LEFT JOIN `Teaches` ON Teaches.sectionID=Class.sectionID WHERE (startTime=" . $computedTime .  " OR startTime=" . $minus30MinTime . " OR endTime=" . $plus15time ." ) AND roomN='" . $room . "' AND day=" . $computedDate;
          $classroomResult = mysqli_query($con,$classroomSQL); 
          $row2 = mysqli_fetch_array($classroomResult);

          $enrolledStudentsSQL="SELECT COUNT(computingID) FROM `Takes` WHERE sectionID='";
          $enrolledStudentsSQL .= $row2['sectionID'] . "'";
          $enrolledStudentResult = mysqli_query($con,$enrolledStudentsSQL);

          $lampSQL="SELECT * FROM `Lamp` WHERE time=" . $computedTime ." AND roomN='" . $room . "' AND day=" . $computedDate . " AND date=" . $lampDate;
          $lampResult = mysqli_query($con,$lampSQL);
          $lamp = mysqli_fetch_array($lampResult);

          $numOfEnrolledStudents = mysqli_fetch_array($enrolledStudentResult)[0];

          $transcriptionConfidenceSQL="SELECT * FROM getTranscriptConfidence WHERE time=" . $computedTime ." AND roomN='" . $room . "' AND date=" . $lampDate;
          $transcriptionConfidenceResult = mysqli_query($con,$transcriptionConfidenceSQL);
          $transcriptionConfidence = mysqli_fetch_array($transcriptionConfidenceResult);
          
          if ($row['temperature']=="")
          $temperature="Unknown";
          else
          $temperature=$row['temperature'] . " F";

          if ($row['pressure']=="")
          $pressure="Unknown";
          else
          $pressure=$row['pressure'] . " kPa";

          if ($row['humidity']=="")
          $humidity="Unknown";
          else
          $humidity=$row['humidity'] . "%";

          if ($row['light']=="")
          $light="Unknown";
          else
          $light=$row['light'] . "%";

          if ($row2['className']=="")
          $className="None";
          else
          $className=$row2['className'];

          if ($room=="")
          $room="Select One";

          if ($row2['instructorID']=="")
          $instructorID="None";
          else
          $instructorID=$row2['instructorID'];

          if ($numOfEnrolledStudents==0)
          $numOfEnrolledStudents="None Found";

          if ($transcriptionConfidence['transcriptConfidence']=="")
          $vocalClarity="N/A";
          else
          $vocalClarity=$transcriptionConfidence['transcriptConfidence']."%";

          if ($lamp['nSignIn']=="")
          $lampSignIn="Unknown";
          else
          $lampSignIn=$lamp['nSignIn'] . " sign-ins";

          if ($lamp['nScan']=="")
          $lampScans="Unknown";
          else
          $lampScans=$lamp['nScan']. " scans";

          
          if ($row2['grade']=="" || $row2['grade']==0)
          $grade="Unknown";
          else
          $grade=$row2['grade'];


          echo "<table>";
          echo "<tr>";
          echo "<th>Date</th>";
          echo "<td id='date'>" . $date . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Time</th>";
          echo "<td id='time'>" . $time . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Room Name</th>";
          echo "<td id='roomN'>" . $room . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Temperature</th>";
          echo "<td id='temperature'>" . $temperature . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Pressure</th>";
          echo "<td id='pressure'>" . $pressure . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Humidity</th>";
          echo "<td id='humidity'>" . $humidity . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Light</th>";
          echo "<td id='light'>" . $light . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Class</th>";
          echo "<td id='classStatus'>". $className . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Professor</th>";
          echo "<td id='profID'>". $instructorID ." </td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Enrolled Students</th>";
          echo "<td id='enrollment'>" .  $numOfEnrolledStudents . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Lecture Clarity</th>";
          echo "<td id='transcriptConfidence'>" . $vocalClarity . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Sign-ins</th>";
          echo "<td id='nSignIn'>" . $lampSignIn . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Note Scans</th>";
          echo "<td id='nScan'>" . $lampScans . "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<th>Average GPA</th>";
          echo "<td id='gpa'>" .  $grade . "</td>";
          echo "</tr>";
          echo "</table>";

        





      mysqli_close($con);
      ?>

</body>
</html>