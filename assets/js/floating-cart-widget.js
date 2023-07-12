// use local storage
//{"totals":{"total_items":"0"
// ,"total_items_tax":"0"
// ,"total_fees":"0"
// ,"total_fees_tax":"0"
// ,"total_discount":"0"
// ,"total_discount_tax":"0"
// ,"total_shipping":null
// ,"total_shipping_tax":null
// ,"total_price":"0"
// ,"total_tax":"0"
// ,"tax_lines":[]
// ,"currency_code":"NZD"
// ,"currency_symbol":"$"
// ,"currency_minor_unit":2
// ,"currency_decimal_separator":"."
// ,"currency_thousand_separator":"
// ,"
// ,"currency_prefix":"$"
// ,"currency_suffix":""}
// ,"itemsCount":0}

// if draw is open the body will have a drawer-open class
window.addEventListener("load", (e) => {
  setTimeout(() => {
    addBodyListeners();
  }, 2000);
});

function addBodyListeners(evt) {
  document.body.addEventListener("wc-blocks_adding_to_cart", (evt) => {
    console.log("adding");
    // window.pigg = evt;
  });

  document.body.addEventListener("wc-blocks_added_to_cart", (evt) => {
    console.log("added");
    // window.figg = evt;
  });

  document.body.addEventListener("wc-blocks_removed_from_cart", (evt) => {
    console.log("wc-blocks_removed_from_cart");
  });
  document.body.addEventListener("removed_from_cart", (evt) => {
    console.log("removed_from_cart");
  });

  window.addEventListener("pageshow", (evt) => {
    console.log("pageshow");
  });
}

////////////////////////////////////////////////////////////////////////////

function debounce(func, timeout = 300) {
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => {
      func.apply(this, args);
    }, timeout);
  };
}
function checkScrollY() {
  let yPos = window.scrollY;
  let theWidget = document.querySelector(".floating-cart-widget");
  console.log(yPos);

  if (yPos > 300) {
    if (theWidget.classList.contains("hide")) {
      console.log("ADD");
      theWidget.classList.replace("hide", "show");
    }
  } else {
    if (theWidget.classList.contains("show")) {
      console.log("REMOVE");
      theWidget.classList.replace("show", "hide");
    }
  }
}

window.addEventListener("load", (e) => {
  let theWidget = document.querySelector(".floating-cart-widget");
  if (!!theWidget) {
    window.addEventListener(
      "scroll",
      debounce(() => checkScrollY(theWidget), 200)
    );
  }
});
