const fetchpostsbtn = document.getElementById("fetchpost");
const postsarea = document.getElementById("postsarea");
const loading = document.getElementById("loader");
const postfocus = document.getElementsByClassName("posts-style");
var start = 0;
var limit = 3;
var more = true;
var output = "";
window.addEventListener("scroll", function () {        //Checks if we have reached the end of the page and loads more content
  var { scrollTop, scrollHeight, clientHeight } = document.documentElement;
  if (scrollTop + clientHeight >= scrollHeight && more) {
    loading.classList.add("show");
    setTimeout(() => {
      loading.classList.remove("show");
    }, 1000);
    setTimeout(() => {
      fetchpost();
    }, 1000);
  }
});
//Fire first query on load
$(document).ready(fetchpost);

function fetchpost(event) {
  if (!more) {
    return;
  }
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "cleaningreqs.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var params = "start=" + start + "&limit=" + limit;
  xhr.onload = function (event) {
    if (this.status == 200) {
      // console.log(this.responseText);
      if (this.responseText == "Reached") {
        postsarea.innerHTML +=
          "<a href='#'><div class='end'>End of the Feed</div></a>";
        more = false;
        return;
      }
      output = this.responseText;
      postsarea.innerHTML += output;
    }
  };
  xhr.send(params);
  start += limit;
}