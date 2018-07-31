<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');

	$conn = mysqli_connect("$db_host", "$db_username", "$db_pass", "$db_name");

	if(!$conn) {
		die("Connection Failed: " . mysqli_connect_error());
	}
	else {
		$bppe1_compare_SQL = "SELECT * FROM BPPE1 ORDER BY school";
		$bppe1_compare_Result = mysqli_query($conn, $bppe1_compare_SQL);

		if(mysqli_num_rows($bppe1_compare_Result) > 0) {
	    $GLOBALS['bppe1_compare_Result'] = $bppe1_compare_Result;
	  }

		$bppe1_compare_Var = $GLOBALS['bppe1_compare_Result'];

		while($bppe1_Row = mysqli_fetch_assoc($bppe1_compare_Var)) {
		     $school_id[] = $bppe1_Row['id'];
		     $current_school_code[] = $bppe1_Row['school_code'];
		     $current_school[] = $bppe1_Row['school'];
		     $current_phone[] = $bppe1_Row['phone'];
		     $current_county[] = $bppe1_Row['county'];
		     $current_mailing_address[] = $bppe1_Row['mailing_address'];
		     $current_physical_address[] = $bppe1_Row['physical_address'];
		     $current_approved_programs_temp = explode(',', $bppe1_Row['approved_programs']);
		     $current_approved_programs[] = sort($current_approved_programs_temp);
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>School Scraper!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div style="margin-top: 2%;" class="container">


      <div class="row">
				<div class="col">
          <form action="index.php" method="POST">
            <div class="form-group">
              <button class="btn btn-primary" type="submit" name="update_db_submit">Reload All Records</button>
            </div>
          </form>
        </div>
				<div class="col">
          <form action="index.php" method="POST">
            <div class="form-group">
              <button class="btn btn-success" type="submit" name="compare_submit">Run For Changes Only</button>
            </div>
          </form>
        </div>
				<div class="col">
          <form action="index.php" method="POST">
            <div class="form-group">
								<input type="text" name="user_search">
                <button class="btn btn-info" type="submit" name="search_submit">Search</button>
            </div>
          </form>
        </div>
			</div>

			<div style="border: 1px solid black; margin-bottom: 1%;" class="row text-center">
				<div class="col">
					<h4><?php echo "Current Record Set<br>COUNT(".COUNT($current_school_code) . ")"; ?></h4>
				</div>
				<div class="col">
					<p>Display Newly Added Records<br>COUNT()</p>
				</div>
				<div class="col">
					<p>Show Deleted Records<br>COUNT()</p>
				</div>
				<div class="col">
					<p>Show Changed Recourds<br>COUNT()</p>
				</div>
			</div>

			<form action="export_csv.php" method="POST">
			  <div class="row">
					<div class="col-md-12">
		        <table class="table table-striper table-hover dataTable">
		          <thead style="font-weight: bold; font-size: 115%;" class="text-center">
		            <tr>
		              <td scope="col">School</td>
		              <td scope="col">Phone</td>
		              <td scope="col">County</td>
		              <td scope="col">Mailing Address</td>
		              <td scope="col">Physical Address</td>
		              <td scope="col">Approved Programs</td>
		            </tr>
		          </thead>
		          <tbody>
								<?php include('functions.php'); ?>
							</tbody>
						</table>
					</div>
				</div>
				<div style="margin-top: 1%;" class="row">
					<div class="col-md-10">
            <button class="btn btn-outline-warning" type="submit" name="export_csv">Export Selected Records</button>
        	</div>
					<div class="col-md-2">
            <button class="btn btn-outline-success" type="submit" name="export_all_csv">Export All Records</button>
      	</div>
			</div>
		</form>


		</div>
  </body>
  </html>
	<?php

	if(isset($_POST['update_db_submit'])) {
		$all_school_info_SQL = "INSERT INTO BPPE1 (school, phone, school_code, county, mailing_address, physical_address, approved_programs)
														VALUES ('$school_scrape', '$new_phone', '$school_code_scrape', '$county_scrape', '$mailing_address_scrape', '$physical_address_scrape', '$approved_programs_scrape')";
		$all_school_info_Result = mysqli_query($conn, $all_school_info_SQL);
	}

	if(isset($_POST['export_all_csv'])) {
		include('export_all_csv.php');
	}

mysqli_close($conn);
?>
