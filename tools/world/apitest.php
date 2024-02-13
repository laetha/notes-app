<?php
  //SQL Connect
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/sql-connect.php";
   include_once($sqlpath);

   //Header
   $pgtitle = '';
   $headpath = $_SERVER['DOCUMENT_ROOT'];
   $headpath .= "/header.php";
   include_once($headpath);
   /* if ($loguser !== 'tarfuin') {
   echo ('<script>window.location.replace("/oops.php"); </script>');
 }*/
   ?>
   <?php
   $sqlpath = $_SERVER['DOCUMENT_ROOT'];
   $sqlpath .= "/plugins/Parsedown.php";
   include_once($sqlpath);
    ?>
    <?php  $Parsedown = new Parsedown();
    ?>
   <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js" type="text/javascript"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js" type="text/javascript"></script>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">
   <script type="text/javascript" src="/apikey.js"></script> 

   <div class="mainbox col-lg-10 col-xs-12 col-lg-offset-1">

     <div class="col-md-12">
  <?php
  $id = $_GET['id'];
  $stripid = str_replace("'", "", $id);
  $stripid = stripslashes($stripid);
  $id = addslashes($id);
  ?>
     <div class="pagetitle" id="pgtitle">API Test</div>
     <div class="sidebartext col-md-8" id="test">aaa</div>
     <div class="sidebartext col-md-4" style="text-align:center;" id="test2">bbb</div>

     
<script>
var gameInfo;
var gamePoster;
    /* aaaaa
 *  Send a get request to the Giant bomb api.
 *  @param string resource set the RESOURCE.
 *  @param object data specifiy any filters or fields.
 *  @param object callbacks specify any custom callbacks.
 */
function sendRequest(resource, data, callbacks) {
    var baseURL = 'http://giantbomb.com/api';
    var apiKey = GBKey;
    var format = 'jsonp';

    // make sure data is an empty object if its not defined.
    data = data || {};

    // Proccess the data, the ajax function escapes any characters like ,
    // So we need to send the data with the "url:"
    var str, tmpArray = [], filters;
    $.each(data, function(key, value) {
        str = key + '=' + value;
        tmpArray.push(str);
    });

    // Create the filters if there were any, else it's an empty string.
    filters =  (tmpArray.length > 0) ? '&' + tmpArray.join('&') : '';

    // Create the request url.
    var requestURL = baseURL + resource + "?api_key=" + apiKey + "&format=" + format + filters;

    // Set custom callbacks if there are any, otherwise use the default onces.
    // Explanation: if callbacks.beforesend is passend in the argument callbacks, then use it. 
    // If not "||"" set an default function.
    var callbacks = callbacks || {};
    callbacks.beforeSend = callbacks.beforeSend || function(response) {};
    callbacks.success = callbacks.success || function(response) {};
    callbacks.error = callbacks.error || function(response) {};
    callbacks.complete = callbacks.complete || function(response) {};

    // the actual ajax request
    $.ajax({
                    url: requestURL,
                    dataType: "jsonp",
                    jsonp: 'json_callback',
                    format: 'jsonp',
                    success: function(res) {
                      gameTitle = JSON.stringify(res.results.name);
                      gameAlias = JSON.stringify(res.results.aliases);
                      gameDeck = JSON.stringify(res.results.deck);
                      gameImage = JSON.stringify(res.results.image.medium_url);
                        $('#pgtitle').html(gameTitle);
                        $('#test').html(gameDeck);
                        $('#test2').html('<img src=' + gameImage + ' height="300px" />');

                    }
                });
}
$(document).ready(function(){
  
 // get game id from somewhere like a link.
 var gameID = '<?php echo $id; ?>';
    var resource = '/game/' + gameID;

    // Set the fields or filters 
    var data = {
        field_list: 'name,deck,image,aliases'
    };

    // No custom callbacks defined here, just use the default onces.
    sendRequest(resource, data);


});
</script>
</div>
   <?php
   //Footer
   $footpath = $_SERVER['DOCUMENT_ROOT'];
   $footpath .= "/footer.php";
   include_once($footpath);
    ?>
