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

if (ageSpan !== null) {
  ageSpan.innerHTML = "(" + calculateAge(bdaySpan.innerHTML) + ")";
}

const loadSubjects = (gradeLvl, lrn) => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      const gradeSection = document.querySelector(".add-grade-table");
      gradeSection.innerHTML = this.responseText;
    }
  };
  xmlhttp.open(
    "GET",
    "./includes/student.inc.php?grade_level=" + gradeLvl + "&lrn=" + lrn,
    true
  );
  xmlhttp.send();
};

// Select grade level
const selectGrade = document.querySelector(".add-grade-select");
let gradeLvl = selectGrade.value;
selectGrade.addEventListener("change", () => {
  gradeLvl = selectGrade.value;
  loadSubjects(gradeLvl, lrn);
});

loadSubjects(gradeLvl);

// Load grades
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

// Load sections for adding enrollment history
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

// Load section for editing enrollment form
const sectionSelectEnrollmentEdit = document.querySelector(
  ".section-select-enrollment-edit"
);
const loadSectionSelectEnrollmentEdit = (gradeValueEnrollmentEditValue) => {
  let section;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      sectionSelectEnrollmentEdit.innerHTML = this.responseText;
    }
  };
  section = sectionSelectEnrollmentEdit.previousElementSibling.value;
  xmlhttp.open(
    "GET",
    "./includes/operations.inc.php?section_select_enrollment_edit=" +
      gradeValueEnrollmentEditValue,
    true
  );
  xmlhttp.send();
};

const gradeSelectEnrollmentEdit = document.querySelector(
  ".grade-select-enrollment-edit"
);
let gradeValueEnrollmentEditValue = gradeSelectEnrollmentEdit.value;
console.log(gradeSelectEnrollmentEdit);

gradeSelectEnrollmentEdit.addEventListener("change", () => {
  gradeValueEnrollmentEditValue = gradeSelectEnrollmentEdit.value;
  loadSectionSelectEnrollmentEdit(gradeValueEnrollmentEditValue);
});

loadSectionSelectEnrollmentEdit(gradeValueEnrollmentEditValue);
