<template>

	<div class="container" >
		<div class="row ">
			<div class="col-md-12">
				<h3 class="pull-left"><a href="index.php" title="eOrder" id="logo">e order <img src="public/img/menu.png"></a></h3>
				<div class="pull-right " style="margin-top: 20px; " >
					Table: <input type="text" v-model="table" style="width: 40px">
					<button v-on:click="checkIn()">Check in</button>
				</div>
			</div>		
		</div>
		
		<div class="row order_row">
		
			<div class="col-md-3 ">
				<div class="dropdown">
					<button class="dropbtn dropdown-toggle" id="drink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Drinks <img src="public/img/cocktail.png"></button>
					<ul class="dropdown-menu" id="drinksc" aria-labelledby="drink">
					    <li><a href="#" v-on:click="order('Beer')">Beer</a> </li>
					    <li><a href="#" v-on:click="order('Vine')">Vine</a></li>
					    <li><a href="#" v-on:click="order('Vodka')">Vodka</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-3" id="food">
				<div class="dropdown">
					<button class="dropbtn dropdown-toggle" id="food" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Food <img src="public/img/food.png"></button>
					<ul class="dropdown-menu" aria-labelledby="food">
					    <li><a href="#" v-on:click="order('Pasta')">Pasta</a> </li>
					    <li><a href="#" v-on:click="order('Pizza')">Pizza</a></li>
					    <li><a href="#" v-on:click="order('Burger')">Burger</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-3" id="ice">
				<div class="dropdown">
					<button class="dropbtn dropdown-toggle" id="ice" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ice cream <img src="public/img/ice-cream.png"></button>
					<ul class="dropdown-menu" aria-labelledby="ice">
					    <li><a href="#" v-on:click="order('Ice cream 1')">Ice cream 1</a> </li>
					    <li><a href="#" v-on:click="order('Ice cream 2')">Ice cream 2</a></li>
					    <li><a href="#" v-on:click="order('Ice cream 3')">Ice cream 3</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-3" id="cakes">
				<div class="dropdown">
					<button class="dropbtn dropdown-toggle" id="cakes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cakes <img src="public/img/cake.png"></button>
					<ul class="dropdown-menu" aria-labelledby="cakes">
					    <li><a href="#" v-on:click="order('Cake 1')">Cake 1</a> </li>
					    <li><a href="#" v-on:click="order('Cake 2')">Cake 2</a></li>
					    <li><a href="#" v-on:click="order('Cake 3')">Cake 3</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="well " id="user_orders" v-bind:class="{hidden: orderHide}" style="margin-top:10px">
			<h3>Your orders:</h3>
			<div class="row" >
				<div class="col-md-3" v-for="o in orders">		
					<div class="alert alert-info alert-dismissible" role="alert" >
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
					  <strong>#</strong> {{o}}
					</div>
				</div>
			</div>
			<div class="row hidden" id="order_status">		
				<div class="alert alert-success alert-dismissible" role="alert" >
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" style="font-size: 30px">&times;</span></button>
				  <strong id="order_msg"># Your order is comming!</strong> 
				</div>		
			</div>
		</div>

	<div style="position: relative; margin-top: 50px">
		<a href="receive.php" title="" style="bottom: 0;position: absolute;">Sank</a>
	</div>



	</div>

</template>

<script>
export default {

  data () {
    return {
    	orderHide: true,
      orders: [],
      table: 0,
      pusher: null
    }
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
    },
    
  },
  mounted(){
  	/*this.$echo.channel('ch1').listen('ev1', (payload) => {
      console.log("PUSHER ECHO::::: "+payload.message);
    });*/
  	var pusher = new Pusher('47588a2db3baf0214bef', {
      cluster: 'eu'
    });
     var channel = pusher.subscribe('ch1');
     channel.bind('ev1', function(data) {
      console.log('PUSHER: ' + data.message);
    });
  }


}
</script>

<style lang="css" scoped>
</style>