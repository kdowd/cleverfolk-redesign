// let observer = new MutationObserver(() => {
//   alert("wtf");
// });

// observer.observe($0);

// let options = {
//   childList: false,
//   attributes: false,
//   characterData: true,
//   subtree: false,
//   attributeOldValue: false,
//   characterDataOldValue: false,
//   attributeFilter: ["hidden", "contenteditable", "data-par"],
// };

// observer.observe($0, options);

// function mCallback(mutations) {
//   for (let mutation of mutations) {
//     if (mutation.type === "characterData") {
//       // Do something here...
//     }
//   }
// }

window.addEventListener("load", (e) => {
  setTimeout(() => {
    getInitial();
  }, 1000);
  document.body.addEventListener("wc-blocks_added_to_cart", searchAndListen, { once: true });
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
  let mini_cart_element = document.querySelector(".wc-block-mini-cart__button");

  if (!!mini_cart_element) {
    letsListen(mini_cart_element);
  }
}

function letsListen(ele) {
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
