<?php
include 'db.php';
if (isset($_POST['submit'])) {
    $year = (empty($_POST['year'])) ? '' : $_POST['year'];
    $sub1 = (empty($_POST['sub1'])) ? '' : $_POST['sub1'];
    $sub2 = (empty($_POST['sub2'])) ? '' : $_POST['sub2'];
    $sub3 = (empty($_POST['sub3'])) ? '' : $_POST['sub3'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $NRC = $_POST['nrc'];
    $DOB = $_POST['birth'];
    $state = $_POST['state'];
    $town = $_POST['town'];
    $gender = isset($_POST['male']) ? $_POST['male'] = 'male' : $_POST['male'] = '';
    $gender .= isset($_POST['female']) ? $_POST['female'] = 'female' : $_POST['female'] = '';

    $hobbies = implode(",", $_POST['hobby']);
    $query = "INSERT INTO `students` ( `name`, `email` ,`phone`,`address`,`NRC`,`DateOfBirth`,`State`,`Township`,`gender`,`hobby`)
            VALUES ('$name', '$email','$phone','$address','$NRC','$DOB','$state','$town','$gender','$hobbies')";
    $query_run = mysqli_query($conn, $query);
    $id = $conn->insert_id;
    if (!empty($year)) {
        $c = count($year);
        for ($i = 0; $i < $c; $i++) {
            $y = $year[$i];
            $s1 = $sub1[$i];
            $s2 = $sub2[$i];
            $s3 = $sub3[$i];
            $sql = "INSERT INTO `students_year` (`stud_id`,`year`, `subject1`,`subject2`,`subject3`) VALUES ('$id','$y', '$s1','$s2','$s3')";
            $query_run = mysqli_query($conn, $sql);
        }
    }

    if ($query_run) {
        $_SESSION['message'] = "Student Created Successfully...";
        echo "<script>window.location='index.php'</script>";
        exit(0);
    } else {
        $_SESSION['message'] = "Fail Creating ...";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form For Student</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<body class="bg-dark">
  <div class="container mt-3">
    <h1 class="text-center text-light"><marquee>Student Registration Form</marquee></h1>
    <?php
if (isset($_SESSION['message'])) {
    ?>

    <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
      <strong> Hey! </strong> <?=$_SESSION['message'];?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php
unset($_SESSION['message']);
}
?>

    <form action="" method="post" class="w-75 mx-auto mt-5 text-light needs-validation" novalidate>
      <div class="row">
        <div class="col-md-4">
          <div class="mb-3">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name..." required>
            <div class="invalid-feedback">
              Please Enter a name
            </div>
          </div>
          <div class="mb-3">
            <label for="name">Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email..." required>
            <div class="invalid-feedback">
              Please Enter Email
            </div>
          </div>
          <div class="mb-3">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone..." required>
            <div class="invalid-feedback">
              Please Enter Phone-No
            </div>
          </div>
          <div class="mb-3">
            <label for="state">State:</label>
            <select name="state" id="state" class="form-control" required>
            <option value="">Choose State:</option>
              <option value="Kachin">Kachin</option>
              <option value="Shan">Shan</option>
              <option value="Chin">Chin</option>
              <option value="Kayin">Kayin</option>
              <option value="Mon">Mon</option>
              <option value="Kayah">Kayah</option>
              <option value="Rakhine">Rakhine</option>
            </select>
            <div class="invalid-feedback">
              Please select a state.
            </div>
          </div>
          <div class="mb-3">
            <label for="town">TownShip:</label>
            <select name="town" id="town" class="form-control" required>
            <option value="">Choose TownShip:</option>
              <option value="Insein">Insein</option>
              <option value="Kamayut">Kamayut </option>
              <option value="Tamwe">Tamwe</option>
              <option value="Sanchaung">Sanchaung</option>
              <option value="North-Okkalapa">North-Okkalapa</option>
              <option value="Yankin">Yankin</option>
              <option value="Mingaladon">Mingaladon</option>
              <option value="Thaketa">Thaketa</option>
              <option value="Thingangyun">Thingangyun</option>
              <option value="Kyimyindaing">Kyimyindaing</option>
              <option value="Kyauktada">Kyauktada</option>
              <option value="Latha">Latha</option>
              <option value="Pazundaung">Pazundaung</option>
              <option value="South-Dagon">South-Dagon</option>
              <option value="Botataung">Botataung</option>
              <option value="Hlaingthaya">Hlaingthaya</option>
              <option value="Hlaing">Hlaing</option>
              <option value="Dala">Dala</option>
              <option value="Dagon-Seikkan">Dagon-Seikkan</option>
            </select>
            <div class="invalid-feedback">
              Please select a TownShip.
            </div>
          </div>
        </div>

        <div class="col-md-8 mt-1">
          <div class="mb-3">
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="inlineCheckbox1">Gender:</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="male" value="">
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="female" value="">
              <label class="form-check-label" for="female">Female</label>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check form-check-inline">
              <label class="form-check-label" for="inlineCheckbox1">Hobby:</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="hobby[]" value="Reading">
              <label class="form-check-label" for="reading">Reading</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="hobby[]" value="Coding">
              <label class="form-check-label" for="coding">Coding</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="hobby[]" value="Photographing">
              <label class="form-check-label" for="photographing">Photographing</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="hobby[]" value="Blogging">
              <label class="form-check-label" for="blogging">Blogging</label>
            </div>
          </div>

          <div class="mb-3">
            <label for="nrc">NRC:</label>
            <input type="text" name="nrc" id="nrc" class="form-control" placeholder="Enter NRC..." required>
            <div class="invalid-feedback">
              Please Enter Your NRC.
            </div>
          </div>
          <div class="mb-3">
            <label for="birth">Date Of Birth:</label>
            <input type="date" name="birth" id="birth" class="form-control" required>
            <div class="invalid-feedback">
              Please Choose Your BOD.
            </div>
          </div>
          <div class="mb-3">
            <label for="address">Address:</label>
            <textarea name="address" id="address" cols="20" rows="5" class="form-control" placeholder="Enter Address..." required></textarea>
            <div class="invalid-feedback">
              Please Enter Your Address.
            </div>
          </div>
        </div>
      </div>
      <hr class="bg-light">
      <button class="text-dark btn btn-info mt-5 mb-3" id="add" name="add">Add for Years and Subjects <i class="fa fa-plus-square" aria-hidden="true"></i></button>

      <div class="second">
      <table class="table table-striped" id="myTable">
        <thead class="text-center">
          <th>Year</th>
          <th>Subject1</th>
          <th>Subject2</th>
          <th>Subject3</th>
          <th>Action</th>
        </thead>
        <tbody class="tbody">
        </tbody>
      </table>
      </div>
      <button type="submit" class="btn btn-success" name="submit">Submit</button>
      <a href="index.php" class="btn btn-primary mt-3 mb-3">Back</a>
    </form>
  </div>
  <script src="script.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
//$(document).on('click', '.deleteBtn', function(){
//  $(this).closest('tr').remove();
//});
$(document).ready(function() {
  // Add row
  $('#add').click(function(e) {
    e.preventDefault();
    var newRow = $('<tr>');
    var year = $('<input>').attr('type', 'text').attr('name', 'year[]');
    var sub1 = $('<input>').attr('type', 'text').attr('name', 'sub1[]');
    var sub2 = $('<input>').attr('type', 'text').attr('name', 'sub2[]');
    var sub3 = $('<input>').attr('type', 'text').attr('name', 'sub3[]');
    var deleteBtn = $('<button>').attr('class', 'deleteRow btn btn-danger').text('Delete');
    newRow.append($('<td>').append(year));
    newRow.append($('<td>').append(sub1));
    newRow.append($('<td>').append(sub2));
    newRow.append($('<td>').append(sub3));
    newRow.append($('<td>').append(deleteBtn));
    $('#myTable tbody').append(newRow);
  });

  // Delete row
  $(document).on('click', '.deleteRow', function() {
    $(this).closest('tr').remove();
  });
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

</script>
</body>
</html>