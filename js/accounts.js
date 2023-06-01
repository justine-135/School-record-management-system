// Load all users
// const loadUsers = (query) => {
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function () {
//     if (this.readyState == 4) {
//       // Show HTML
//       const masterlistTable = document.querySelector(".accounts-table");
//       masterlistTable.innerHTML = this.responseText;
//     }
//   };
//   xmlhttp.open("GET", "./includes/teachers.inc.php?index", true);
//   xmlhttp.send();
// };

// loadUsers();

// const advisoryModalLinks = document.querySelectorAll(".advisory-link");
// advisoryModalLinks.forEach((element) => {
//   element.addEventListener("click", () => {
//     console.log(element.previousElementSibling);
//     let username = element.previousElementSibling.value;
//     let email = element.previousElementSibling.previousElementSibling.value;

//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function () {
//       if (this.readyState == 4) {
//         // Show HTML
//         const advisoriesModal = document.querySelector(".advisories-modal");
//         advisoriesModal.innerHTML = this.responseText;

//         console.log(advisoriesModal);
//       }
//     };
//     xmlhttp.open(
//       "GET",
//       "./includes/teachers.inc.php?advisories&email=" +
//         email +
//         "&username=" +
//         username,
//       true
//     );
//     xmlhttp.send();
//   });
// });

// const actionForms = document.querySelectorAll(".action-form");
const statusBtns = document.querySelectorAll(".status-btn");
const resetBtns = document.querySelectorAll(".reset-btn");

statusBtns.forEach((statusBtn) => {
  statusBtn.addEventListener("click", () => {
    let id =
      statusBtn.parentElement.parentElement.parentElement.childNodes[1]
        .childNodes[1].value;
    let text = `Do you want to toggle status for user #${id}?`;
    if (confirm(text) != true) {
      preventSubmit(statusBtn);
    }
  });
});

resetBtns.forEach((resetBtn) => {
  resetBtn.addEventListener("click", () => {
    let id =
      resetBtn.parentElement.parentElement.parentElement.childNodes[1]
        .childNodes[1].value;
    let text = `Do you want to reset password for user #${id}?`;
    if (confirm(text) != true) {
      preventSubmit(resetBtn);
    }
  });
});

const preventSubmit = (button) => {
  console.log("cancel");
  //   actionForms.forEach((actionForm) => {
  //     actionForm.addEventListener("submit", (e) => {
  //       e.preventDefault();
  //     });
  //   });
  const actionForm = button.parentElement.parentElement.parentElement;
  actionForm.addEventListener("submit", (e) => {
    e.preventDefault();
  });
};
