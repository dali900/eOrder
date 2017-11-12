  new Vue({
    el: "#vue-app",
    data: {
      orderHide: true,
      orders: []
    },
    methods: {
      order: function (product) {
        this.orders.push(product);
        this.showOrder();
        $.post('receive.php', {order: product}, function(data, textStatus, xhr) {
          console.log(data);
        });
      },
      showOrder: function () {
        this.orderHide = false;
      }
    }
  })