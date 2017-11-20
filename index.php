
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>e order</title>

	<link rel="stylesheet" type="text/css" href="public/bootstrap-3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/style.css">
	<script type="text/javascript" src="public/jquery.min.js"></script>
	<script src="public/user_websocket.js"></script>
	<script src="public/vue.js"></script>
	<script>
		
	</script>
</head>
<body>

<div class="container" id="vue-app">
	<div class="row ">
		<div class="col-md-12">
			<h3 class="pull-left">e order <img src="public/img/menu.png"></h3>
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

<script type="text/javascript" src="public/bootstrap-3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

<script type="text/javascript" src="public/vueorder.js"></script>
<script type="text/javascript" src="public/script.js"></script>