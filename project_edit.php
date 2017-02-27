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
        <a class="navbar-brand" href="index.php">ToDo</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
          <li class="dropdown active">
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
    <div class="row">
        <h3>Edit Project</h3>
        <?php
        //  Includes Database connection settings
        require_once './includes/db_settings.php';
        include_once './includes/functions.php';

        // Connect database
        $conn = new mysqli($hn, $un, $pw, $db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST['description'])) {
          $id = mysql_entities_fix_string($conn, $_POST["id"]);
          $name = mysql_entities_fix_string($conn, $_POST["name"]);
          $descript = mysql_entities_fix_string($conn, $_POST['description']);

          $sql="UPDATE projects SET name = '".$name."', description = '".$descript."' WHERE id =  '".$id."';";
          //print_r($sql);
          if( $conn->query($sql) ){
        	//if successful update
            ?>
            <p> Project updated successfully!
              <a class="btn btn-success" href="project_view.php">Back to projects.</a>
            </p>
            <?php
        	}
          else {
        	//if there's a database problem
          //echo("Error description: " . mysqli_error($conn));
            ?>
            <p> Database Error: Unable to update the record.
              <a class="btn btn-success" href="project_view.php">Back</a>
            </p>
            <?php
        	}
        }
        else if(isset($_GET['id']) && $_GET['id'] != NULL) {
        // id index exists
        $sql = "SELECT id, name, description FROM projects WHERE id='".$_GET['id']."'";

        $result = mysqli_query($conn, $sql)or die(mysqli_error());
        $row = mysqli_fetch_array($result);
        //var_dump($row);
        ?>
        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label class="control-label">Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Description:</label>
                <input type="text" class="form-control" name="description" value="<?php echo $row['description'] ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <button type="submit" class="btn btn-success">Update</button>
            <a class="btn btn-default" href="project_view.php">Back</a>
        </form><!-- end of form -->

        <?php
        }
        else {
          ?>
          <p> Something went wrong!
            <a class="btn btn-default" href="project_view.php">Please go back </a>
          </p>
          <?php
        }

         ?>

    </div> <!-- row -->
  </div> <!-- container -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
