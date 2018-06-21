
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

					<form ation="index.php" method="POST">
						<div class="form-group">
							<div class="col-md-4 col-md-offset-7">
								<input type="text" name="user_search">
								<button class="btn btn-light" type="submit" name="submit_search">Search</button>
							</div>
						</div>
					</form>
					<?php
						if(isset($_POST['submit_search'])) {
							$user_search = $_POST['user_search'];
							include('db_conn.php');

						}
					?>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
          <table class="table table-striper table-hover dataTable">
            <thead>
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
								include('db_conn.php');
								$tableVar = $GLOBALS['tableResult'];

								while($tableRow = mysqli_fetch_assoc($tableVar)) { ?>
									<tr>
		                <td scope="col"><?php echo $tableRow['artist_name']; ?></td>
		                <td scope="col"><?php echo $tableRow['channel_name']; ?></td>
		                <td scope="col"><?php echo $tableRow['song_name']; ?></td>
		                <td scope="col"><?php echo $tableRow['video_desc']; ?></td>
		                <td scope="col"><?php echo $tableRow['youtube_link']; ?></td>
		              </tr>

								<?php	}
								?>

            </tbody>
          </table>


          <form action="index.php" method="POST">

            <div class="form-group">
              <div class="col-md-12">

                <table class="table">
                  <tbody>
                    <tr>
                      <td scope="col"><input type="text" name="artist_name" placeholder="Artist Name"></td>
                      <td scope="col"><input type="text" name="channel_name" placeholder="Channel Name"></td>
                      <td scope="col"><input type="text" name="song_name" placeholder="Song Name"></td>
                      <td scope="col"><input type="text" name="video_desc" placeholder="Video Description"></td>
                      <td scope="col"><input type="text" name="youtube_link" placeholder="YouTube Link"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12 text-center">
                <button class="btn btn-success" type="submit" name="submit_video_info">Submit</button>
              </div>
            </div>

          </form>

          <?php
            if(isset($_POST['submit_video_info'])) {
							include('formSubmit.php');



            }
          ?>

				</div>
			</div>
		</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
  </html>
