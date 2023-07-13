window.addEventListener("load", (e) => {
  setTimeout(() => {
    addBodyListeners();
  }, 500);
});

function addBodyListeners(evt) {
  document.body.addEventListener("wc-blocks_added_to_cart", (evt) => {
    window.figg = evt;
    let ele = document.querySelector(".toast");
    if (!!ele) {
      ele.classList.add("toast-show");
      ele.addEventListener("animationend", (evt) => {
        ele.classList.remove("toast-show");
      });
    }
  });
}
