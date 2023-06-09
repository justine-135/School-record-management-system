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

const promotionForm = document.querySelector(".promotion-form");

promotionForm.addEventListener("submit", (e) => {
  let result = confirm("Submit selected students?\nData cannot be changed.");
  if (result != true) {
    e.preventDefault();
  }
});

const subjectToastBtn = document.querySelector("#subjects-toast-btn");
const subjectToast = document.querySelector("#subjects-toast");

subjectToastBtn.addEventListener("click", () => {
  subjectToast.classList.remove("hide");
  subjectToast.classList.add("show");
  console.log(subjectToast);
});
