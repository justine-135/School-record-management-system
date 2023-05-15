// Fill 'School year' textbox with current year
const from_sy_textbox = document.querySelector(".from-sy-textbox");
const to_sy_textbox = document.querySelector(".to-sy-textbox");

let date = new Date();

from_sy_textbox.min = date.getFullYear();
// from_sy_textbox.value = date.getFullYear();

to_sy_textbox.min = date.getFullYear();
// to_sy_textbox.value = date.getFullYear() + 1;

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
