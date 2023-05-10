const loadGradeLevels = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      const gradeLevelTable = document.querySelector(".grade-level-table");
      gradeLevelTable.innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "./includes/operations.inc.php?grade_level_table", true);
  xmlhttp.send();
};

const loadSections = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      const sectionsTable = document.querySelector(".sections-table");
      sectionsTable.innerHTML = this.responseText;

      // const addGradeLevelBtn = document.querySelector(".add-grade-level");
      // const gradeLevelSelectList = document.querySelector(".grade-level-list");
      // console.log(addGradeLevelBtn);
    }
  };
  xmlhttp.open("GET", "./includes/operations.inc.php?sections_table", true);
  xmlhttp.send();
};

loadGradeLevels();
loadSections();

const gradeLevelSelectSubject = document.querySelector(
  ".grade-level-select-subject"
);

const quarterSelect = document.querySelector(".quarters-select");

if (gradeLevelSelectSubject.value !== "Kindergarten") {
  quarterSelect.style.display = "block";
} else {
  quarterSelect.style.display = "none";
}

gradeLevelSelectSubject.addEventListener("change", (e) => {
  let value = e.target.value;
  if (value !== "Kindergarten") {
    quarterSelect.style.display = "block";
  } else {
    quarterSelect.style.display = "none";
  }
});
