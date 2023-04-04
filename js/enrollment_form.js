// If 'Other' radio button is selected, show textbox
// Hide textbox if not
const educ_radios = document.querySelectorAll(".education-radio");
// const other_educ_radios = document.querySelectorAll(".other-education-radio");

let other_education_textbox;
educ_radios.forEach((element) => {
  let educ_radios = element;

  educ_radios.addEventListener("change", () => {
    other_education_textbox =
      educ_radios.parentElement.parentElement.lastElementChild.childNodes[5];
    if (educ_radios.classList.contains("other-education-radio")) {
      other_education_textbox.type = "text";
      other_education_textbox.disabled = false;
    } else {
      other_education_textbox.type = "hidden";
      other_education_textbox.disabled = true;
    }
  });
});

// Fill 'School year' textbox with current year
const from_sy_textbox = document.querySelector(".from-sy-textbox");
const to_sy_textbox = document.querySelector(".to-sy-textbox");

let date = new Date();

from_sy_textbox.min = date.getFullYear();
// from_sy_textbox.value = date.getFullYear();

to_sy_textbox.min = date.getFullYear();
// to_sy_textbox.value = date.getFullYear() + 1;

const gradeSelect = document.querySelector(".grade-select");
const loadGradeSelect = () => {
  let gradeLvl;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      gradeSelect.innerHTML = this.responseText;
    }
  };
  gradeLvl = gradeSelect.previousElementSibling.value;
  xmlhttp.open(
    "GET",
    "./includes/operations.inc.php?grade_level_select=" + gradeLvl,
    true
  );
  xmlhttp.send();
};

loadGradeSelect();
