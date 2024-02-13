
<?php
$headpath = $_SERVER['DOCUMENT_ROOT'];
$headpath .= "/header.php";
include_once($headpath);
?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content modalstyle bodytext">

        <div class="modal-body">
          <p><?php echo $name; ?> page successfully created.</p>
        </div>
        <div class="modal-footer">
          <a href="/tools/compendium/compendium.php?id=<?php echo $name; ?>" class="btn btn-info" href>View <strong><?php echo $name; ?></strong> Page</a>
          <a href="dbimport.php"><button type="button" class="btn btn-primary">Add another page</button></a>
        </div>
      </div>

    </div>
  </div>
<?php  $footpath = $_SERVER['DOCUMENT_ROOT'];
  $footpath .= "/footer.php";
  include_once($footpath);
  ?>
