// if draw is open the body will have a drawer-open class
// this script only runs on the shop page - currently, id = 6
window.addEventListener("load", (e) => {
  setTimeout(() => {
    updateCartInfo();
    searchAndListen();
  }, 1000);
});

function getLocalStorageCart() {
  let cartObject = JSON.parse(localStorage.getItem("wc-blocks_mini_cart_totals"));
  if (!!cartObject && cartObject.hasOwnProperty("itemsCount")) {
    return Math.max(0, cartObject.itemsCount);
  }

  return 0;
}

function updateCartInfo() {
  let cartTrackerElement = document.querySelector(".cart-tracker");

  if (!!cartTrackerElement) {
    cartTrackerElement.innerText = getLocalStorageCart();
    cartTrackerElement.classList.remove("cart-tracker-hide");
  }
}

function searchAndListen() {
  // could yse endpoint :  https://cleverfolk.co.nz/wp-json/wc/store/v1/cart/
  // let mini_cart_element = document.querySelector(".wc-block-mini-cart__button");
  let mini_cart_element = document.querySelector(".wc-block-mini-cart");

  if (!!mini_cart_element) {
    console.log("searchAndListen to mini-cart");
    letsListen(mini_cart_element);
  }
}

function letsListen(ele) {
  let observer = new MutationObserver((mutations) => {
    console.log("mutated", mutations);
    setTimeout(updateCartInfo, 500);
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
