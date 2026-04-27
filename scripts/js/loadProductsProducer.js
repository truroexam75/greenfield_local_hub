function createCardElements() {
    // Creates the product card, or information container, alongside the
    // the product name, assigned their respective classes for styling
    productCard = document.createElement("div");
    productCard.setAttribute("class", "product-card");
    
    productName = document.createElement("p");
    productName.setAttribute("class", "product-name");
    
    // Creates a section for the price and availability of the product
    // with their respective classes also
    productInfo = document.createElement("div");
    productInfo.setAttribute("class", "product-info");

    productPrice = document.createElement("p");
    productPrice.setAttribute("class", "product-price");
    
    productAvailability = document.createElement("p");
    productAvailability.setAttribute("class", "product-availability");
    
    // Appends the price and availability to the section just created for
    // them
    productInfo.appendChild(productPrice);
    productInfo.appendChild(productAvailability);

    // Creates a mini form for users to add to basket and choose what
    // quantity they will add
    productPurchase = document.createElement("form");
    productPurchase.setAttribute("action", "scripts/php/add_to_basket_handler.php");
    productPurchase.setAttribute("method", "POST");
    
    productAdd = document.createElement("button");
    productAdd.setAttribute("type", "submit");
    productAdd.setAttribute("name", "add_to_basket");
    productAdd.setAttribute("title", "Click here to add this product to your basket in order to purchase it.");
    
    productQuantity = document.createElement("input");
    productQuantity.setAttribute("type", "number");
    productQuantity.setAttribute("name", "product_quantity");
    productQuantity.setAttribute("title", "Enter a number here to select the quantity of the item you want to add to basket. You can edit this later.");
    productQuantity.setAttribute("min", "0"); // Max will be set to the current stock available, gotten through fetch data
    
    // Adds the ID of the product to the form through a hidden input
    // element
    productId = document.createElement("input");
    productId.setAttribute("type", "hidden");
    productId.setAttribute("name", "product_id");

    // Append children to 'add to basket' / product purchase form
    productPurchase.appendChild(productAdd);
    productPurchase.appendChild(productQuantity);
    productPurchase.appendChild(productId);

    // Append children to product card
    productCard.appendChild(productName);
    productCard.appendChild(productInfo);
    productCard.appendChild(productPurchase);

    // While I could access sub-elements through the use of the children
    // property, I have laid out the return like this so all of the
    // elements and sub-elements can be accessed outright
    return [
        productCard,
        productName,
        productInfo,
            productPrice,
            productAvailability,
        productPurchase,
            productAdd,
            productQuantity
    ];
}

export async function loadProductsProducersEvent(container, offsetElement, producerIdElement) {
    let fragment = document.createDocumentFragment();
    let offset = offsetElement.value;
    let producerId = producerIdElement.value;

    // Configures the data to be sent and its properties for the fetch
    // request
    let request = {
        "offset": offset,
        "producer_id": producerId
    }
    let options = {
        method: "POST",
        body: JSON.stringify(request),
        headers: {
            "Content-Type": "application/json; charset = \"utf-8\"",
        }
    }
    const response = await fetch("product_load_handler.php", options);
    let data = await response;

    // Checks whether the data - JSON - or an error message - String - has
    // been included in the response
    const contentType = data.headers.get("Content-Type");
    
    if (contentType.includes("text/plain")) {
        data = data.text();
        console.log(data);
        return;
    }

    data = data.json();
    console.log(data);

    [
        productCard,
        productName,
        productInfo,
            productPrice,
            productAvailability,
        productPurchase,
            productAdd,
            productQuantity
    ] = createCardElements();

    // Assigns values from data to different properties of the card
    productName.innerHTML = data.product_name;
    productPrice.innerHTML = data.product_price;

    // Checks the stock amount and gives the user a brief overview
    // of stock levels for the product
    switch (true) {
        case data.product_stock == 0:
            productAvailability.innerHTML = "Out of stock";
        case data.product_stock <= 10:
            productAvailability.innerHTML = "Low stock";
        case data.product_stock > 10:
            productAvailability.innerHTML = "In stock";
    }

    productAdd.innerHTML = "Add to basket";
    productQuantity.setAttribute("max", data.product_stock);
    productId.setAttribute("value", data.product_id);

    

    

}