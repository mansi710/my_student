<?php

include('dbConnection.php');
?>
<html>
<title>Student Data</title>
<script src="js/validation.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<!-- <link rel="stylesheet" href="css/style.css"> -->
</head>

<body>
  <h1>Student Details</h1>
  <!-- when click on submit at that time form submitted -->
  <form method="post" id="ajax-form" name="ajax-form">
    <div>
      <lable>First Name:-</lable>
      <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" />
    </div>
    <br />
    <div>
      <lable>Last Name:-</lable>
      <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" />
    </div>
    <br />
    <div>
      <lable>Gender:-</lable>
      <input type="radio" name="gender" id="gender" value="F" />
      <lable>Female</lable>
      <input type="radio" name="gender" id="gender" value="M" />
      <lable class="gender">Male</lable>
      <span id="radioMsg"></span>
    </div>
    <br />
    <div>
      <lable>Hobbies:-</lable>
      <input type="checkbox" name="hobbies[]" id="hobbies" value="Reading" />
      <lable>Reading</lable>
      <input type="checkbox" name="hobbies[]" id="hobbies" value="Writing" />
      <lable>Writing</lable>
      <input type="checkbox" name="hobbies[]" id="hobbies" value="Travelling" />
      <lable class="hobbie">Travelling</lable>
      <span id="CheckBoxMsg"></span>
    </div>
    <br />
    <div>
      <label>Enter Birthdate</label>
      <input type="date" name="birth_date" id="birth_date" />
    </div>
    <br />

    <div>
      <label>Enter Subject 1 marks</label>
      <input type="text" name="subject1" id="subject1" placeholder="Enter Subject 1 Mark" class="marks" />
    </div>
    <br />
    <div>
      <label>Enter Subject 2 marks</label>
      <input type="text" name="subject2" id="subject2" placeholder="Enter Subject 2 Mark" class="marks" />
    </div>
    <br />
    <div>
      <label>Enter Subject 3 marks</label>
      <input type="text" name="subject3" id="subject3" placeholder="Enter Subject 3 Mark" class="marks" />
    </div>
    <br />
    <div>
      <label>Enter Subject 4 marks</label>
      <input type="text" name="subject4" id="subject4" placeholder="Enter Subject 4 Mark" class="marks" />
    </div>
    <br />
    <div>
      <label>Enter Subject 5 marks</label>
      <input type="text" name="subject5" id="subject5" placeholder="Enter Subject 5 Mark" class="marks" />
    </div>
    <br />
    <div>
      <input type="submit" name="submit" value="submit" class="btn submit" id="loadData">
      <input type="reset" name="reset" value="reset" class="btn" id="resetData" />
      <a href="ExportCSV.php" class="btn btn-success pull-right">Export Users</a>
    </div>
    <div id=" summatino">
      <label>Total Of All Subject</label>
      <span id="sum">0</span>
      <br>
      <label>Percentage</label>
      <span id="per">0</span>
      <br>
      <label>Rank</label>
      <span id="rank">0</span>
    </div>
  </form>
  <!-- onn page load we can get data through ajax -->
  <div id="students-data">

  </div>
  <script>
    //Create a function for calculate each marks sum
    function calculateSum() {
      var sum = 0;
      var per = 0;
      var rank = '';
      //iterate through each textboxes and add the values
      $(".marks").each(function() {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
          sum += parseInt(this.value);
          per = parseFloat(sum / 5);
          if (per > 90) {
            rank = "1 st rank";

          } else if (per > 70 && per <= 90) {
            rank = "2 nd rank";

          } else if (per > 50 && per <= 70) {
            rank = "3 nd rank";

          } else {
            rank = "fail";
          }
        }
      });
      //.toFixed() method will roundoff the final sum to 2 decimal places
      $("#sum").html(sum);
      $("#per").html(per.toFixed(2) + '%');
      $("#rank").html(rank);

    }

    function loadListing() {
      $.ajax({
        url: "listOfStudents.php",
        success: function(data) {
          $("#students-data").html(data);
        }
      });
    }
    //custom method for creating only accept alphabets
    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Letters only please");

    //custom method for creating only accept numeric
    jQuery.validator.addMethod("numbersonly", function(value, element) {
      return this.optional(element) || /^[0-9]/.test(value);
    }, "numbers only please");

    $(document).ready(function() {
      loadListing();
      //put jquery plugin validation
      $("#ajax-form").validate({

        rules: {
          // The key name on the left side is the name attribute
          // of an input field. Validation rules are defined
          // on the right side
          first_name: {
            required: true,
            lettersonly: true
          },
          last_name: {
            required: true,
            lettersonly: true
          },
          gender: {
            required: true
          },
          "hobbies[]": {
            required: true
          },
          subject1: {
            number: true,
            maxlength: 2,
            minlength: 1,
            required: true,
            numbersonly: true
          },
          subject2: {
            number: true,
            maxlength: 2,
            minlength: 1,
            required: true,
            numbersonly: true
          },
          subject3: {
            number: true,
            maxlength: 2,
            minlength: 1,
            required: true,
            numbersonly: true
          },
          subject4: {
            number: true,
            maxlength: 2,
            minlength: 1,
            required: true,
            numbersonly: true
          },
          subject5: {
            number: true,
            maxlength: 2,
            minlength: 1,
            required: true,
            numbersonly: true
          },
          birth_date: {
            date: true,
            required: true
          },
        },
        messages: {
          first_name: {
            required: "Enter your first name",
            lettersonly: "Please enter letters only"
          },
          last_name: {
            required: "Enter your last name ",
            lettersonly: "Please enter letters only"
          },
          gender: {
            required: "please select one from both of them"
          },
          "hobbies[]": {
            required: "please select your hobby / multiple selection is allowed",
          },
          birth_date: "please select you birth date",
          subject1: {
            required: "Enter your subject1 mark",
            minlength: "please enter subject1 marks min 1 and max 2 length",
            numbersOnly: "Please enter subject1 marks numbers only"
          },
          subject2: {
            required: "Enter your subject2 mark",
            minlength: "please enter subject2 marks min 1 and max 2 length",
            numbersOnly: "Please enter subject4 marks numbers only"
          },
          subject3: {
            required: "Enter your subject3 mark",
            minlength: "please enter subject3 marks min 1 and max 2 length",
            numbersOnly: "Please enter subject3 marks numbers only"
          },
          subject4: {
            required: "Enter your subject4 mark",
            minlength: "please enter subject4 marks min 1 and max 2 length",
            numbersOnly: "Please enter subject4 marks numbers only"
          },
          subject5: {
            required: "Enter your subject5 mark",
            minlength: "please enter subject5 marks min 1 and max 2 length",
            numbersOnly: "Please enter subject5 marks numbers only"
          },
        },

        groups: {
          gen: "gender",
          check: "hobbies[]"
        },
        errorPlacement: function(error, element) {
          if (element.attr("name") == "gender") {
            error.insertAfter(".gender");
            $("#radioMsg").html("<span style='color:red' class='alert alert-danger' id='error'></span>");
          } else if (element.attr("name") == "hobbies[]") {
            error.insertAfter(".hobbie");
            $("#checkBoxMsg").html("<span style='color:red' class='alert alert-danger' id='error'>please select hobie</span>");
          } else {
            error.insertAfter(element);
          }
        },

        submitHandler: function(form) {
          var data = new FormData(form);
          var rank= $("#rank").val();
          alert(rank);
          $.ajax({
            // through serialize 
            url: "addStudentBack.php",
            type: "post",
            
            data: $(form).serialize(),

            success: function(response) {
              var jsonData = JSON.parse(response);
              if (jsonData.success == "1") {
                alert("Student Added Succefully");
              }
              loadListing();
            },
            error: function(response) {
              if (jsonData.success == "0") {
                alert("invalid data");
              }
            }

            //through object
            // url: "addStudentBack.php",
            // enctype: 'multipart/form-data',
            // type: "post",
            // data: data,
            // processData: false,
            // contentType: false,
            // success: function(data) {

            //   alert("pass data through object");
            //   loadListing();
            // }
          });
        }
      });
      //oncick of rest button reset the form
      // $("#resetData").on('click', function() {
      //   $("#ajax-form").reset();
      // });

      //iterate through each textboxes and add keyup
      //handler to trigger sum event
      $(".marks").each(function() {
        $(this).keyup(function() {
          calculateSum();
        });
      });
    });
  </script>
</body>

</html>