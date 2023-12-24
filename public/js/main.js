document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("myModal");
  const closeModalButton = document.getElementById("closeNavModal");
  const openModalButton = document.getElementById("openNavModal");

  closeModalButton.addEventListener("click", function () {
    modal.classList.add("hidden"); // Add a class that hides the modal (e.g., "hidden")
  });

  openModalButton.addEventListener("click", function () {
    modal.classList.remove("hidden"); // Add a class that hides the modal (e.g., "hidden")
  });
});

function submitRatingForm(ratingValue) {
  document.getElementById("rating-value").value = ratingValue;

  document.getElementById("rating-form").submit();
}

// document.getElementById("myForm").addEventListener("submit", function (event) {
//   event.preventDefault(); // Prevent the form from submitting

//   grecaptcha.ready(function () {
//     grecaptcha
//       .execute("6LcbNzkpAAAAAE7_vzhWXaHONMeu89J4mJewKcmx", { action: "submit" })
//       .then(function (token) {
//         // Add the token to your form data or send it to your server for verification
//         // Here you can also submit the form using Ajax or whatever method you prefer
//       });
//   });
// });

// function onSubmit(token) {
//   document.getElementById("contactForm").submit();
//   console.log("test");
// }

function handleButtonClick(event) {
  // Prevent the default form submission
  event.preventDefault();

  // Get the button element
  var button = document.querySelector('[data-action="submit"]');

  // Access the data attributes
  var dataAction = button.getAttribute("data-action");
  var dataSiteKey = button.getAttribute("data-sitekey");
  var dataCallback = button.getAttribute("data-callback");

  // Perform actions based on data-action
  if (dataAction === "submit") {
    // Execute code for submit action
    console.log("Submit action triggered");

    // Execute reCAPTCHA verification
    grecaptcha.ready(function () {
      grecaptcha
        .execute(dataSiteKey, { action: "submit" })
        .then(function (token) {
          // Add your logic to submit to your backend server here.
          console.log("reCAPTCHA token:", token);
          onSubmit(token);
        });
    });
  }

  // Perform actions based on data-callback
  //   if (dataCallback === "onSubmit") {
  //     // Execute callback function
  //     onSubmit($token);
  //   }
}

function onSubmit(token) {
  document.getElementById("recaptchaToken").value = token;
  document.getElementById("contactForm").submit();
}
