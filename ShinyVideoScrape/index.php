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
          <table class="table">
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
              <tr>
                <td>Artist</td>
                <td>Channel</td>
                <td>Song</td>
                <td>Description</td>
                <td>Link</td>
              </tr>
              <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
              </tr>
            </tbody>
          </table>


          <form action="index.php" method="POST">

            <div class="form-group">
              <div class="col-md-12">

                <table class="table">
                  <tbody>
                    <tr>
                      <td scope="col"><input type="text" name="video_info" placeholder="Artist Name"></td>
                      <td scope="col"><input type="text" name="video_info" placeholder="Channel Name"></td>
                      <td scope="col"><input type="text" name="video_info" placeholder="Song Name"></td>
                      <td scope="col"><input type="text" name="video_info" placeholder="Video Description"></td>
                      <td scope="col"><input type="text" name="video_info" placeholder="YouTube Link"></td>
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
            if(isset($_POST['video_info'])) {
              $video_info_temp = $_POST['video_info'];
              $video_info = $video_info_temp.PHP_EOL;
              file_put_contents('video_info.csv', $video_info, FILE_APPEND | LOCK_EX);
            }
          ?>

				</div>
			</div>
		</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
  </html>
