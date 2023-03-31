const ageSpan = document.querySelector(".age-calc");
const bdaySpan = document.querySelector(".bday");

const calculateAge = (birthday) => {
  const ageDifMs = Date.now() - new Date(birthday).getTime();
  const ageDate = new Date(ageDifMs);
  return Math.abs(ageDate.getUTCFullYear() - 1970);
};

ageSpan.innerHTML = "(" + calculateAge(bdaySpan.innerHTML) + ")";
