<?php

include('dbConnection.php');
?>
<html>

<head>
    <script>
    </script>
</head>

<body>
    <div>
        <h2>DETAILS OF STUDENTS</h2>

        <!-- if any one wants to add new employee please click here new below button -->
        <a href="addStudent.php">
            <h3></h3> + ADD NEW STUDENTS</h3>
        </a><BR>

        <!-- fetch all record from database and display here -->
        <?php

        include("dbConnection.php");

        $getAllEmployees = "select * from students";

        if ($result = mysqli_query($connection, $getAllEmployees)) {
            if (mysqli_num_rows($result) > 0) {

                echo "<table border='1' id='table_resultados'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>FIRST NAME</th>";
                echo "<th>LAST NAME</th>";
                echo "<th>GENDER</th>";
                echo "<th>HOBBIES</th>";
                echo "<th>BIRTH DATE</th>";
                echo "<th class='totalMarks'>TOTAL MARK</th>";
                echo "<th class='percentage'>PERCENTAGE</th>";
                echo "<th>RANK</th>";


                echo "</tr>";

                while ($row = mysqli_fetch_array($result)) {

                    $total = 0;
                    $sub1 = $row['subject1'];
                  
                    $sub2 = $row['subject2'];
                  
                    $sub3 = $row['subject3'];
                  
                    $sub4 = $row['subject4'];
                  
                    $sub5 = $row['subject5'];
                  
                    $total += $sub1 + $sub2 + $sub3 + $sub4 + $sub5;
                    $percentage = $total / 5;




                    echo "<tr class='calculate'>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['hobbies'] . "</td>";
                    echo "<td>" . $row['birth_date'] . "</td>";
                    echo "<td>" . $total . "</td>";
                    echo "<td>" . $percentage . "</td>";
                    echo "<td></td>";
                    echo "</tr>";
                }

                echo "</table>";

                mysqli_free_result($result);
            } else {
                echo "no record found";
            }
        } else {
            echo "spmething went wrong please try again";
        }

        mysqli_close($connection);

        ?>
    </div>
</body>
<script>

</script>

</html>