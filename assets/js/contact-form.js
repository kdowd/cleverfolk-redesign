// if (!!genericContactForm && genericContactForm.hasOwnProperty("formBaseURL")) {
//   console.log("form base = ", genericContactForm.formBaseURL);
// }

function generic_form_send(evt) {
  evt.preventDefault();
  let form = evt.target;

  clearCurrentMessaging(form);
  showSpinner(form, true);

  fetch(form.getAttribute("action"), {
    method: form.getAttribute("method"),
    body: new FormData(form),
  })
    .then((res) => {
      showSpinner(form, false);
      if (res.status != 200) {
        throw new Error("Bad Server Response");
      }
      return res.json();
    })
    .then((res) => formResponse(res, form))
    .catch((error) => showFormError(error.message, form));
}

function showSpinner(theForm, showBool) {
  let spinnerElement = theForm.querySelector("svg");
  if (!spinnerElement) return;

  if (showBool) {
    spinnerElement.style.display = "inline";
  } else {
    spinnerElement.style.display = "none";
  }
}
function formResponse(res, theForm) {
  if (res.hasOwnProperty("dev_mode") && !!res.dev_mode) {
    showFormSuccess(theForm);
    return;
  }

  if (res.hasOwnProperty("success") && !!res.success) {
    showFormSuccess(theForm);
  } else {
    showFormError("Message posted but failed", theForm);
  }
}

function clearCurrentMessaging(theForm) {
  let successEle = theForm.querySelector(".success-message");
  let errorEle = theForm.querySelector(".error-message");
  if (!!successEle) {
    successEle.style.display = "none";
  }

  if (!!errorEle) {
    errorEle.style.display = "none";
  }
}

// todo
function showFormSuccess(theForm = document) {
  let successEle = theForm.querySelector(".success-message");
  if (!!successEle) {
    successEle.style.display = "block";
  }
}

function showFormError(message, theForm = document) {
  console.log(message);
  let errorEle = theForm.querySelector(".error-message");
  if (!!errorEle) {
    errorEle.style.display = "block";
  }
}
