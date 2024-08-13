<?php 
    include('../connection/config.php');

    function generateUniqueId($length = 16) {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    if (isset($_POST['btnsubmit'])) {
        $std_id = generateUniqueId(16);
        $stdname = mysqli_real_escape_string($con, $_POST['stdname']);
        $stdimage = $_FILES['stdimage']['name'];
        $stdage = intval($_POST['stdage']);
        $stdemail = mysqli_real_escape_string($con, $_POST['stdemail']);
        $stdclass = mysqli_real_escape_string($con, $_POST['stdclass']);
        $mathsmarks = intval($_POST['mathsmarks']);
        $englishmarks = intval($_POST['englishmarks']);
        $computermarks = intval($_POST['computermarks']);
        $physicsmarks = intval($_POST['physicsmarks']);
        $urdumarks = intval($_POST['urdumarks']);
        $totalmarks = 500;
        $obtainedmarks = $mathsmarks + $englishmarks + $computermarks + $physicsmarks + $urdumarks;
        $percentage = ($obtainedmarks / $totalmarks) * 100;

        if ($percentage >= 90) $grade = "A+";
        else if ($percentage >= 80) $grade = "A";
        else if ($percentage >= 70) $grade = "B";
        else if ($percentage >= 60) $grade = "C";
        else if ($percentage >= 50) $grade = "D";
        else if ($percentage >= 40) $grade = "E";
        else $grade = "Fail";

        $folderName = $stdname;
        $folderPath = '../uploads/' . $folderName;
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        
        $targetedFile = $folderPath . '/' . $stdimage;

        if (move_uploaded_file($_FILES['stdimage']['tmp_name'], $targetedFile)) {
            $query = "INSERT INTO `tbl_std` (std_id, std_name, std_image, std_age, std_email, std_class, maths, english, computer, physics, urdu, total_marks, obtained_marks, percentage, grade) 
                      VALUES ('$std_id', '$stdname', '$stdimage', $stdage, '$stdemail', '$stdclass', $mathsmarks, $englishmarks, $computermarks, $physicsmarks, $urdumarks, $totalmarks, $obtainedmarks, $percentage, '$grade')";

            if (mysqli_query($con, $query)) {
                echo "<script>alert('Record Inserted Successfully'); window.location.href='show.php';</script>";
            } else {
                echo "<script>alert('Insert error: " . mysqli_error($con) . "');</script>";
            }
        } else {
            echo "<script>alert('File upload error');</script>";
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">
<title>Title</title>
</head>
<body>
    <div class="container-fluid">
            <h1 class="display-3 fw-bold">Create Student Record</h1>
            <hr>

            <form method="post" enctype='multipart/form-data'>
                <div class="row">
                    <div class="col-6">
                        <label for="stdname">Student Name:</label>
                        <input type="text" class="form-control" placeholder="Enter your name" name="stdname" required>

                        <label for="stdimage">Student Image:</label>
                        <input type="file" class="form-control" placeholder="Choose your profile pic" name="stdimage" required>

                        <label for="stdage">Student Age:</label>
                        <input type="number" class="form-control" placeholder="Enter your age" name="stdage" required>

                        <label for="stdemail">Student Email:</label>
                        <input type="email" class="form-control" placeholder="xyz@email.com" name="stdemail" required>

                        <label for="stdclass">Student Class:</label>
                        <input type="text" class="form-control" placeholder="Enter your class" name="stdclass" required>

                    </div>
                    <div class="col-6">
                        <label for="mathsmarks">Maths Marks:</label>
                        <input type="number" class="form-control" placeholder="Enter Maths Marks" name="mathsmarks" required>
                        <label for="englishmarks">English Marks:</label>
                        <input type="number" class="form-control" placeholder="Enter Maths Marks" name="englishmarks" required>
                        <label for="computermarks">Computer Marks:</label>
                        <input type="number" class="form-control" placeholder="Enter Maths Marks" name="computermarks" required>
                        <label for="physicsmarks">Physics Marks:</label>
                        <input type="number" class="form-control" placeholder="Enter Maths Marks" name="physicsmarks" required>
                        <label for="urdumarks">Urdu Marks:</label>
                        <input type="number" class="form-control" placeholder="Enter Maths Marks" name="urdumarks" required>

                       

                    </div>
                </div>
                <button class="btn" name="btnsubmit">Create Record</button>
            </form>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>