<?php
$hn = 'www.it354.com';
$db = 'it354_students';
$un = 'it354_students';
$pw = 'steinway';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$name = $_POST["name"];
$descript = $_POST['description'];

$sql="INSERT INTO projects (name, description)
VALUES('$name', '$descript')";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="#">ToDo</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="project_view.php">View Projects</a></li>
              <li><a href="project_add.html">Add Project</a></li>
            </ul>
          </li>
          <li><a href="#">Tasks </a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Account</a></li>
        </ul>
      </div>  <!-- /.navbar-collapse -->
    </div>  <!-- /.container-fluid -->
  </nav>


<div class="container">

<?php
  if ($conn->query($sql) === TRUE) {
      echo "<br/><span>New project record added successfully!</span><br><br>";
  } else {
      echo "<br><span>Error while inserting project!</span><br><br>";;
  }
  $conn->close();
?>

  <button type="submit" class="btn btn-default" onclick="location.href='project_add.html'">Back</button>

</div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
