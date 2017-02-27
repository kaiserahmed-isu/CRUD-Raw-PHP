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
          <li ><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
          <li class="dropdown active" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
            <ul class="dropdown-menu" >
              <li><a href="project_view.php">View Projects</a></li>
              <li><a href="project_add.html">Add Project</a></li>
            </ul>
          </li>
          <li><a href="#">Tasks </a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Account</a></li>
        </ul>
      </div> <!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
  </nav>

<div class="container">
  <div class="row">
    <p> </p>

    <div class="col-md-10 col-md-offset-1">

      <div class="panel panel-default panel-table">
        <div class="panel-heading">
          <div class="row">
            <div class="col col-xs-6">
              <h3 class="panel-title">Projects</h3>
            </div>
            <div class="col col-xs-6 text-right">
              <a href="project_add.html" class="btn btn-sm btn-primary btn-create" role="button">Create New</a>
              <!-- <button type="button" class="btn btn-sm btn-primary btn-create">Create New</button> -->
            </div>
          </div>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-list">
            <thead>
              <tr>
                <th><em class="fa fa-cog"></em></th>
                <th class="hidden-xs">ID</th>
                <th>Name</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>

              <?php
              //  Includes Database connection settings
              require_once('./includes/db_settings.php');

              // Connect database
              $conn = new mysqli($hn, $un, $pw, $db);
              // Check connection
              if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT id, name, description FROM projects";

              $result = mysqli_query($conn, $sql)or die(mysqli_error());
              // print_r(mysqli_fetch_array($result));


                while ($row = mysqli_fetch_array($result)) {
                  echo '<tr>
                    <td align="center">
                      <a class="btn btn-success" href="project_edit.php?id=' . $row['id'] . '"><em class="fa fa-pencil"></em></a>
                      <a class="btn btn-danger" onclick="delete_user(' . $row['id'] . ' );" ><em class="fa fa-trash"></em></a>
                    </td>
                    <td class="hidden-xs">' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['description'] . '</td>
                  </tr>';

                }

              ?>

              <!-- <tr>
                <td align="center">
                  <a class="btn btn-default"><em class="fa fa-pencil"></em></a>
                  <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
                </td>
                <td class="hidden-xs">3</td>
                <td>Custom E-commerce Site</td>
                <td>Custom shopping cart that accommodates matrix of sizes, colors and custom messages.</td>
              </tr> -->

            </tbody>
          </table>

        </div>
        <div class="panel-footer">
          <div class="row">
            <div class="col col-xs-4">Page 1 of 5
            </div>
            <div class="col col-xs-8">
              <ul class="pagination hidden-xs pull-right">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
              </ul>
              <ul class="pagination visible-xs pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  <!-- row -->
</div> <!-- container -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	function delete_user( id ){
  	  //prompt the user
    	var answer = confirm('Are you sure to delete this project?');
    	if ( answer ){ //if user clicked ok
    	    //redirect to url with action as delete and id of the record to be deleted
    	    window.location = 'project_delete.php?action=delete&id=' + id;
    	}
  	}
</script>
</body>

</html>
