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
let deleteId;

// Get the <span> element that closes the modal
let modalClose = document.querySelector("#modal-cancel");
let modalDelete = document.querySelector("#modal-delete");

// Get the button that opens the modal
let verts = document.querySelector('.vertical_box');

verts.addEventListener('click', function (event) {
  let selectedBtn = event.target.closest('.delete-btn');
  console.log("Hello clicky", event.target);
  if (event.target.id === "delete-btn") {
    modal.style.display = "block";
    deleteId = event.target.dataset.id;
  }
  // if(selectedBtn !== null) {
  //   modal.style.display = "block";
  // }
});

// When the user clicks on close, close the modal
modalClose.addEventListener('click', () => {
  modal.style.display = "none";
});

modalDelete.addEventListener('click', async (e) => {
  // let deleteId = btn.dataset.id;
  let theForm = document.querySelector(".story-delete");

  const formData = new FormData();
  formData.append("id", deleteId);

  const response = await fetch("story_delete.php", {
    method: "POST",
    // Set the FormData instance as the request body
    body: formData,
  });

  // formInput.value = deleteId;
  window.location.replace("index_edit.php");
});

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}