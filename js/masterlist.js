const loadMasterList = (query) => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      const masterlist = document.querySelector(".masterlist");
      masterlist.innerHTML = this.responseText;

      const searchInput = document.querySelector(".search-input");
      const searchBtn = document.querySelector(".search-btn");
      const searchForm = document.querySelector(".search-form");
      let query;

      // Search query
      searchForm.addEventListener("submit", (e) => {
        e.preventDefault();
      });

      searchBtn.addEventListener("click", () => {
        query = searchInput.value;
        loadMasterList(query);
      });

      //   const informationBtns = document.querySelectorAll(".information-links");
      //   const informationForm = document.querySelector(".information-form");

      //   informationForm.addEventListener("submit", (e) => {
      //     e.preventDefault();
      //   });

      //   informationBtns.forEach((element) => {
      //     let informationBtn = element;

      //     informationBtn.addEventListener("click", () => {
      //       let id =
      //         informationBtn.parentElement.parentElement.childNodes[1].value;
      //       xmlhttp.open("GET", "./includes/student.inc.php?id=" + id, true);
      //       xmlhttp.send();
      //     });
      //   });
    }
  };
  if (query === undefined) {
    xmlhttp.open("GET", "./includes/student.inc.php?query=", true);
    xmlhttp.send();
  } else {
    xmlhttp.open("GET", "./includes/student.inc.php?query=" + query, true);
    xmlhttp.send();
  }
};

loadMasterList();

console.log("HElo");
