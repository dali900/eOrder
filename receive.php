<?php 

if (isset($_POST['order'])) {
  $order = $_POST['order'];
  $myfile = fopen("order.txt", "a+") or die("Unable to open file!");
  $txt = $order.",";
  fwrite($myfile, $txt);
  fclose($myfile);
}



/*$myfile = fopen("order.txt", "a+") or die("Unable to open file!");
$txt = "Beer";
fwrite($myfile, $txt);
fclose($myfile);*/


 ?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
 <title>Sank</title>
</head>
<body>

  <div class="container">
    <div class="well "  style="margin-top:10px">
      <h3>Orders:</h3>
      <div class="row" id="row_order"> Checking orders...
        <!-- <div class="col-md-3" v-for="o in orders">    
          <div class="alert alert-info alert-dismissible" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
            <strong>#</strong> Product
          </div>
        </div> -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <button class="btn btn-lg btn-info" onclick="clearOrders()"> <span class="glyphicon glyphicon-trash"></span> Clear orders</button>
      </div>
    </div>
  </div>

</body>
</html>

<script type="text/javascript" src="bootstrap-3.3.7/js/bootstrap.min.js"></script>

<script>
  

  setInterval(function () {
    $.post('data.php', {read: true}, function(data, textStatus, xhr) {
      data = JSON.parse(data);
      console.log(data);
      var result = '';
      if (data !="")
      for (var i = 0; i < data.length; i++) {
        result += `
            <div class="col-md-3" v-for="o in orders">    
              <div class="alert alert-info alert-dismissible" role="alert" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
                <strong>#</strong> ${data[i]}
              </div>
          </div>
          `   
      }
      else result = "# No orders";
      $('#row_order').html(result);
    });
  }, 2000);

  /*$.post('data.php', {read: true}, function(data, textStatus, xhr) {
      console.log(data);
    });*/

  function clearOrders () {
    $.post('data.php', {clear: true}, function(data, textStatus, xhr) {
      console.log(data);
    });
  }
  
</script>