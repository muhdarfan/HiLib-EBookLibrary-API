<?php 
include("classes/DataBase.class.php");
include("classes/RandomStringUtils.class.php");

date_default_timezone_set('Asia/kuala_lumpur');

if(isset($_POST['upbtn'])){
  $db = DataBase::getInstance();
  $currDateTimeNow = date("Y-m-d H:i:s");
  $currDateNow = date("Y-m-d");

  if($_FILES['file']['error'] > 0){
    $someVar = "danger";
    $msg = "You must provide the files and try submit again!";
    echo $msg;
  } else {
    $filename = $_FILES['file']['name'];
    $tmpname = $_FILES["file"]["tmp_name"];

    $rand = RandomStringUtils::randomString(5);
    $imgfilename = "PAPER_".$rand;
    $extension = pathinfo($filename , PATHINFO_EXTENSION);
    $newFilename = $imgfilename.".".$extension;
    $fac = $_POST['factxt'];
    $course = $_POST['coursetxt'];
    $category = $_POST['category'];

    if(is_object($db)){
      $sqlins = "INSERT INTO TBL_PREV_EXAMS(`file_name`,`fac`,`course_name`,`up_dt`,`category`) VALUES ('".$newFilename."','".$fac."','".$course."','".$currDateNow."', '".$category."')";
      $res = $db->executeOperation($sqlins);
      if($res){
        move_uploaded_file($_FILES["file"]["tmp_name"], "docup/".$newFilename);
        echo "<div class='alert alert-success' role='alert'>Your paper was uploaded successfully!</div>";
      }else{
        echo "<div class='alert alert-danger' role='alert'>Your paper was not uploaded! Please try again.</div>";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyPoly Control Panel</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h1>Upload Form <small>Previous Exam Paper</small></h1>
        <hr>
      </div>
    </div>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Upload a new file</h3>
      </div>
      <div class="panel-body">
        <form class="form-class" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label for="">Department/Faculty</label>
        <input type="text" class="form-control" id="factxt" name="factxt" placeholder="eg:- Faculty of Business" onkeyup="this.value = this.value.toUpperCase()">
      </div>
      <div class="form-group">
        <label for="">Courses Name</label>
        <input type="text" class="form-control" id="coursetxt" name="coursetxt" placeholder="eg:- Business Management" onkeyup="this.value = this.value.toUpperCase()">
      </div>
      <div class="form-group">
        <label for="">Category</label>
        <select class="form-control" name="category">
          <option value="E-Book">E-Book</option>
          <option value="Article">Article</option>
          <option value="Journal">Journal</option>
          <option value="Exam Paper">Exam Paper</option>
          <option value="Others">Others</option>
        </select>
      </div>
      <div class="form-group">
        <label for="">File input</label>
        <input type="file" id="exampleInputFile" id="file" name="file">
        <p class="help-block">PDF format only are accepted.</p>
      </div>

      <div class="text-center"><button type="submit" class="btn btn-success" id="upbtn" name="upbtn">UPLOAD</button></div>
    </form>
      </div>
    </div>
  </div>

</body>
</html>