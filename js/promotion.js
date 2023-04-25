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
