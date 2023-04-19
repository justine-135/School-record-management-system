const loadMasterList = (query, statusValue) => {
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

  xmlhttp.open(
    "GET",
    "./includes/student.inc.php?query=" + query + "&status=" + statusValue,
    true
  );
  xmlhttp.send();
};

const searchInput = document.querySelector(".search-input");
const searchBtn = document.querySelector(".search-btn");
const searchForm = document.querySelector(".search-form");

let query;
query = searchInput.value;

const statusSelect = document.querySelector(".status-select");

let statusValue;
statusValue = statusSelect.value;

// Search query
searchForm.addEventListener("submit", (e) => {
  e.preventDefault();
});

searchInput.addEventListener("keyup", (e) => {
  query = e.target.value;
  loadMasterList(query, statusValue);
});

searchBtn.addEventListener("click", () => {
  query = searchInput.value;
  loadMasterList(query, statusValue);
});

statusSelect.addEventListener("change", () => {
  statusValue = statusSelect.value;
  loadMasterList(query, statusValue);
});

loadMasterList(query, statusValue);
