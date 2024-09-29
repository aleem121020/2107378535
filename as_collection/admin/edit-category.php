<?php
session_start();
include ('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata');// change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());


	if (isset($_POST['submit'])) {
		$category = $_POST['category'];
		$description = $_POST['description'];
		$h1_title = $_POST['h1_title'];
		$meta_title = $_POST['meta_title'];
		$meta_description = $_POST['meta_description'];
		$meta_keywords = $_POST['meta_keywords'];
		$canonical = $_POST['canonical'];
		$id = intval($_GET['id']);
		$sql = mysqli_query($con, "update category set categoryName='$category',categoryDescription='$description',updationDate='$currentTime',meta_title='$meta_title',meta_keywords='$meta_keywords',meta_description='$meta_description',canonical='$canonical',h1_title='$h1_title' where id='$id'");
		$_SESSION['msg'] = "Category Updated !!";

	}

	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Category</title>
		<link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">
		<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link type="text/css" href="css/theme.css" rel="stylesheet">
		<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
		<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
			rel='stylesheet'>
	</head>

	<body>
		<?php include ('include/header.php'); ?>

		<div class="wrapper">
			<div class="container">
				<div class="row">
					<?php include ('include/sidebar.php'); ?>
					<div class="span9">
						<div class="content">

							<div class="module">
								<div class="module-head">
									<h3>Category</h3>
								</div>
								<div class="module-body">

									<?php if (isset($_POST['submit'])) { ?>
										<div class="alert alert-success">
											<button type="button" class="close" data-dismiss="alert">×</button>
											<strong>Well done!</strong>
											<?php echo htmlentities($_SESSION['msg']); ?>		<?php echo htmlentities($_SESSION['msg'] = ""); ?>
										</div>
									<?php } ?>


									<br />

									<form class="form-horizontal row-fluid" name="Category" method="post">
										<?php
										$id = intval($_GET['id']);
										$query = mysqli_query($con, "select * from category where id='$id'");
										while ($row = mysqli_fetch_array($query)) {
											?>
											<div class="control-group">
												<label class="control-label" for="basicinput">Category Name</label>
												<div class="controls">
													<input type="text" placeholder="Enter category Name" name="category"
														value="<?php echo htmlentities($row['categoryName']); ?>"
														class="span8 tip" required>
												</div>
											</div>


											<div class="control-group">
												<label class="control-label" for="basicinput">Description</label>
												<div class="controls">
													<textarea class="span8" name="description"
														rows="5"><?php echo htmlentities($row['categoryDescription']); ?></textarea>
												</div>
											</div>


											<div class="control-group">
												<label class="control-label" for="basicinput">Meta Title</label>
												<div class="controls">
													
														<input type="name" name="meta_title" class="span8 tip"
													placeholder="Enter meta Title" value="<?php echo htmlentities($row['meta_title']); ?>"required>
												</div>
											</div>



											<div class="control-group">
												<label class="control-label" for="basicinput">Meta Keywords</label>
												<div class="controls">
													
														<input type="name" name="meta_keywords" class="span8 tip"
													placeholder="Enter Meta Keywords" value="<?php echo htmlentities($row['meta_keywords']); ?>"required>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="basicinput">Meta Description</label>
												<div class="controls">
													
														<input type="name" name="meta_description" class="span8 tip"
													placeholder="Enter meta Description" value="<?php echo htmlentities($row['meta_description']); ?>"required>
												</div>
											</div>


											<div class="control-group">
												<label class="control-label" for="basicinput">Canonical</label>
												<div class="controls">
													
														<input type="name" name="canonical" class="span8 tip"
													placeholder="Enter Canonical" value="<?php echo htmlentities($row['canonical']); ?>"required>
												</div>
											</div>


											<div class="control-group">
												<label class="control-label" for="basicinput">H1 tag(Not visival to website Its
												For SEO)</label>
												<div class="controls">
													
														<input type="name" name="h1_title" class="span8 tip"
													placeholder="Enter h1 Title" value="<?php echo htmlentities($row['h1_title']); ?>"required>
												</div>
											</div>



										<?php } ?>

										<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update</button>
											</div>
										</div>
									</form>
								</div>
							</div>






						</div><!--/.content-->
					</div><!--/.span9-->
				</div>
			</div><!--/.container-->
		</div><!--/.wrapper-->

		<?php include ('include/footer.php'); ?>

		<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
		<script src="scripts/datatables/jquery.dataTables.js"></script>
		<script>
			$(document).ready(function () {
				$('.datatable-1').dataTable();
				$('.dataTables_paginate').addClass("btn-group datatable-pagination");
				$('.dataTables_paginate > a').wrapInner('<span />');
				$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
				$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
			});
		</script>
	</body>
<?php } ?>