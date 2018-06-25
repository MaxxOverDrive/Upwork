
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

									<div class="col-md-7">

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

								if(isset($_POST['user_input'])) {

									$user_input = $_POST['user_input'];

										include('search_conn.php');
										$searchVar = $GLOBALS['searchResult'];

										while($searchRow = mysqli_fetch_assoc($searchVar)) {

											$artist_name[] = $searchRow['artist_name'];
											$channel_name[] = $searchRow['channel_name'];
											$song_name[] = $searchRow['song_name'];
											$video_desc[] = $searchRow['video_desc'];
											$youtube_link[] = $searchRow['youtube_link'];
										}

										for($i = 0; $i <= COUNT($youtube_link); $i++) {

											if(strpos($artist_name[$i], $user_input) || strpos($channel_name[$i], $user_input) || strpos($song_name[$i], $user_input) || strpos($video_desc[$i], $user_input) || strpos($youtube_link[$i], $user_input) === true) { ?>
													 <tr>
														 <td scope="col"><?php echo $artist_name[$i]; ?></td>
														 <td scope="col"><?php echo $channel_name[$i]; ?></td>
														 <td scope="col"><?php echo $song_name[$i]; ?></td>
														 <td scope="col"><?php echo $video_desc[$i]; ?></td>
														 <td scope="col"><?php echo $youtube_link[$i]; ?></td>
													 </tr>

											 <?php
											}
											else {
												continue;
											}
										}

								}

								else {

												include('table_conn.php');

												$tableVar = $GLOBALS['tableResult'];

												while($tableRow = mysqli_fetch_assoc($tableVar)) { ?>
																<tr>
									                <td scope="col"><?php echo $tableRow['artist_name']; ?></td>
									                <td scope="col"><?php echo $tableRow['channel_name']; ?></td>
									                <td scope="col"><?php echo $tableRow['song_name']; ?></td>
									                <td scope="col"><?php echo $tableRow['video_desc']; ?></td>
									                <td scope="col"><a href="<?php echo $tableRow['youtube_link']; ?>"><?php echo $tableRow['youtube_link']; ?></a></td>
									              </tr>

												<?php	}
						}	?>

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
