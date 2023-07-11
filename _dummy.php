<?php
include 'db.php';
$time[] = array();
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);

if ($row <= 20) {
    for ($i = 1; $i <= 20; $i++) {
        $name = 'aung' . $i;
        $phone = '0925027540' . $i;
        $email = 'aung'. $i .'@gmail.com';
        $address = 'yangon'.$i;
        $gender = 'male';
        $hobby = 'Coding';
        $state = 'Mon';
        $town = 'Hlaing';
        $date = '2023-06-01';


        $sql = "INSERT INTO students(name,email,phone,address,gender,hobby,NRC,DateOfBirth,State,Township) VALUES 
                ('$name' , '$email' , '$phone','$address','$gender','$hobby','','$date','$state','$town')";
        $sql_run = mysqli_query($conn, $sql);
    }
} else {
    echo "Already Have above 20 rows in database...";
}

if ($sql_run) {
    echo "Records  successfully";
}
