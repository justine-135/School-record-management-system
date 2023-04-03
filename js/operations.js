const loadGradeLevelsSelect = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      const gradeLevelSelect = document.querySelector(".grade-level-select");
      gradeLevelSelect.innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "./includes/operations.inc.php?grade_level_select", true);
  xmlhttp.send();
};

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
    }
  };
  xmlhttp.open("GET", "./includes/operations.inc.php?sections_table", true);
  xmlhttp.send();
};

loadGradeLevelsSelect();
loadGradeLevels();
loadSections();
