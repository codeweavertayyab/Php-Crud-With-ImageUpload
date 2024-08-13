<?php 
include('../connection/config.php');
$query = "SELECT * FROM `tbl_std`";
$result = mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/show.css">
<title>Student - Show</title>
</head>
<body>
    <div class="container-fluid">
    <h1 class="display-3 fw-bold m-5">ALL STUDENTS</h1>
    <div>
        <a href="create.php" class="btn btncreate">Create New Record</a>
    </div>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Class</th>
                <th>Maths</th>
                <th>English</th>
                <th>Computer</th>
                <th>Physics</th>
                <th>Urdu</th>
                <th>Total Marks</th>
                <th>Obtained Marks</th>
                <th>Percentage</th>
                <th>Grade</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($result as $data){

            
            ?>
            <tr>
                <td><?php echo $data['std_name']?></td>
                <td><?php echo $data['std_age']?></td>
                <td><?php echo $data['std_email']?></td>
                <td><?php echo $data['std_class']?></td>
                <td><?php echo $data['maths']?></td>
                <td><?php echo $data['english']?></td>
                <td><?php echo $data['computer']?></td>
                <td><?php echo $data['physics']?></td>
                <td><?php echo $data['urdu']?></td>
                <td><?php echo $data['total_marks']?></td>
                <td><?php echo $data['obtained_marks']?></td>
                <td><?php echo $data['percentage'].'%'?></td>
                <td><?php echo $data['grade']?></td>
                <td>
                    <img width="50" src="../uploads/<?php echo $data['std_name'] .'/'. $data['std_image']?>" alt="">
                </td>
                <td>
                    <a href="" class="btn btnactions btn-warning">Update</a>
                
                    <a href="delete.php?id=<?php echo $data['id']?>" class="btn btnactions btn-danger">Delete</a>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>
</html>