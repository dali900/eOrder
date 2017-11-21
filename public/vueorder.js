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

        this.showOrder();
        // Salje porudzbinu
        $.post('data.php', {order: product, table: this.table}, function(data, textStatus, xhr) {
          console.log(data);
        });
      },
      showOrder: function () {
        this.orderHide = false;
      },
      // Check in gosta za odredjeni sto
      checkIn: function () {
        console.log(this.table);
        $.post('data.php', {table: this.table}, function(data, textStatus, xhr) {
          console.log(data);
        });
      }
    }
  })