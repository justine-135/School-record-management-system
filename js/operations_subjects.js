const gradeLevelSelectSubject = document.querySelector(
  ".grade-level-select-subject"
);

const quarterSelect = document.querySelector(".quarters-select");

if (gradeLevelSelectSubject.value !== "Kindergarten") {
  quarterSelect.style.display = "block";
} else {
  quarterSelect.style.display = "none";
}

gradeLevelSelectSubject.addEventListener("change", (e) => {
  let value = e.target.value;
  if (value !== "Kindergarten") {
    quarterSelect.style.display = "block";
  } else {
    quarterSelect.style.display = "none";
  }
});
