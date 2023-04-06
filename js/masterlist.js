const loadMasterList = (query) => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      const masterlistTable = document.querySelector(".masterlist-table");
      masterlistTable.innerHTML = this.responseText;

      // Checkbox all student
      const masterlistChkbxAll = document.querySelector(
        ".masterlist-chkbox-all"
      );
      const masterlistChkbxs = document.querySelectorAll(".masterlist-chkbox");

      let checkAll = false;

      // Uncheck and check checkboxes
      const checkUncheck = (bool1) => {
        masterlistChkbxs.forEach((element) => {
          let chkBx = element;

          chkBx.checked = bool1;
          checkAll = bool1;
        });
      };

      // Checkbox conditions
      masterlistChkbxAll.addEventListener("change", () => {
        if (!checkAll) {
          // Check all
          checkUncheck(true);
        } else {
          // Uncheck all
          checkUncheck(false);
        }
      });
    }
  };
  if (query === undefined) {
    xmlhttp.open("GET", "./includes/student.inc.php?query=", true);
    xmlhttp.send();
  } else {
    xmlhttp.open("GET", "./includes/student.inc.php?query=" + query, true);
    xmlhttp.send();
  }
};

loadMasterList();

const searchInput = document.querySelector(".search-input");
const searchBtn = document.querySelector(".search-btn");
const searchForm = document.querySelector(".search-form");
let query;

// Search query
searchForm.addEventListener("submit", (e) => {
  e.preventDefault();
});

searchBtn.addEventListener("click", () => {
  query = searchInput.value;
  loadMasterList(query);
});
