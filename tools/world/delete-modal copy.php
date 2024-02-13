
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
          <p>Entry successfully deleted.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  
<?php  $footpath = $_SERVER['DOCUMENT_ROOT'];
  $footpath .= "/footer.php";
  include_once($footpath);
  ?>
