// const loadinStudentInformation = () => {
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function () {
//     if (this.readyState == 4) {
//       const gradeSection = document.querySelector(
//         ".student-information"
//       );
//       gradeSection.innerHTML = this.responseText;
//     }
//   };
//   xmlhttp.open("GET", "./includes/student.inc.php?student", true);
//   xmlhttp.send();
// };

// loadinStudentInformation();

const ageSpan = document.querySelector(".age-calc");
const bdaySpan = document.querySelector(".bday");

// Calclulate age on birthdate
const calculateAge = (birthday) => {
  const ageDifMs = Date.now() - new Date(birthday).getTime();
  const ageDate = new Date(ageDifMs);
  return Math.abs(ageDate.getUTCFullYear() - 1970);
};
ageSpan.innerHTML = "(" + calculateAge(bdaySpan.innerHTML) + ")";

const selectGrade = document.querySelector(".add-grade-select");

selectGrade.addEventListener("change", () => {
  console.log(selectGrade.value);
  let gradeLvl = selectGrade.value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      const gradeSection = document.querySelector(".add-grade-table");
      gradeSection.innerHTML = this.responseText;
    }
  };
  xmlhttp.open(
    "GET",
    "./includes/student.inc.php?grade_level=" + gradeLvl,
    true
  );
  xmlhttp.send();
});

const gradeSection = document.querySelector(".grades-section");
let lrn = gradeSection.id;

const loadGradeSection = () => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      gradeSection.innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "./includes/grades.inc.php?load_grade&lrn=" + lrn, true);
  xmlhttp.send();
};

loadGradeSection();

const sectionSelect = document.querySelector(".section-select");
const loadSectionSelect = (gradeValue) => {
  let section;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      sectionSelect.innerHTML = this.responseText;
    }
  };
  section = sectionSelect.previousElementSibling.value;
  xmlhttp.open(
    "GET",
    "./includes/operations.inc.php?section_select=" + gradeValue,
    true
  );
  xmlhttp.send();
};

const gradeSelect = document.querySelector(".grade-select");
let gradeValue = gradeSelect.value;

gradeSelect.addEventListener("change", () => {
  gradeValue = gradeSelect.value;
  loadSectionSelect(gradeValue);
});

loadSectionSelect(gradeValue);
