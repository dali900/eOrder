  new Vue({
    el: "#vue-app",
    data: {
      orderHide: true,
      orders: []
    },
    methods: {
      order: function (product) {
        this.orders.push(product);
        websocket_server.send(
            JSON.stringify({
              'type':'order',
              'product':product,
              'user_id':'TESTING'
            })
          );
        this.showOrder();
        /*$.post('receive.php', {order: product}, function(data, textStatus, xhr) {
          console.log(data);
        });*/
      },
      showOrder: function () {
        this.orderHide = false;
      }
    }
  })