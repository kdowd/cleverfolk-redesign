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
