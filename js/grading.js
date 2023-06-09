// Open grade modal and load grade form
const openGradeBtns = document.querySelectorAll(".open-grade-btn");

openGradeBtns.forEach((element) => {
  element.addEventListener("click", (e) => {
    let lrn = element.parentElement.childNodes[3].value;
    let gradeLevel = element.parentElement.childNodes[5].value;
    let section = element.parentElement.childNodes[7].value;

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4) {
        // Show HTML
        const masterlistTable = document.querySelector(".grading-modal-body");
        masterlistTable.innerHTML = this.responseText;

        // Compute final grade
        const finalGradesInput = document.querySelectorAll(".final-grade");
        const reviewBtn = document.querySelectorAll(".review-grades");

        let firstQuarterInputs = document.querySelectorAll(".first-quarter");
        let secondQuarterInputs = document.querySelectorAll(".second-quarter");
        let thirdQuarterInputs = document.querySelectorAll(".third-quarter");
        let fourthQuarterInputs = document.querySelectorAll(".fourth-quarter");

        let finalGradeInputs = document.querySelectorAll(".final-grade");

        let remarksInputs = document.querySelectorAll(".remarks");

        let totalFinalGradeInput = document.querySelector(
          ".total-final-grades"
        );
        let totalRemarksInput = document.querySelector(".total-remarks");
        let totalRemarksInputDisplay = document.querySelector(
          ".total-remarks-display"
        );

        let firstQuarterGrades = [];
        let secondQuarterGrades = [];
        let thirdQuarterGrades = [];
        let fourthQuarterGrades = [];
        let finalGrades = [];
        let remarks = [];

        firstQuarterInputs.forEach((inputGrade) => {
          inputGrade.addEventListener("keyup", () => {
            getQuarterlyGrades();
            getFinalGrade();
            getSummary();
          });
        });

        secondQuarterInputs.forEach((inputGrade) => {
          inputGrade.addEventListener("keyup", () => {
            getQuarterlyGrades();
            getFinalGrade();
            getSummary();
          });
        });

        thirdQuarterInputs.forEach((inputGrade) => {
          inputGrade.addEventListener("keyup", () => {
            getQuarterlyGrades();
            getFinalGrade();
            getSummary();
          });
        });

        fourthQuarterInputs.forEach((inputGrade) => {
          inputGrade.addEventListener("keyup", () => {
            getQuarterlyGrades();
            getFinalGrade();
            getSummary();
          });
        });

        reviewBtn.forEach((element) => {
          element.addEventListener("click", () => {
            getQuarterlyGrades();
            getFinalGrade();
            getSummary();
          });
        });

        const getQuarterlyGrades = () => {
          firstQuarterGrades = [];
          secondQuarterGrades = [];
          thirdQuarterGrades = [];
          fourthQuarterGrades = [];
          finalGrades = [];
          remarks = [];

          firstQuarterInputs.forEach((element) => {
            firstQuarterGrades.push(element.value);
          });
          secondQuarterInputs.forEach((element) => {
            secondQuarterGrades.push(element.value);
          });
          thirdQuarterInputs.forEach((element) => {
            thirdQuarterGrades.push(element.value);
          });
          fourthQuarterInputs.forEach((element) => {
            fourthQuarterGrades.push(element.value);
          });
        };

        const getFinalGrade = () => {
          for (let i = 0; i < finalGradeInputs.length; i++) {
            let finalGrade = 0;
            let dividedTo = 4;

            let quarter1 = firstQuarterGrades[i];
            let quarter2 = secondQuarterGrades[i];
            let quarter3 = thirdQuarterGrades[i];
            let quarter4 = fourthQuarterGrades[i];

            let hasInc = 0;
            let isEmpty = 0;

            if (firstQuarterGrades[i] == "N/A") {
              dividedTo--;
              quarter1 = 0;
            } else if (firstQuarterGrades[i].toUpperCase() === "INC") {
              hasInc++;
              quarter1 = 0;
            } else if (!firstQuarterGrades[i]) {
              isEmpty++;
              quarter1 = 0;
            }
            if (secondQuarterGrades[i] == "N/A") {
              dividedTo--;
              quarter2 = 0;
            } else if (secondQuarterGrades[i].toUpperCase() === "INC") {
              hasInc++;
              quarter2 = 0;
            } else if (!secondQuarterGrades[i]) {
              isEmpty++;
              quarter2 = 0;
            }

            if (thirdQuarterGrades[i] == "N/A") {
              dividedTo--;
              quarter3 = 0;
            } else if (thirdQuarterGrades[i].toUpperCase() === "INC") {
              hasInc++;
              quarter3 = 0;
            } else if (!thirdQuarterGrades[i]) {
              isEmpty++;
              quarter3 = 0;
            }

            if (fourthQuarterGrades[i] == "N/A") {
              dividedTo--;
              quarter4 = 0;
            } else if (fourthQuarterGrades[i].toUpperCase() === "INC") {
              hasInc++;
              quarter4 = 0;
            } else if (!fourthQuarterGrades[i]) {
              isEmpty++;
              quarter4 = 0;
            }

            finalGrade =
              (parseFloat(quarter1) +
                parseFloat(quarter2) +
                parseFloat(quarter3) +
                parseFloat(quarter4)) /
              dividedTo;

            let finalResult = "";
            if (hasInc > 0) {
              finalResult = "INC";
              finalGradeInputs[i].value = finalResult;
            } else if (isEmpty > 0) {
              finalGradeInputs[i].value = finalResult;
            } else {
              finalResult = finalGrade.toFixed(2);
              finalGradeInputs[i].value = finalResult;
            }

            if (isNaN(finalGrade)) {
              finalResult = "INVALID";
              finalGradeInputs[i].value = finalResult;
            }

            finalGrades.push(finalResult);

            let remarksResult = "";
            if (finalGradeInputs[i].value == "") {
              remarksResult = "";
              remarksInputs[i].value = remarksResult;
            } else if (finalGradeInputs[i].value >= 75) {
              remarksResult = "PASSED";
              remarksInputs[i].value = remarksResult;
            } else if (finalGradeInputs[i].value < 75) {
              remarksResult = "FAILED";
              remarksInputs[i].value = remarksResult;
            } else if (finalGradeInputs[i].value == "INC") {
              remarksResult = "INC";
              remarksInputs[i].value = remarksResult;
            } else {
              remarksResult = "INVALID";
              remarksInputs[i].value = remarksResult;
            }

            remarks.push(remarksResult);
          }
        };

        const getSummary = () => {
          let totalFinalGrade = 0;
          let totalFailedRemark = 0;
          let finalTrue = true;
          for (let i = 0; i < finalGrades.length; i++) {
            const grade = finalGrades[i];
            const remark = remarks[i];

            if (grade !== "INC" && grade !== "N/A" && grade !== "INVALID") {
              totalFinalGrade += parseFloat(grade);
            }
            if (remark == "FAILED" || remark == "INC") {
              totalFailedRemark++;
            }

            if (
              !firstQuarterGrades[i] ||
              !secondQuarterGrades[i] ||
              !thirdQuarterGrades[i] ||
              !fourthQuarterGrades[i]
            ) {
              finalTrue = false;
            }
          }

          if (finalTrue) {
            totalFinalGrade = totalFinalGrade / finalGrades.length;
            totalFinalGradeInput.value = totalFinalGrade.toFixed(2);

            if (totalFailedRemark >= 3) {
              totalRemarksInput.value = "Retention";
              totalRemarksInputDisplay.value = "RETENTION";
            } else if (totalFailedRemark >= 1) {
              totalRemarksInput.value = "Conditional Promotion";
              totalRemarksInputDisplay.value = "CONDITIONAL PROMOTION";
            } else {
              totalRemarksInput.value = "Promotion";
              totalRemarksInputDisplay.value = "PROMOTION";
            }
          }
        };
      }
    };

    xmlhttp.open(
      "GET",
      "./includes/student.inc.php?add_grade" +
        "&lrn=" +
        lrn +
        "&grade_level=" +
        gradeLevel +
        "&section=" +
        section,
      true
    );
    xmlhttp.send();
  });
});

const submitGradeForm = document.querySelector(".submit-grade-form");

submitGradeForm.addEventListener("submit", (e) => {
  let finalGradeSubmit =
    submitGradeForm.childNodes[7].childNodes[1].childNodes[1].childNodes[3]
      .childNodes[3].childNodes[5].childNodes[1].childNodes[11].childNodes[1]
      .value;

  if (!finalGradeSubmit) {
    alert("Review grades before submitting.");
    e.preventDefault();
  } else {
    let text = "Are you sure you want to submit grades?";
    if (confirm(text) == false) {
      e.preventDefault();
    }
  }
});

const subjectToastBtn = document.querySelector("#subjects-toast-btn");
const subjectToast = document.querySelector("#subjects-toast");

subjectToastBtn.addEventListener("click", () => {
  subjectToast.classList.remove("hide");
  subjectToast.classList.add("show");
  console.log(subjectToast);
});
