const subjectToastBtn = document.querySelector("#subjects-toast-btn");
const subjectToast = document.querySelector("#subjects-toast");

subjectToastBtn.addEventListener("click", () => {
  subjectToast.classList.remove("hide");
  subjectToast.classList.add("show");
  console.log(subjectToast);
});
