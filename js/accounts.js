// Load all users
const loadUsers = (query) => {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      // Show HTML
      const masterlistTable = document.querySelector(".accounts-table");
      masterlistTable.innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "./includes/teachers.inc.php?index", true);
  xmlhttp.send();
};

loadUsers();
