import "./bootstrap";

import Alpine from "alpinejs";
import "trix";
import "trix/dist/trix.css"; // Impor CSS Trix
// import Toastify from "toastify-js";
// import "toastify-js/src/toastify.css";
window.Alpine = Alpine;

// Toastify({
//     text: "This is a toast",
//     duration: 3000,
//     destination: "https://github.com/apvarun/toastify-js",
//     newWindow: true,
//     close: true,
//     gravity: "top", // `top` or `bottom`
//     position: "left", // `left`, `center` or `right`
//     stopOnFocus: true, // Prevents dismissing of toast on hover
//     style: {
//         background: "linear-gradient(to right, #00b09b, #96c93d)",
//     },
//     onClick: function () {}, // Callback after click
// }).showToast();

Alpine.start();
