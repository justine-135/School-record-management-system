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
