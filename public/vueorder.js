  new Vue({
    el: "#vue-app",
    data: {
      orderHide: true,
      orders: [],
      table: 0
    },
    methods: {
      order: function (product) {
        this.orders.push(product);
        // Uzima id stola
        $.post('data.php', {get_table: true}, function(data, textStatus, xhr) {
          this.table = JSON.parse(data).table;
          console.log(this.table);
        });
        websocket_server.send(
            JSON.stringify({
              'type':'order',
              'product':product,
              'user_id':'TESTING',
              'table': this.table
            })
          );
        this.showOrder();
        /*$.post('receive.php', {order: product}, function(data, textStatus, xhr) {
          console.log(data);
        });*/
      },
      showOrder: function () {
        this.orderHide = false;
      },
      checkIn: function () {
        console.log(this.table);
        $.post('data.php', {table: this.table}, function(data, textStatus, xhr) {
          console.log(data);
        });
      }
    }
  })