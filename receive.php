<?php 
include 'db.php';

if (isset($_POST['order'])) {
  /*$order = $_POST['order'];
  $myfile = fopen("order.txt", "a+") or die("Unable to open file!");
  $txt = $order.",";
  fwrite($myfile, $txt);
  fclose($myfile);*/
  $product = $_POST['order'];
  $table = $_POST['table'];
  if (DB::exists($table)) {
    $products = DB::get("SELECT products FROM c_orders where tab = $table")[0]['products'].$product.',';
    DB::query("UPDATE c_orders SET products = '$products' WHERE tab = $table");
    echo "Table [$table] order updated";
  }else {
    DB::query("INSERT INTO c_orders (tab,products) VALUES ($table,'$product,')");
    echo "New [$table] table order saved!";
  }
  //
  die();
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
  <link rel="stylesheet" type="text/css" href="public/bootstrap-3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="public/jquery.min.js"></script>
  <style>
    legend {
        display: block;
        width: auto;
        padding: 0 5px;
        margin-bottom: 0;
        font-size: inherit;
        line-height: inherit;
        border: auto;
        border-bottom: none;
        border-color: #BDBDBD;
    }

    fieldset {
        border: 2px groove threedface;
        padding: 5px;
    }
  </style>
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
      <div class="row actions">
        
      </div>
    </div>
    <!-- <div class="row">
      <div class="container">
        <button class="btn btn-lg btn-info" onclick="clearOrders()"> <span class="glyphicon glyphicon-trash"></span> Clear orders</button>
        <button class="btn btn-lg btn-success pull-right" onclick="checkOrders()"> <span class="glyphicon glyphicon-check"></span> Orders ready! </button> 
        <button class="btn btn-lg btn-default pull-right" onclick="denyOrders() " style="margin-right: 15px"> <span class="glyphicon glyphicon-cross" ></span> Deny orders </button> 
      </div>
    </div> -->
  </div>

</body>
</html>

<script type="text/javascript" src="public/bootstrap-3.3.7/js/bootstrap.min.js"></script>

<script>
  
  var row_order = $('#row_order');
  var row_actions = $('.actions');
  setInterval(function () {
    $.post('data.php', {read: true}, function(data, textStatus, xhr) {
      data = JSON.parse(data);
      console.log(data);
      var result = '';
      if (data !=""){
        for (var i = 0; i < data.length; i++) {
           result += `<fieldset><legend><h4>${data[i].tab}</h4></legend>`;
           
             result += `
                <div class="col-md-3" v-for="o in orders">    
                  <div class="alert alert-info alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
                    <strong>#</strong> ${data[i].products}
                  </div>
              </div>
              </fieldset>
              `;                        
        }
        var actions = `
        <div class="row">
          <div class="container">
            <button class="btn btn-lg btn-info" onclick="clearOrders()"> <span class="glyphicon glyphicon-trash"></span> Clear orders</button>
            <button class="btn btn-lg btn-success pull-right" onclick="checkOrders()"> <span class="glyphicon glyphicon-check"></span> Orders ready! </button> 
            <button class="btn btn-lg btn-default pull-right" onclick="denyOrders() " style="margin-right: 15px"> <span class="glyphicon glyphicon-cross" ></span> Deny orders </button> 
          </div>
        </div>
        `;
      } else result = "# No orders";
      row_order.html(result);
      row_actions.html(actions);
    });
  }, 2000);

  /*$.post('data.php', {read: true}, function(data, textStatus, xhr) {
      console.log(data);
    });*/

  function clearOrders () {
    $.post('data.php', {clear: true}, function(data, textStatus, xhr) {
      console.log(data);
    });
  };

  function checkOrders () {
    $('.alert').removeClass('alert-info alert-warning').addClass('alert-success');
    websocket_server.send(
      JSON.stringify({
        'type':'ordering_status',
        'comming': true,
        'msg': "Comming"
      })
    );
  }

  function denyOrders () {
    $('.alert').removeClass('alert-info alert-success').addClass('alert-warning');
    websocket_server.send(
      JSON.stringify({
        'type':'ordering_status',
        'comming': false,
        'msg': "Products not available at the moment."
      })
    );
  }
  
</script>