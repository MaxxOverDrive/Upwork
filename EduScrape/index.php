<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>School Scraper!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <div class="container">
      <div class="row">
				<div class="col-md-4">

          <form action="index.php" method="POST">
            <div class="form-group">
              <div class="col-md-12 text-center">
                <button class="btn btn-success" type="submit" name="compare_submit">Compare</button>
              </div>
            </div>
          </form>

        </div>

				<div class="col-md-4">

          <form action="index.php" method="POST">
            <div class="form-group">
							<div class="col-md-12 text-center">
								<input type="text" name="user_search">
							</div>
              <div class="col-md-12 text-center">
                <button class="btn btn-info" type="submit" name="search_submit">Search</button>
              </div>
            </div>
          </form>

        </div>

				<div class="col-md-4">

          <form action="export_csv.php" method="POST">
            <div class="form-group">
              <div class="col-md-12 text-center">
                <button class="btn btn-danger" type="submit" name="export_csv">Export CSV</button>
              </div>
            </div>
          </form>

        </div>

        <div style="margin-top: 1%;" class="col-md-12">
          <div style="height: 100%; border: 2px solid grey;">
						<?php include('functions.php'); ?>
          </div>
				</div>
			</div>
		</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
  </html>
