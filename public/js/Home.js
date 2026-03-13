// DOMContentLoaded() Event
document.addEventListener("DOMContentLoaded", function(){

// BRAND FILTER -> change() Event

document.getElementById("brandFilter").addEventListener("change", function(){

let brand_id = this.value;


fetch("/Phonexa-MVC/FilterBrand", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded"
},
body: "brand_id=" + brand_id
})

.then(response => response.json())
.then(products => {

let html="";

products.forEach(product=>{

html += `
<div class="product-card">

<h4>${product.name}</h4>

<p style="font-size:16px">${product.description}</p>

<p>${product.price}</p>

<img src="/Phonexa-MVC/public/uploads/${product.image}" width="120">

</div>
`;

});

document.getElementById("productContainer").innerHTML = html;

// Hide Pagination
let pagination = document.getElementById("pagination");
if(pagination)
{
    pagination.style.display = "none";
}

});

});

// SEARCH BRAND -> click() Event

document.getElementById("searchBtn").addEventListener("click", function(){

let brand = document.getElementById("brandSearch").value;


fetch("/Phonexa-MVC/SearchBrand", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded"
},
body: "brand=" + brand
})

.then(response => response.json())
.then(products => {

let html="";

products.forEach(product=>{

html += `
<div class="product-card">

<h4>${product.name}</h4>

<p style="font-size:16px">${product.description}</p>

<p>${product.price}</p>

<img src="/Phonexa-MVC/public/uploads/${product.image}" width="120">

</div>
`;

});

document.getElementById("productContainer").innerHTML = html;

// Hide Pagination
let pagination = document.getElementById("pagination");
if(pagination)
{
    pagination.style.display = "none";
}

});

});

});