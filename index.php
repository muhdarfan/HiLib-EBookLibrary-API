<?php 
include("classes/DataBase.class.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HILIB ADMIN CONSOLE</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
	integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
	integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
	integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h1>Home <small>List Of Uploaded Exam</small></h1>
				<hr />
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php 
				$host = $_SERVER['SERVER_NAME'];
				$fullurl = "http://".$host."/hilib/addpaper.php";
				echo "<a class='btn btn-default pull-right' href='".$fullurl."'>Upload New File</a>";
				?>
				<br />
				<br />
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Uploaded File list(s)</h3>
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>Bil.</th>
							<th>Paper Name</th>
							<th>Course Name</th>
							<th>Category</th>
							<th>Date Uploaded</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Bil.</th>
							<th>Paper Name</th>
							<th>Course Name</th>
							<th>Category</th>
							<th>Date Uploaded</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
						$db = DataBase::getInstance();
						if(is_object($db)){
							$sql = "SELECT * FROM ".TBL_PREV_EXAMS;
							$row = $db->executeGrab($sql);
							if(is_array($row)){
								$len = count($row);
								for($i=0;$i<$len;$i++){
									?>
									<tr>
										<td><?php echo "<span class='badge badge-success'>".($i+1)."</span>";?></td>
										<td><?php echo $row[$i]['file_name'];?></td>
										<td><?php echo $row[$i]['course_name'];?></td>
										<td><?php echo $row[$i]['category'];?></td>
										<td><?php echo $row[$i]['up_dt'];?></td>
										<td><a href="view.php?file=<?php echo $row[$i]['file_name'];?>" class="btn btn-success">View File</a></td>
									</tr>
									<?php 
								}//end for
							}//end if
						}//end if

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>

</html>