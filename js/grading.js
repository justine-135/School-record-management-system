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
