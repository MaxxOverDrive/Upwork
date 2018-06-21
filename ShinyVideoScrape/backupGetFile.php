
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


					<div class="form-group">
						<div class="col-md-1">
								<select class="form-control form-control-sm">
									<option>10</option>
									<option>25</option>
									<option>50</option>
									<option>100</option>
								</select>
						</div>
					</div>

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

							$row = 1;
								if (($search_handle = fopen("TestTable.csv", "r")) !== FALSE) {
									while (($data = fgetcsv($search_handle, 1000, ",")) !== FALSE) {
										$num = count($data);
										$row++;

										echo '<tr>';
										for ($c=0; $c < $num; $c++) {
												echo '<td scope="col">' . $data[$c] . '</td>';

										}
										echo '</tr>';
									}
								fclose($search_handle);
								}
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

							$row = 1;
								if (($handle = fopen("TestTable.csv", "r")) !== FALSE) {
									while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
										$num = count($data);
										$row++;
										echo '<tr>';
										for ($c=0; $c < $num; $c++) {
												echo '<td scope="col">' . $data[$c] . '</td>';

										}
										echo '</tr>';
									}
								fclose($handle);
								}
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

							$row = 1;
								if (($url_match = fopen("TestTable.csv", "r")) !== FALSE) {
									while (($data_match = fgetcsv($url_match, 1000, ",")) !== FALSE) {
										$num_match = count($data_match);
										$row++;
										for ($c=4; $c < $num_match; $c++) {
												$data_check_array[] = $data_match[$c];
										}
									}
									if(in_array($_POST['youtube_link'], $data_check_array)) {
										echo "This URL already exists!";
									}
									else {
										$infoCheck = file_get_contents('TestTable.csv');
										$video_info = $_POST['artist_name'];
										$channel_name = $_POST['channel_name'];
										$song_name = $_POST['song_name'];
										$video_desc = $_POST['video_desc'];
										$youtube_link = $_POST['youtube_link'];
										$info_array_temp = implode(',', array($video_info, $channel_name, $song_name, $video_desc, $youtube_link));
										$infoArray = $info_array_temp.PHP_EOL;
										file_put_contents('TestTable.csv', $infoArray, FILE_APPEND | LOCK_EX);
										header('location: index.php');
									}
								fclose($url_match);
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
