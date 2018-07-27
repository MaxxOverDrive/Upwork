<div class="container">
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


        //$user_input = unpack('H*', "Better");
        //echo base_convert($user_input[1], 16, 2) . "<br />";

        //echo pack('H*', base_convert('10000100110010101110100011101000110010101110010', 2, 16)) . "<br />";



        include('search_conn.php');

        $searchVar = $GLOBALS['searchResult'];

        while($tableRow = mysqli_fetch_assoc($searchVar)) {
          $artist_name[] = $tableRow['artist_name'];
          $channel_name[] = $tableRow['channel_name'];
          $song_name[] = $tableRow['song_name'];
          $video_desc[] = $tableRow['video_desc'];
          $youtube_link[] = $tableRow['youtube_link'];
        }

        for($i = 0; $i <= 5; $i++) {
          $artistName = unpack('H*', $artist_name[$i]);
          $channelName = unpack('H*', $channel_name[$i]);
          $songName = unpack('H*', $song_name[$i]);
          $videoName = unpack('H*', $video_desc[$i]);
          $youtubeLink= unpack('H*', $youtube_link[$i]);

      ?>

                <tr>
                  <td scope="col"><?php echo base_convert($artistName[1], 16, 2); ?></td>
                  <td scope="col"><?php echo base_convert($channelName[1], 16, 2); ?></td>
                  <td scope="col"><?php echo base_convert($songName[1], 16, 2); ?></td>
                  <td scope="col"><?php echo base_convert($videoName[1], 16, 2); ?></td>
                  <td scope="col"><a href="<?php echo $youtube_link[$i]; ?>"><?php echo base_convert($youtubeLink[1], 16, 2); ?></a></td>
                </tr>
                <tr>
                  <td scope="col"><?php echo base_convert($artistName[1], 16, 2); ?></td>
                  <td scope="col"><?php echo base_convert($channelName[1], 16, 2); ?></td>
                  <td scope="col"><?php echo base_convert($songName[1], 16, 2); ?></td>
                  <td scope="col"><?php echo base_convert($videoName[1], 16, 2); ?></td>
                  <td scope="col"><a href="<?php echo $youtube_link[$i]; ?>"><?php echo base_convert($youtubeLink[1], 16, 2); ?></a></td>
                </tr>

        <?php	} ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
