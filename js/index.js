const classSelect = document.querySelector(".class-select");

const loadDashboard = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      document.querySelector(".student-dashboard").innerHTML =
        this.responseText;
    }
  };
  xmlhttp.open(
    "GET",
    "./includes/teachers.inc.php?index&class=" +
      gradeLevel +
      "&section=" +
      section,
    true
  );
  xmlhttp.send();
};

let classValues = classSelect.value;
let splitValue = classValues.split(",");
let gradeLevel = splitValue[0];
let section = splitValue[1];

classSelect.addEventListener("change", (e) => {
  classValues = e.target.value;
  splitValue = classValues.split(",");
  gradeLevel = splitValue[0];
  section = splitValue[1];

  loadDashboard(gradeLevel, section);
  console.log(section);
});

loadDashboard(gradeLevel, section);
