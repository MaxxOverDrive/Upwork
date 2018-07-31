<?php

  if(isset($_POST['compare_submit'])) {
    include('allSchoolMain.php');
    if(mysqli_affected_rows($conn) > 0) {
      echo "<h4>" . $newSchool . " School details have been changed</h4>";
      echo "<h4>" . $newPhoneNumber . " New phone numbers</h4>";
      echo "<h4>" . $newCounty . " New counties</h4>";
      echo "<h4>" . $newMailingAddress . " New mailing addresses</h4>";
      echo "<h4>" . $newPhysicalAddress . " New physical addresses</h4>";
      echo "<h4>" . $new_approved_program . " New approved programs</h4>";
      echo "<h4>" . $same_school . " Schools remained the same</h4>";
      echo "<h4>" . $total . " Schools checked</h4>";
    }
    else {
      echo "No info has been entered";
    }
  }//END IF ISSET

  if(isset($_POST['export_all_csv'])) {
    //header('location: export_all_csv.php');
    include('export_all_csv.php');
  }


  if(isset($_POST['update_db_submit'])) {
		$all_school_info_SQL = "INSERT INTO BPPE1 (school, phone, school_code, county, mailing_address, physical_address, approved_programs)
														VALUES ('$school_scrape', '$new_phone', '$school_code_scrape', '$county_scrape', '$mailing_address_scrape', '$physical_address_scrape', '$approved_programs_scrape')";
		$all_school_info_Result = mysqli_query($conn, $all_school_info_SQL);
	}


?>
