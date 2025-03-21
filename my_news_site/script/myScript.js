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