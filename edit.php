<?php
include 'db.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  if (isset($_POST['update'])) {
    $year = (empty($_POST['year'])) ? '' : $_POST['year'];
    $idd = (empty($_POST['dd'])) ? '' : $_POST['dd'];
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
    $hobbies = implode(", ", $_POST['hobby']);
    if (!empty($year)) {
      $c = count($year);
      for ($i = 0; $i < $c; $i++) {
        $d = $idd[$i];
        $y = $year[$i];
        $s1 = $sub1[$i];
        $s2 = $sub2[$i];
        $s3 = $sub3[$i];
        $sql = "UPDATE `students_registration`.`students_year` SET  year='$y' , subject1='$s1', subject2='$s2' ,  subject3='$s3'
    where id='$d'";
        $q = mysqli_query($conn, $sql);
      }
    }
    $query = "UPDATE `students_registration`.`students` SET  name='$name' , email='$email', phone='$phone' ,  address='$address' , NRC='$NRC' ,
             DateOfBirth='$DOB' , State='$state' , Township='$town' , gender='$gender' , hobby='$hobbies'
            where id='$id' ";
    $query_run = mysqli_query($conn, $query);
    if ($query_run || $q) {
      $_SESSION['message'] = "Student Updated Successfully...";
    } else {
      $_SESSION['message'] = "Fail Creating ...";
    }
  }

  $student_id = $_GET['id'];
  $query = "SELECT * FROM students_registration.students WHERE id='$student_id'";
  $query_run = mysqli_query($conn, $query);
  if (mysqli_num_rows($query_run) > 0) {
    $students = mysqli_fetch_array($query_run);
    $selected_hobbies = explode(',', $students['hobby']);
    $current_selection = $students['State'];
    $current_township = $students['Township'];
    $name = $students['name'];
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

    <body class="bg-secondary">
      <div class="container mt-3">
        <h1 class="text-center text-light">
          <marquee>Student Registration Form</marquee>
        </h1>
        <?php
        if (isset($_SESSION['message'])) {
        ?>

          <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
            <strong> Hey! </strong> <?= $_SESSION['message']; ?>
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
                <input type="text" name="name" id="name" class="form-control" value="<?= $students['name']; ?>" required>
                <div class="invalid-feedback">
                  Please Enter a name
                </div>
              </div>
              <div class="mb-3">
                <label for="name">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $students['email']; ?>" required>
                <div class="invalid-feedback">
                  Please Enter Email
                </div>
              </div>
              <div class="mb-3">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= $students['phone']; ?>" required>
                <div class="invalid-feedback">
                  Please Enter Phone-No
                </div>
              </div>
              <div class="mb-3">
                <label for="state">State:</label>
                <select name="state" id="state" class="form-control" required>
                  <option value="">Choose State:</option>
                  <option value="Mon" <?php if ($current_selection == "Mon") {
                                        echo 'selected="selected"';
                                      }
                                      ?>>Mon</option>
                  <option value="Kachin" <?php if ($current_selection == "Kachin") {
                                            echo 'selected="selected"';
                                          }
                                          ?>>Kachin</option>
                  <option value="Shan" <?php if ($current_selection == "Shan") {
                                          echo 'selected="selected"';
                                        }
                                        ?>>Shan</option>
                  <option value="Chin" <?php if ($current_selection == "Chin") {
                                          echo 'selected="selected"';
                                        }
                                        ?>>Chin</option>
                  <option value="Kayin" <?php if ($current_selection == "Kayin") {
                                          echo 'selected="selected"';
                                        }
                                        ?>>Kayin</option>
                  <option value="Kayah" <?php if ($current_selection == "Kayah") {
                                          echo 'selected="selected"';
                                        }
                                        ?>>Kayah</option>
                  <option value="Rakhine" <?php if ($current_selection == "Rakhine") {
                                            echo 'selected="selected"';
                                          }
                                          ?>>Rakhine</option>
                </select>
                <div class="invalid-feedback">
                  Please select a state.
                </div>
              </div>
              <div class="mb-3">
                <label for="town">TownShip:</label>
                <select name="town" id="town" class="form-control" required>
                  <option value="">Choose TownShip:</option>
                  <option value="Insein" <?php if ($current_township == "Insein") {
                                            echo 'selected="selected"';
                                          }
                                          ?>>Insein</option>
                  <option value="Kamayut" <?php if ($current_township == "Kamayut") {
                                            echo 'selected="selected"';
                                          }
                                          ?>>Kamayut </option>
                  <option value="Tamwe" <?php if ($current_township == "Tamwe") {
                                          echo 'selected="selected"';
                                        }
                                        ?>>Tamwe</option>
                  <option value="Sanchaung" <?php if ($current_township == "Sanchaung") {
                                              echo 'selected="selected"';
                                            }
                                            ?>>Sanchaung</option>
                  <option value="North-Okkalapa" <?php if ($current_township == "North-Okkalapa") {
                                                    echo 'selected="selected"';
                                                  }
                                                  ?>>North-Okkalapa</option>
                  <option value="Yankin" <?php if ($current_township == "Yankin") {
                                            echo 'selected="selected"';
                                          }
                                          ?>>Yankin</option>
                  <option value="Mingaladon" <?php if ($current_township == "Mingaladon") {
                                                echo 'selected="selected"';
                                              }
                                              ?>>Mingaladon</option>
                  <option value="Thaketa" <?php if ($current_township == "Thaketa") {
                                            echo 'selected="selected"';
                                          }
                                          ?>>Thaketa</option>
                  <option value="Thingangyun" <?php if ($current_township == "Thingangyun") {
                                                echo 'selected="selected"';
                                              }
                                              ?>>Thingangyun</option>
                  <option value="Kyimyindaing" <?php if ($current_township == "Kyimyindaing") {
                                                  echo 'selected="selected"';
                                                }
                                                ?>>Kyimyindaing</option>
                  <option value="Kyauktada" <?php if ($current_township == "Kyauktada") {
                                              echo 'selected="selected"';
                                            }
                                            ?>>Kyauktada</option>
                  <option value="Latha" <?php if ($current_township == "Latha") {
                                          echo 'selected="selected"';
                                        }
                                        ?>>Latha</option>
                  <option value="Pazundaung" <?php if ($current_township == "Pazundaung") {
                                                echo 'selected="selected"';
                                              }
                                              ?>>Pazundaung</option>
                  <option value="South-Dagon" <?php if ($current_township == "South-Dagon") {
                                                echo 'selected="selected"';
                                              }
                                              ?>>South-Dagon</option>
                  <option value="Botataung" <?php if ($current_township == "Botataung") {
                                              echo 'selected="selected"';
                                            }
                                            ?>>Botataung</option>
                  <option value="Hlaingthaya" <?php if ($current_township == "Hlaingthaya") {
                                                echo 'selected="selected"';
                                              }
                                              ?>>Hlaingthaya</option>
                  <option value="Hlaing" <?php if ($current_township == "Hlaing") {
                                            echo 'selected="selected"';
                                          }
                                          ?>>Hlaing</option>
                  <option value="Dala" <?php if ($current_township == "Dala") {
                                          echo 'selected="selected"';
                                        }
                                        ?>>Dala</option>
                  <option value="Dagon-Seikkan" <?php if ($current_township == "Dagon-Seikkan") {
                                                  echo 'selected="selected"';
                                                }
                                                ?>>Dagon-Seikkan</option>
                </select>
                <div class="invalid-feedback">
                  Please select a TownShip.
                </div>
              </div>
            </div>

            <div class="col-md-8">
              <div class="mb-3">
                <div class="form-check form-check-inline">
                  <label class="form-check-label" for="inlineCheckbox1">Gender:</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="male" value="" <?php if ($students['gender'] == 'male') {
                                                                                          echo 'checked="checked"';
                                                                                        }
                                                                                        ?>>
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="female" value="" <?php if ($students['gender'] == 'female') {
                                                                                            echo 'checked="checked"';
                                                                                          }
                                                                                          ?>>
                  <label class="form-check-label" for="female">Female</label>
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check form-check-inline">
                  <label class="form-check-label" for="inlineCheckbox1">Hobby:</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hobby[]" value="Reading" <?php if (in_array('Reading', $selected_hobbies)) {
                                                                                                    echo 'checked="checked';
                                                                                                  }
                                                                                                  ?>>
                  <label class="form-check-label" for="reading">Reading</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hobby[]" value="Coding" <?php if (in_array('Coding', $selected_hobbies)) {
                                                                                                  echo 'checked="checked';
                                                                                                }
                                                                                                ?>>
                  <label class="form-check-label" for="coding">Coding</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hobby[]" value="Photographing" <?php if (in_array(' Photographing', $selected_hobbies)) {
                                                                                                          echo 'checked="checked';
                                                                                                        }
                                                                                                        ?>>
                  <label class="form-check-label" for="photographing">Photographing</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="hobby[]" value="Blogging" <?php if (in_array(' Blogging', $selected_hobbies)) {
                                                                                                    echo 'checked="checked';
                                                                                                  }
                                                                                                  ?>>
                  <label class="form-check-label" for="blogging">Blogging</label>
                </div>
              </div>

              <div class="mb-3">
                <label for="nrc">NRC:</label>
                <input type="text" name="nrc" id="nrc" class="form-control" value="<?= $students['NRC']; ?>" required>
                <div class="invalid-feedback">
                  Please Enter Your NRC.
                </div>
              </div>
              <div class="mb-3">
                <label for="birth">Date Of Birth:</label>
                <input type="date" name="birth" id="birth" class="form-control" value="<?= $students['DateOfBirth']; ?>" required>
                <div class="invalid-feedback">
                  Please Choose Your BOD.
                </div>
              </div>
              <div class="mb-3">
                <label for="address">Address:</label>
                <textarea name="address" id="address" cols="20" rows="5" class="form-control" value="<?= $students['address']; ?>" required><?= $students['address']; ?></textarea>
                <div class="invalid-feedback">
                  Please Enter Your Address.
                </div>
              </div>
            </div>
          </div>
          <div class="second mt-4">
            <table class="table table-striped" id="myTable">
              <thead class="text-center">
                <th>Year</th>
                <th>Subject1</th>
                <th>Subject2</th>
                <th>Subject3</th>
              </thead>
              <tbody class="tbody">
            <?php
            $sql = "SELECT * FROM students_registration.students_year  WHERE stud_id='$id'";
            $result = mysqli_query($conn, $sql);
            $students_array = array();
            $row = mysqli_num_rows($result);
            if (mysqli_num_rows($result) > 0) {
              while ($a = mysqli_fetch_assoc($result)) {
                $ii = $a['id'];
                $y = $a['year'];
                $s1 = $a['subject1'];
                $s2 = $a['subject2'];
                $s3 = $a['subject3'];
                echo '<tr>' .
                  '<td><input type="text" name="year[]" value="' . $y . '" /><input type="hidden" name="dd[]" value="' . $ii . '" /></td>' .
                  '<td><input type="text" name="sub1[]" value="' . $s1 . '" /></td>' .
                  '<td><input type="text" name="sub2[]" value="' . $s2 . '" /></td>' .
                  '<td><input type="text" name="sub3[]" value="' . $s3 . '" /></td>' .
                  '</tr>';
              }
            }
          }
        }
            ?>
              </tbody>
            </table>
          </div>
          <button type="submit" class="btn btn-success" name="update">Update</button>
          <a href="index.php" class="btn btn-primary">Back</a>
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
        (function() {
          'use strict'

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation')

          // Loop over them and prevent submission
          Array.prototype.slice.call(forms)
            .forEach(function(form) {
              form.addEventListener('submit', function(event) {
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