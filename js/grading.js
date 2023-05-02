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

        reviewBtn.forEach((element) => {
          element.addEventListener("click", () => {
            finalGradesInput.forEach((element) => {
              let quarter1 =
                element.parentElement.parentElement.childNodes[3].childNodes[1]
                  .value.length == 0
                  ? (element.parentElement.parentElement.childNodes[3].childNodes[1].value = 60)
                  : element.parentElement.parentElement.childNodes[3]
                      .childNodes[1].value;
              let quarter2 =
                element.parentElement.parentElement.childNodes[5].childNodes[1]
                  .value.length == 0
                  ? (element.parentElement.parentElement.childNodes[5].childNodes[1].value = 60)
                  : element.parentElement.parentElement.childNodes[5]
                      .childNodes[1].value;
              let quarter3 =
                element.parentElement.parentElement.childNodes[7].childNodes[1]
                  .value.length == 0
                  ? (element.parentElement.parentElement.childNodes[7].childNodes[1].value = 60)
                  : element.parentElement.parentElement.childNodes[7]
                      .childNodes[1].value;
              let quarter4 =
                element.parentElement.parentElement.childNodes[9].childNodes[1]
                  .value.length == 0
                  ? (element.parentElement.parentElement.childNodes[9].childNodes[1].value = 60)
                  : element.parentElement.parentElement.childNodes[9]
                      .childNodes[1].value;

              // Mean
              let dividedTo = 4;

              if (quarter1 === "N/A") {
                quarter1 = 0;
                dividedTo--;
              }

              if (quarter2 === "N/A") {
                quarter2 = 0;
                dividedTo--;
              }

              if (quarter3 === "N/A") {
                quarter3 = 0;
                dividedTo--;
              }

              if (quarter4 === "N/A") {
                quarter4 = 0;
                dividedTo--;
              }

              console.log(quarter1);
              console.log(quarter2);
              console.log(quarter3);
              console.log(quarter4);

              let finalGrade =
                (parseFloat(quarter1) +
                  parseFloat(quarter2) +
                  parseFloat(quarter3) +
                  parseFloat(quarter4)) /
                dividedTo;

              if (isNaN(finalGrade)) {
                element.value = "Incomplete";
              } else {
                element.value = finalGrade.toFixed(2);
              }
            });
          });
        });
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
