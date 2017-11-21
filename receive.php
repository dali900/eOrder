<?php 
include 'core/init.php';

$orders = DB::get();

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
  <link rel="stylesheet" type="text/css" href="public/bootstrap-3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="public/jquery.min.js"></script>

 <title>Sank</title>
</head>
<body>

  <div class="container">
    <div class="well "  style="margin-top:10px">
      <h3>Orders:</h3>
      <div class="row" id="row_order"> <span id="checking">Checking orders...</span>
        <!-- <div class="col-md-3 " v-for="o in orders">    
          <div class="alert alert-info alert-dismissible" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
            <strong id="order_product">#</strong>
          </div>
        </div> -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <button class="btn btn-lg btn-info" onclick="clearOrders()"> <span class="glyphicon glyphicon-trash"></span> Clear orders</button>
        <button class="btn btn-lg btn-success pull-right" onclick="checkOrders()"> <span class="glyphicon glyphicon-check"></span> Orders ready! </button> 
        <button class="btn btn-lg btn-default pull-right" onclick="denyOrders() " style="margin-right: 15px"> <span class="glyphicon glyphicon-cross" ></span> Deny orders </button> 
      </div>
    </div>

  </div>

</body>
</html>

<script type="text/javascript" src="public/bootstrap-3.3.7/js/bootstrap.min.js"></script>

<script>
  
      $.post('data.php', {read: true}, function(data) {
        console.log(JSON.parse(data));
        // Ucitava porudzbine iz baze
        //loadOrders(data);
      });
      // Websocket
      var websocket_server = new WebSocket("ws://localhost:8080/");
      websocket_server.onopen = function(e) {
        websocket_server.send(
          JSON.stringify({
            'type':'socket',
            'user_id': 'STUFF'
          })
        );
      };
      websocket_server.onerror = function(e) {
        // Errorhandling
      }
      websocket_server.onmessage = function(e)
      {
        handleOrder(e);
      }
      // Events
      /*$('#chat_input').on('keypress',(function(event) {
        websocket_server.send(
            JSON.stringify({
              'type':'typing',
              'user_id':<?=$session?>
            })
          );
      }))*/

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

      function handleOrder (e) {
        var json = JSON.parse(e.data);
        var row_order = $('#row_order');
        var product_item = `
        <div class="col-md-3 " v-for="o in orders">    
          <div class="alert alert-info alert-dismissible" role="alert" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
            <strong id="order_product">#</strong> ${json.product} (Table: ${json.table})
          </div>
        </div>`;
        switch(json.type) {
          case 'order':
              row_order.find('#checking').remove();
              row_order.append(product_item);
            console.log(json);
            break;

          case 'dsconn':
            $('#chat_output').append(json.msg);
            break;
        }
      }

      function loadOrders (data) {
        var json = JSON.parse(data);
        var row_order = $('#row_order');
        row_order.find('#checking').remove();
        for (var i = 0; i < json.length; i++) {
          for (var j = 0; j < json[i].products.length; j++) {
            var product_item = `
            <div class="col-md-3 " v-for="o in orders">    
              <div class="alert alert-info alert-dismissible" role="alert" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
                <strong id="order_product">#</strong> ${json[i].products[j].name}
              </div>
            </div>`;

            row_order.append(product_item);
            
          }
        }
      }


</script>