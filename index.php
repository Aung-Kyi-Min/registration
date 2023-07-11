<?php
include 'db.php';
$i = 1;
//$searchTerm = $_GET['search'];
if (isset($_GET['id'])) {
    $studnet_id = $_GET['id'];
    $query = "DELETE FROM students_registration.students WHERE id='$studnet_id'";
    $query_run = mysqli_query($conn, $query);
    $sql = "DELETE FROM students_registration.students_year WHERE id='$studnet_id'";
    $sql_run = mysqli_query($conn, $sql);
    if ($query_run || $sql_run) {
        $_SESSION['message'] = "Student Deleted Successfully...";
        echo "<script>window.location='index.php'</script>";
        exit(0);
    } else {
        $_SESSION['message'] = "Student Not Deleted...";
        echo "<script>window.location='index.php'</script>";
        exit(0);
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
<?php
if (isset($_GET['page-nr'])) {
    $no = $_GET['page-nr'];
} else {
    $no = 1;
}
?>
<style>
  .ac{
    background: white;
    color: black;
  }
</style>
<body class="bg-dark" id="<?php echo $no; ?>">
  <div class="container mt-5">
    <div class="card">
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
      <div class="card-header">
        <h1>Students List</h1>
        <div class="row">
          <div class="col-md-8">
          <a href="create.php" class="btn btn-primary">Create</a>
          </div>
          <div class="col-md-4">
            <form action="" class="" method="get">
              <input type="text" name="search" placeholder="Search...">
              <button type="submit" class="btn btn-dark btn-sm">Search</button>
            </form>
          </div>
        </div>
      </div>
      <div class="card-body">
      <table class="table table table-striped text-center text-dark">
      <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>DateOfBirth</th>
        <th>NRC</th>
        <th>Address</th>
        <th>Action</th>
      </thead>
      <tbody class="w-100">
      <?php

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    if ($searchTerm == '') {
        echo "No Datas Found";
    } else {
        $query = "SELECT * FROM students WHERE
              name LIKE '%{$searchTerm}%' OR
              email LIKE '%{$searchTerm}%' OR
              phone LIKE '%{$searchTerm}%' OR
              address LIKE '%{$searchTerm}%' OR
              NRC LIKE '%{$searchTerm}%' OR
              DateOfBirth LIKE '%{$searchTerm}%' OR
              gender LIKE '%{$searchTerm}%'
              ";
        $result = mysqli_query($conn, $query);
        $totalRecords = mysqli_num_rows($result);
        $recordsPerPage = 2;
        $totalPages = ceil($totalRecords / $recordsPerPage);
        if (isset($_GET['page'])) {
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $offset = ($currentPage - 1) * $recordsPerPage;
        $query .= " LIMIT $offset, $recordsPerPage";
        $result = mysqli_query($conn, $query);
        $a = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
          <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row["name"]; ?></td>
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["phone"]; ?></td>
          <td><?php echo $row["gender"]; ?></td>
          <td><?php echo $row["DateOfBirth"]; ?></td>
          <td><?php echo $row["NRC"]; ?></td>
          <td><?php echo $row["address"]; ?></td>
          <td>
              <a href="edit.php?id=<?=$row['id'];?> " class="btn btn-primary btn-sm">Detail</a>
              <form action="index.php" method="get" class="d-inline">
                <a href="index.php?id=<?=$row['id'];?>" name="delete" onclick="return confirm('Are you sure u want to delete?')"
                  class="btn btn-danger btn-sm">Delete</a>
              </form>
            </td>
        </tr>
    <?php
}
        ?>
                </tbody>
    </table>
    <?php
for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='index.php?page=" . $i . "&search=" . $searchTerm . "' class='btn btn-warning btn-sm'>" . $i . "</a> ";
        }
    }
} else {
    $start = 0;
    $rperpages = 4;
    $q = "SELECT * FROM `students` ";
    $records = mysqli_query($conn, $q);
    $nOfRows = mysqli_num_rows($records);
    $pages = ceil($nOfRows / $rperpages);
    if (isset($_GET['page-nr'])) {
        $page = $_GET['page-nr'] - 1;
        $start = $page * $rperpages;
    }
    $query = "SELECT * FROM `students` Limit $start , $rperpages";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $students) {
            ?>
      <tr>
        <td><?=$students['id']?></td>
        <td><?=$students["name"];?></td>
        <td><?=$students["email"];?></td>
        <td><?=$students["phone"];?></td>
        <td><?=$students["gender"];?></td>
        <td><?=$students["DateOfBirth"];?></td>
        <td><?=$students["NRC"];?></td>
        <td><?=$students["address"];?></td>
        <td>
          <a href="edit.php?id=<?=$students['id'];?> " class="btn btn-primary btn-sm">Detail</a>
          <form action="index.php" method="get" class="d-inline">
            <a href="index.php?id=<?=$students['id'];?>" name="delete" onclick="return confirm('Are you sure u want to delete?')"
              class="btn btn-danger btn-sm">Delete</a>
          </form>
        </td>
      </tr>
      <?php
}
    }
    ?>
    </tbody>
    </table>

    <div class="page-info mb-3">
    <?php
if (!isset($_GET['page-nr'])) {
        $page = 1;
    } else {
        $page = $_GET['page-nr'];
    }
    ?>
     Showing <?php echo $page; ?> of <?php echo $pages; ?> Pages
  </div>
  <div class="pagination">
    <a href="?page-nr=1" class="btn btn-warning mr-2 mb-4">First</a>
    <?php
if (isset($_GET['page-nr'])) {
        ?>
          <a href="?page=<?php echo $_GET['page-nr'] - 1; ?>" class="btn btn-success mr-2 mb-4">Previous</a>
    <?php
} else {
        ?>
        <a href="" class="btn btn-success mr-2 mb-4">Previous</a>
        <?php
}
    ?>
    <div class="page-numbers">
      <?php
for ($counter = 1; $counter <= $pages; $counter++) {
        ?>
            <a href="?page-nr=<?php echo $counter; ?>" class="btn btn-dark mr-1"><?php echo $counter; ?></a>
          <?php
}
    ?>
    </div>
    <?php
if (!isset($_GET['page-nr'])) {
        ?>
         <a href="?page-nr=2" class="btn btn-success mr-2 mb-4">Next</a>
        <?php
} else {
        if ($_GET['page-nr'] >= $pages) {
            ?>
            <a href="" class="btn btn-success mr-2 mb-4">Next</a>
          <?php
} else {
            ?>
            <a href="?page-nr=<?php echo $_GET['page-nr'] + 1; ?>" class="btn btn-success mr-2 mb-4">Next</a>
          <?php
}
    }
    ?>
    <a href="?page-nr=<?php echo $pages; ?>" class="btn btn-warning mr-2 mb-4">Last</a>
  </div>
  <?php
}
?>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
  let links = document.querySelectorAll('.page-numbers > a');
  let bodyId = parseInt(document.body.id) -1;
  links[bodyId].classList.add('ac');
</script>
</body>
</html>
