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
        let remarksInput = document.querySelectorAll(".remarks");

        let firstQuarterGrades = [];
        let secondQuarterGrades = [];
        let thirdQuarterGrades = [];
        let fourthQuarterGrades = [];

        reviewBtn.forEach((element) => {
          element.addEventListener("click", () => {
            getQuarterlyGrades();
            getFinalGrade();
          });
        });

        const getQuarterlyGrades = () => {
          firstQuarterGrades = [];
          secondQuarterGrades = [];
          thirdQuarterGrades = [];
          fourthQuarterGrades = [];

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

            if (hasInc > 0) {
              finalGradeInputs[i].value = "INC";
            } else if (isEmpty > 0) {
              finalGradeInputs[i].value = "";
            } else {
              finalGradeInputs[i].value = finalGrade.toFixed(2);
            }

            if (isNaN(finalGrade)) {
              finalGradeInputs[i].value = "INVALID";
            }

            if (finalGradeInputs[i].value == "") {
              remarksInput[i].value = "";
              console.log("ASD");
            } else if (finalGradeInputs[i].value >= 75) {
              remarksInput[i].value = "Passed";
            } else if (finalGradeInputs[i].value < 75) {
              remarksInput[i].value = "Failed";
            } else if (finalGradeInputs[i].value == "INC") {
              remarksInput[i].value = "INC";
            } else {
              remarksInput[i].value = "INVALID";
            }
          }
        };
        getQuarterlyGrades();
        getFinalGrade();
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
