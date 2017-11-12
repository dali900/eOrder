
      var typing = {status: false, time:0, prev:0};
      // Websocket
      var websocket_server = new WebSocket("ws://localhost:8080/");
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
      websocket_server.onmessage = function(e)
      {
        var json = JSON.parse(e.data);
        var order_status = $('#order_status');
        switch(json.type) {
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

          case 'dsconn':
            $('#chat_output').append(json.msg);
            break;

        }
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
