<?php
//include database configuration file
include 'dbConnection.php';

//get records from database
$query = "SELECT * FROM students ORDER BY id DESC";
if ($result = mysqli_query($connection, $query)) {
    if (mysqli_num_rows($result) > 0) {

    $delimiter = ",";
    $filename = "student1" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ID', 'Name', 'BirthDate', 'Gender');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
       
        $lineData = array($row['id'], $row['first_name'], $row['gender'], $row['birth_date'], $row['last_name']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
}
//Form submit based on click submit button
        //   $(".submit").click(function() {
        //     var first_name = $("#first_name").val();
        //     var last_name = $("#last_name").val();
        //     var gender = $("#gender").val();


        //     var birth_date = $("#birth_date").val();
        //     var subject1 = $("#subject1").val();
        //     var subject2 = $("#subject2").val();
        //     var subject3 = $("#subject3").val();
        //     var subject4 = $("#subject4").val();
        //     var subject5 = $("#subject5").val();
        //     var dataString = 'first_name=' + first_name + '&last_name=' + last_name + '&gender=' + gender + '&birth_date=' + birth_date + '&birth_date=' + birth_date;
        //     if (first_name == '' || last_name == '' || gender == '' || birth_date == '' || subject1 == '' || subject2 == '' || subject3 == '' || subject4 == '' || subject5 == '') {
        //       alert("Please Fill All Fields");
        //     } else {
        //       // AJAX Code To Submit Form.
        //       $.ajax({
        //         type: "POST",
        //         url: "ajaxsubmit.php",
        //         data: dataString,
        //         cache: false,
        //         success: function(result) {
        //           alert(result);
        //         }
        //       });
        //     }
        //     return false;
        //   });
        // });