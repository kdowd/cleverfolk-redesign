window.addEventListener("load", (e) => {
  setTimeout(() => {
    addBodyListeners();
  }, 500);
});

function addBodyListeners(evt) {
  // this event only fires if the mini-cart is live and visible - i think
  document.body.addEventListener("wc-blocks_added_to_cart", (evt) => {
    let ele = document.querySelector(".toast");
    if (!!ele) {
      ele.classList.add("toast-show");
      ele.addEventListener(
        "animationend",
        (evt) => {
          ele.classList.remove("toast-show");
        },
        { once: true }
      );
    }
  });
}
