<?php 
include 'core/init.php';

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
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
  
  var row_order = $('#row_order');
  var row_actions = $('.actions');
  getOrders();

  
  var pusher = new Pusher('47588a2db3baf0214bef', {
      cluster: 'eu'
    });
     var channel = pusher.subscribe('ch1');
     channel.bind('ev1', function(data) {
      console.log('PUSHER: ' + data.message);
      getOrders();     
  });

  // Ucitavanje porudzbine
  function getOrders () {
    $.post('data.php', {read: true}, function(data, textStatus, xhr) {
      data = JSON.parse(data);
      console.log(data);
      var result = '';
      if (data !=""){
        for (var i = 0; i < data.length; i++) {
           result += `<fieldset><legend><h4>Table: ${data[i].tab}</h4></legend>`;
            var products_list = data[i].products;
            for (var j = 0; j < products_list.length; j++) {

             result += `
                <div class="col-md-3" v-for="o in orders">    
                  <div class="alert alert-info alert-dismissible" role="alert" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
                    <strong>#</strong> ${products_list[j].name}, Kolicina: ${products_list[j].quantity}
                   , cena: ${products_list[j].price}
                  </div>
              </div>
              `;       
           }  
           result += `
            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-lg btn-info" onclick="clearOrders(${data[i].tab})"> <span class="glyphicon glyphicon-trash"></span> Clear orders</button>
                <button class="btn btn-lg btn-success pull-right" onclick="checkOrders()"> <span class="glyphicon glyphicon-check"></span> Orders ready! </button> 
                <button class="btn btn-lg btn-default pull-right" onclick="denyOrders() " style="margin-right: 15px"> <span class="glyphicon glyphicon-cross" ></span> Deny orders </button> 
              </div>
            </div>
           </fieldset>`;               
        }
        
      } else result = "# No orders";
      row_order.html(result);
    }); 
  }

  // Brisanje odredjene porudzbine
  function clearOrders (table) {
    $.post('data.php', {clear: true, table: table}, function(data, textStatus, xhr) {
      console.log(data);
    });
    getOrders();
  };

  function checkOrders () {
    $('.alert').removeClass('alert-info alert-warning').addClass('alert-success');
  }

  function denyOrders () {
    $('.alert').removeClass('alert-info alert-success').addClass('alert-warning');
  }
  
</script>