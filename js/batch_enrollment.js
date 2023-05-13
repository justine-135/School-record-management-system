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

var url_string = window.location.href;
var url = new URL(url_string);
var c = url.searchParams.get("level");
loadSectionSelect(c);

// Checkbox all student
const masterlistChkbxAll = document.querySelector(".masterlist-chkbox-all");
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
