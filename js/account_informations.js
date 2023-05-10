const sectionSelect = document.querySelector(".section-select");
const loadSectionSelect = (gradeValue) => {
  let section;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      sectionSelect.innerHTML = this.responseText;
    }
  };
  section = sectionSelect.previousElementSibling.value;
  xmlhttp.open(
    "GET",
    "./includes/operations.inc.php?section_select=" + gradeValue,
    true
  );
  xmlhttp.send();
};

const gradeSelect = document.querySelector(".grade-select");
let gradeValue = gradeSelect.value;

gradeSelect.addEventListener("change", () => {
  gradeValue = gradeSelect.value;
  loadSectionSelect(gradeValue);
});

loadSectionSelect(gradeValue);

const addAdvisoryBtn = document.querySelector(".add-advisory");
const advisoryTable = document.querySelector(".advisory-table");
const advisoryTableTbody = document.querySelector(".advisory-table-tbody");

addAdvisoryBtn.addEventListener("click", () => {
  let result = checkTableData(gradeSelect.value, sectionSelect.value);
  if (result !== true) {
    let row = document.createElement("tr");

    let td = `
      <td>
        <input class="form-control grade-input" type="text" name="grade-level[]" value="${gradeSelect.value}" readonly/>
      </td>
      <td>
        <input class="form-control section-input" type="text" name="section[]" value="${sectionSelect.value}" readonly/>
      </td>
      <td>
        <button type="button" class="btn btn-danger remove-advisory">Remove</button>
      </td>
      `;

    row.innerHTML = td;

    advisoryTableTbody.appendChild(row);
  }

  const removeAdvisoryBtn = document.querySelectorAll(".remove-advisory");
  removeAdvisoryBtn.forEach((element) => {
    removeAdvisory(element);
  });
});

// Check if table row exists
const checkTableData = (gradeValue, sectionValue) => {
  let result = false;

  for (let i = 0, row; (row = advisoryTable.rows[i]); i++) {
    let gradeTd = row.childNodes[1];
    let sectionTd = row.childNodes[3];

    let gradeInput = gradeTd.childNodes[1];
    let sectionInput = sectionTd.childNodes[1];

    if (gradeInput !== undefined && sectionInput !== undefined) {
      if (
        gradeInput.value == gradeValue &&
        sectionInput.value == sectionValue
      ) {
        result = true;
      }
    }
  }

  return result;
};

// Remove advisory row
const removeAdvisory = (btn) => {
  btn.addEventListener("click", () => {
    btn.parentElement.parentElement.remove();
  });
};

const submitAdvisoryForm = document.querySelector(".submit-advisory-form");

submitAdvisoryForm.addEventListener("submit", (e) => {
  if (advisoryTableTbody.childNodes.length == 1) {
    e.preventDefault();
  }
});
