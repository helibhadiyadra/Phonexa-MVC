// document.ready() Event
$(document).ready(function(){

// BRAND FILTER -> change() Event

$("#brandFilter").change(function(){

let brand_id = $(this).val();

$.ajax({

url:"/Phonexa-MVC/FilterBrand",
method:"POST",

data:{
brand_id:brand_id
},

success:function(response){

let products = JSON.parse(response);

let html="";

products.forEach(product=>{

html+=`
<div class="product-card">

<h4>${product.name}</h4>

<p style="font-size: 16px">${product.description}</p>

<p>${product.price}</p>

<img src="/Phonexa-MVC/public/uploads/${product.image}" width="120">

</div>
`;

});

$("#productContainer").html(html);

}

});

});

// SEARCH BRAND -> click() Event

$("#searchBtn").click(function(){

let brand=$("#brandSearch").val();

$.ajax({

url:"/Phonexa-MVC/SearchBrand",
method:"POST",

data:{
brand:brand
},

success:function(response){

let products = JSON.parse(response);

let html="";

products.forEach(product=>{

html+=`
<div class="product-card">

<h4>${product.name}</h4>

<p style="font-size: 16px">${product.description}</p>

<p>${product.price}</p>

<img src="/Phonexa-MVC/public/uploads/${product.image}" width="120">

</div>
`;

});

$("#productContainer").html(html);

}

});

});

});