// DOMContentLoaded() Event
document.addEventListener("DOMContentLoaded", function(){

//PRICE FILTER -> change() Event

document.getElementById("priceFilter").addEventListener("change", function(){

    let price = this.value;

    fetch("/Phonexa-MVC/FilterPrice", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "price=" + price
    })
    .then(res => res.json())
    .then(data => {

        let products = data.products;
        let wishlist = data.wishlist;

        let html = "";

        products.forEach(product => {

            let checked = wishlist.includes(product.id) ? "checked" : "";

            html += `
            <div class="product-card">
                <h4>${product.name}</h4>
                <p>${product.price}</p>
                <img src="/Phonexa-MVC/public/uploads/${product.image}" width="120"><br>

                <label>
                <input type="checkbox" ${checked} onclick="toggleWishlist(this, ${product.id})"> Wishlist
                </label>
            </div>`;
        });

        document.getElementById("productContainer").innerHTML = html;

        let pagination = document.getElementById("pagination");
        if(pagination) 
        {
            pagination.style.display = "block";
        }
    });
});
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
.then(data => {

let products = data.products;
let wishlist = data.wishlist;

let html="";

products.forEach(product=>{

let checked = wishlist.includes(product.id) ? "checked" : "";

html += `
<div class="product-card">

<h4>${product.name}</h4>

<p style="font-size:16px">${product.description}</p>

<p>${product.price}</p>

<img src="/Phonexa-MVC/public/uploads/${product.image}" width="120"><br>

<label>
<input type="checkbox" ${checked} onclick="toggleWishlist(this, ${product.id})">Wishlist</label>

</div>
`;

});

document.getElementById("productContainer").innerHTML = html;

let pagination = document.getElementById("pagination");
if(pagination)
{
    pagination.style.display = "block";
}

});

});

// SEARCH BRAND -> click() Event

document.getElementById("searchBtn").addEventListener("click", function(){

let brand = document.getElementById("brandSearch").value;

if (brand === "") 
{
    window.location.href = "/Phonexa-MVC/Home";
    return;
}

fetch("/Phonexa-MVC/SearchBrand", {
method: "POST",
headers: {
"Content-Type": "application/x-www-form-urlencoded"
},
body: "brand=" + brand
})

.then(response => response.json())
.then(data => {

let products = data.products;
let wishlist = data.wishlist;

let html="";

products.forEach(product=>{

let checked = wishlist.includes(product.id) ? "checked" : "";

html += `
<div class="product-card">

<h4>${product.name}</h4>

<p style="font-size:16px">${product.description}</p>

<p>${product.price}</p>

<img src="/Phonexa-MVC/public/uploads/${product.image}" width="120"><br>

<label>
<input type="checkbox" ${checked} onclick="toggleWishlist(this, ${product.id})">Wishlist</label>

</div>
`;

});

document.getElementById("productContainer").innerHTML = html;

let pagination = document.getElementById("pagination");
if(pagination)
{
    pagination.style.display = "block";
}

});

});

});

// Wishlist function() -> onclick() Event

function toggleWishlist(checkbox, productId)
{
    let action = checkbox.checked ? "add" : "remove";

    fetch("/Phonexa-MVC/ToggleWishlist", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "product_id=" + productId + "&action=" + action
    })
    .then(res => res.json())
    .then(json => {

        if(json.status === "not_logged_in")
        {
            alert("Please Login First");

            checkbox.checked = false;
            window.location.href = "/Phonexa-MVC/UserLogin";
        }
        else if(json.status === "added")
        {
            alert("Added To wishlist");

            let countEl = document.getElementById("wishlistCount");
            let count = parseInt(countEl.innerText) || 0;
            countEl.innerText = count + 1;
        }
        else
        {
            alert("Removed From Wishlist");

            let countEl = document.getElementById("wishlistCount");
            let count = parseInt(countEl.innerText) || 0;
            countEl.innerText = Math.max(0, count - 1);
        }
    });
}
