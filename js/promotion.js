const loadPhp = () => {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.querySelector(".load-promotion").innerHTML = this.responseText;

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
  };
  xhttp.open(
    "GET",
    "./includes/promotion_retention.inc.php?view=promotion",
    true
  );
  xhttp.send();
};

loadPhp();

const subjectToastBtn = document.querySelector("#subjects-toast-btn");
const subjectToast = document.querySelector("#subjects-toast");

subjectToastBtn.addEventListener("click", () => {
  subjectToast.classList.remove("hide");
  subjectToast.classList.add("show");
  console.log(subjectToast);
});
