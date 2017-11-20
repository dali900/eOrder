// Websocket
var websocket_server = new WebSocket("ws://localhost:8080/");
// Uspostavljanje weze sa websocket serverom
websocket_server.onopen = function(e) {
  websocket_server.send(
    JSON.stringify({
      'type':'socket',
      'user_id': 'TESTING'
    })
  );
};

websocket_server.onerror = function(e) {
  // Errorhandling
}

//Server salje podatke korisniku
websocket_server.onmessage = function(e)
{
  // Json parsiranje podataka
  var json = JSON.parse(e.data);
  var order_status = $('#order_status');
  switch(json.type) {
    //Upravljanje primljenom porukom 
    case 'ordering_status':
      if (json.comming) {
        order_status.removeClass('hidden');
        order_status.find('.alert').removeClass('alert-warning').addClass('alert-success');
        order_status.find('#order_msg').html('# Your order is comming!');
      } else {
        order_status.removeClass('hidden');
        order_status.find('.alert').removeClass('alert-success').addClass('alert-warning');
        order_status.find('#order_msg').html(json.msg);
      }
      console.log(json);
      break;
  }
}

