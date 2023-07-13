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
    getInitial();
    searchAndListen();
  }, 1000);
});

function getInitial() {
  let minicart = document.querySelector(".wc-block-mini-cart__badge");
  let cartTrackerElement = document.querySelector(".cart-tracker");
  if (!!minicart) {
    let num = parseInt(minicart.innerText);
    if (isNaN(num)) num = 0;
    cartTrackerElement.innerText = Math.max(0, num);
    cartTrackerElement.classList.remove("cart-tracker-hide");
  }
}

function searchAndListen(evt) {
  console.log("searchAndListen");
  // let mini_cart_element = document.querySelector(".wc-block-mini-cart__button");
  let mini_cart_element = document.querySelector(".wc-block-mini-cart");

  if (!!mini_cart_element) {
    letsListen(mini_cart_element);
  }
}

function letsListen(ele) {
  console.log("letsListen to ", ele);
  let observer = new MutationObserver((mutations) => {
    let cartBadge = document.querySelector(".wc-block-mini-cart__badge");
    if (!!cartBadge) {
      console.log(cartBadge.innerText);
      let cartTrackerElement = document.querySelector(".cart-tracker");

      if (!!cartTrackerElement) {
        let num = parseInt(cartBadge.innerText);
        if (isNaN(num)) num = 0;
        cartTrackerElement.innerText = Math.max(0, num);
      }
    }
  });

  let options = {
    childList: true,
    attributes: true,
    characterData: true,
    subtree: true,
    attributeFilter: ["one", "two"],
    attributeOldValue: true,
    characterDataOldValue: true,
  };

  observer.observe(ele, options);
}
