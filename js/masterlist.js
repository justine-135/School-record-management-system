// const loadMasterList = () => {
//   var xmlhttp = new XMLHttpRequest();
//   let page = document.querySelector(".get-page").value;
//   let rowValue = document.querySelector(".get-row").value;
//   let statusValue = document.querySelector(".get-status").value;

//   xmlhttp.onreadystatechange = function () {
//     if (this.readyState == 4) {
//       // Show HTML
//       const masterlistTable = document.querySelector(".masterlist-table");
//       masterlistTable.innerHTML = this.responseText;

//       // Checkbox all student
//       // const masterlistChkbxAll = document.querySelector(
//       //   ".masterlist-chkbox-all"
//       // );
//       // const masterlistChkbxs = document.querySelectorAll(".masterlist-chkbox");

//       // let checkAll = false;

//       // // Uncheck and check checkboxes
//       // const checkUncheck = (bool1) => {
//       //   masterlistChkbxs.forEach((element) => {
//       //     let chkBx = element;

//       //     chkBx.checked = bool1;
//       //     checkAll = bool1;
//       //   });
//       // };

//       // // Checkbox conditions
//       // masterlistChkbxAll.addEventListener("change", () => {
//       //   if (!checkAll) {
//       //     // Check all
//       //     checkUncheck(true);
//       //   } else {
//       //     // Uncheck all
//       //     checkUncheck(false);
//       //   }
//       // });
//     }
//   };

//   xmlhttp.open(
//     "GET",
//     "./includes/student.inc.php?query&status=" +
//       statusValue +
//       "&row=" +
//       rowValue +
//       "&page_no=" +
//       page,
//     true
//   );
//   xmlhttp.send();
// };

// // const searchInput = document.querySelector(".search-input");
// // const searchBtn = document.querySelector(".search-btn");
// // const searchForm = document.querySelector(".search-form");
// // const statusSelect = document.querySelector(".status-select");
// // const rowSelect = document.querySelector(".row-select");

// // let query = searchInput.value;
// // let statusValue = statusSelect.value;
// // let rowValue = rowSelect.value;

// // Search query
// // searchForm.addEventListener("submit", (e) => {
// //   e.preventDefault();
// // });

// // searchInput.addEventListener("keyup", (e) => {
// //   query = e.target.value;
// //   loadMasterList(query);
// // });

// // searchBtn.addEventListener("click", () => {
// //   query = searchInput.value;
// //   loadMasterList(query);
// // });

// // statusSelect.addEventListener("change", () => {
// //   statusValue = statusSelect.value;
// //   loadMasterList(query, statusValue);
// // });

// // rowSelect.addEventListener("change", () => {
// //   rowValue = rowSelect.value;
// //   loadMasterList(query, statusValue, rowValue);
// // });

// loadMasterList();

// // console.log(previousPageBtn);
