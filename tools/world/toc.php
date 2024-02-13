<div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">
  <h1 class="pagetitle">World Building</h1>
<div class ="body bodytext">
  <div class="row">
  <div class="col-md-4" style="text-align:center;"><a class="col-centered" href="/tools/world/import.php">Import</a></div>
  <div class="col-md-4" style="text-align:center;"><a class="col-centered" href="/tools/world/upload.php">Upload</a></div>
  <div class="col-md-4" style="text-align:center;"><a class="col-centered" href="/tools/world/map.php">World Map</a></div>
</div>
      <div class="toc bodytext">

      <!-- location -->
      <div class="tocitem col-md-3">
        <a href="location.php"><h2>Locations</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%location%' LIMIT 5";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- Factions -->
      <div class="tocitem col-md-3">
        <a href="faction.php"><h2>Factions</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%faction%' LIMIT 5";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- NPCs -->
      <div class="tocitem col-md-3">
        <a href="npc.php"><h2>NPCs</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%npc%' LIMIT 5";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- Deities -->
      <div class="tocitem col-md-3">
        <a href="deity.php"><h2>Deities</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%deity%' LIMIT 5";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- Quests -->
      <div class="tocitem col-md-3">
        <a href="quest.php"><h2>Quests</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%quest%' LIMIT 5";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <!-- NPCs -->
      <div class="tocitem col-md-3">
        <a href="establishment.php"><h2>Establishments</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%establishment%' LIMIT 5";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      <div class="tocitem col-md-3">
        <a href="publicquest.php"><h2>Public Quests</h2></a>
      <?php
        $sqlworld = "SELECT * FROM world WHERE type LIKE '%public quest%' LIMIT 5";
        $worlddata = mysqli_query($dbcon, $sqlworld) or die('error getting data');
        while($row = mysqli_fetch_array($worlddata, MYSQLI_ASSOC)) {
        $entry = $row['title'];
        echo "<a href=\"world.php?id=$entry\">";
        echo $entry;
        echo "</a>";
        echo "<br>";
      }
        ?>
      </div>

      </div>
  </div>
</div>
