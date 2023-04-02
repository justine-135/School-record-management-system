// const loadinStudentInformation = () => {
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function () {
//     if (this.readyState == 4) {
//       const studentInformationDiv = document.querySelector(
//         ".student-information"
//       );
//       studentInformationDiv.innerHTML = this.responseText;
//     }
//   };
//   xmlhttp.open("GET", "./includes/student.inc.php?student", true);
//   xmlhttp.send();
// };

// loadinStudentInformation();

const ageSpan = document.querySelector(".age-calc");
const bdaySpan = document.querySelector(".bday");

// Calclulate age on birthdate
const calculateAge = (birthday) => {
  const ageDifMs = Date.now() - new Date(birthday).getTime();
  const ageDate = new Date(ageDifMs);
  return Math.abs(ageDate.getUTCFullYear() - 1970);
};
ageSpan.innerHTML = "(Age: " + calculateAge(bdaySpan.innerHTML) + ")";
