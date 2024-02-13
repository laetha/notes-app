<!-- <div class="mainbox col-md-12">
  <h1 class="pagetitle"><?php echo $name; ?> successfully added!</h1>
  <div class="menu">
    <a class="menulink" href="compendium.php?id=<?php echo $name; ?>">><div class="menuitem">
      <h3>View <?php echo $name; ?> page</h3>
    </div></a>
    <a class="menulink" href="/tools/compendium/import.php"><div class="menuitem">
      <h3>Add another entry</h3>
    </div></a>
  </div>
</div> -->

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
          <a href="compendium.php?id=<?php echo $name; ?>" class="btn btn-info" href>View <strong><?php echo $name; ?></strong> Page</a>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Add another page</button>
        </div>
      </div>

    </div>
  </div>
<?php  $footpath = $_SERVER['DOCUMENT_ROOT'];
  $footpath .= "/footer.php";
  include_once($footpath);
  ?>
