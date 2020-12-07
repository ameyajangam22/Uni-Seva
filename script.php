<script>
        var visible = false;

        function toggleNav() {
            if (!visible) {
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
            } else {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
            }
            visible = !visible;
        }
    </script>
    <script>
        var state = true;
        var likes = 0;


        function likeme(event) {

            var post_id = event.currentTarget.name;
            // console.log(event.currentTarget.children[1].innerHTML);
            var like_count=event.currentTarget.children[1]
            // console.log('actually '+like_count);
            document.getElementById(post_id).classList.toggle("liked");
            if ($("#" + post_id).hasClass("liked")) {
                state = true;
                event.currentTarget.children[1].innerHTML = parseInt(event.currentTarget.children[1].innerHTML) + 1
            } else {
                state = false;
                event.currentTarget.children[1].innerHTML = parseInt(event.currentTarget.children[1].innerHTML) - 1
            }
            // console.log(post_id);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/spin/home/likes.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "state=" + state + "&post_id=" + post_id;
            // console.log(params);
            xhr.onload = function(event) {
                if (this.status == 200) {

                    // console.log(this.responseText);
                    if (this.responseText=="shaana") {
                        alert("chal hatt lombdi");
                        // console.log(like_count);
                        like_count.innerHTML = parseInt(like_count.innerHTML) - 1
                        // console.log(like_count);
                    }
                }
            }
            xhr.send(params);
        }
    </script>
    <script>
        function focuss(event) {
            var post_id = event.currentTarget.name;
            var start = event.currentTarget.value;
            console.log(post_id);
            // window.location = "/spin/php/postfocus.php?post_id=" + post_id + "&start=" + start;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/spin/posts/sessioncreate.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var params = "start=" + start + "&post_id=" + post_id;
            console.log(params);
            xhr.onload = function(event) {
                if (this.status == 200) {
                    console.log(this.responseText);
                    window.location = "/spin/posts/postfocus.php";
                }
            }
            xhr.send(params);

        }
    </script>
    <script src="feed.js"></script>