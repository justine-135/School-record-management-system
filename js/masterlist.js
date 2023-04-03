const loadMasterList = (query) => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      const masterlistTable = document.querySelector(".masterlist-table");
      masterlistTable.innerHTML = this.responseText;
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
