/* Vue JS aplikacija */
// Salnje porudzubine na websocket server i prikaz iste
new Vue({
  el: "#vue-app",
  data: {
    orderHide: true,
    orders: [],
    table: null
  },
  methods: {
    //Salje porudzbinu (pojedinacno svaki proizvod) na svaki klik
    order: function (product) {
      this.orders.push(product);
      websocket_server.send(
          JSON.stringify({
            'type':'order',
            'table': this.table,
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
    },
    checkIn: function () {
      console.log(this.table);
      $.post('data.php', {table: this.table}, function(data) {
        console.log(data);
      });
    }

  }
})