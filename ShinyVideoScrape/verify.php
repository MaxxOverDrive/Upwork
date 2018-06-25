
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Shiny Scraper!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container">
      <div class="row">
				<div class="col-md-12">

					<div class="col-md-5 col-md-offset-7">
						<h3 class="text-center">Search Table</h3>
						<form class="form-inline" id="search_form" ation="index.php" method="POST">

							<div class="form-group">
								<div class="col-md-12">

									<div class="col-md-6">

										<input type="text" name="user_input">

									</div>

									<div class="col-md-2">

										<button class="btn btn-light" type="submit" name="user_search_submit">Search</button>

									</div>
								</div>
							</div>

						</form>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">

					<form action="verify.php" method="POST">
	          <table class="table table-striper table-hover dataTable">
	            <thead style="font-weight: bold; font-size: 115%;" class="text-center">
	              <tr>
	                <td scope="col">Artist Name</td>
	                <td scope="col">Channel Name</td>
	                <td scope="col">Song Name</td>
	                <td scope="col">Video Description</td>
	                <td scope="col">YouTube Link</td>
	              </tr>
	            </thead>
	            <tbody>
							<?php

									include('verify_conn.php');

									$tableVar = $GLOBALS['tableResult']; ?>

									<?php

									while($tableRow = mysqli_fetch_assoc($tableVar)) { ?>
												<tr>
													<td scope="col"><input type="checkbox" class="form-check-input" name="verify" value="<?php echo $tableRow['id']; ?>"></td>
					                <td scope="col"><?php echo $tableRow['artist_name']; ?></td>
					                <td scope="col"><?php echo $tableRow['channel_name']; ?></td>
					                <td scope="col"><?php echo $tableRow['song_name']; ?></td>
					                <td scope="col"><?php echo $tableRow['video_desc']; ?></td>
					                <td scope="col"><a href="<?php echo $tableRow['youtube_link']; ?>"><?php echo $tableRow['youtube_link']; ?></a></td>
					              </tr>

								<?php	} ?>

	            </tbody>
	          </table>
						<button type="submit" class="btn btn-primary" name="submit_verify">Submit</button>
					</form>
					<?php

					if(isset($_POST['submit_verify'])) {
						$verify = $_POST['verify'];
						if(empty($verify)) {
							echo("You didn't select any videos.");
						}

						else {
							include('verifyConn2.php');

						}



					}

					?>

				</div>
			</div>
		</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
  </html>
