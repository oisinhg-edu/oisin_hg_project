const dropdown = document.querySelector(".dropdown-content");
const dropdownBtn = document.querySelector("#dropbtn");

let editBtn = document.querySelector('#toggle-edit');
let actionDiv = document.querySelectorAll('.actions');

localStorage.setItem("isAdmin", false);

let isAdmin = localStorage.getItem('isAdmin');

console.log(isAdmin);

if (isAdmin === 'true') {
  actionDiv.forEach((actions) => {
    actions.style.display = 'flex';
  });
}

document.addEventListener("click", e => {
  if (dropdownBtn.contains(e.target)) {
    // Button clicked: toggle
    dropdown.classList.toggle("show");
  } else if (!dropdown.contains(e.target)) {
    // Clicked out: hide
    dropdown.classList.remove("show");
  }
});

// console.log(actionDiv);

// editBtn.addEventListener('click', () => {
//   window.location.href
// });

document.addEventListener('click', event => {
  let selectedStoryDiv = event.target.closest('.story');

  if (selectedStoryDiv !== null && event.target !== selectedStoryDiv.querySelector('#delete-btn')) {
    console.log('clicked');
    storyId = selectedStoryDiv.dataset.id;
    console.log(event.target);

    window.location.href = `story_view.php?id=${storyId}`;
  }
});
