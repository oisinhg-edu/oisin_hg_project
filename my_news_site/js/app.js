const dropdown = document.querySelector(".dropdown-content");
const dropdownBtn = document.querySelector("#dropbtn");

document.addEventListener("click", e => {
  if (dropdownBtn.contains(e.target)) {
    // Button clicked: toggle
    dropdown.classList.toggle("show");
  } else if (!dropdown.contains(e.target)) {
    // Clicked out: hide
    dropdown.classList.remove("show");
  }
});

// MODAL
// Get the modal
let modal = document.querySelector("#confirm");

// Get the button that opens the modal
let btn = document.querySelectorAll("#delete-btn")[1];

// Get the <span> element that closes the modal
let modalClose = document.querySelector("#modal-cancel");
let modalDelete = document.querySelector("#modal-delete");

// When the user clicks on the button, open the modal
btn.addEventListener('click', () => {
  modal.style.display = "block";
});

// When the user clicks on close, close the modal
modalClose.addEventListener('click', () => {
  modal.style.display = "none";
});

modalDelete.addEventListener('click', () => {
  window.location.replace("./story_create.php");
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}