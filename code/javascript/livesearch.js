// livesearch per città di partenza
function livesearch1(str) {
    if (str == "") {
        document.getElementById("livesearch1").innerHTML = "";
        return;
    }
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("livesearch1").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "javascript/search_city.php?q=" + str, true);
        xmlhttp.send();
    }
}

// livesearch per città di arrivo
function livesearch2(str) {
    if (str == "") {
        document.getElementById("livesearch2").innerHTML = "";
        return;
    }
    else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("livesearch2").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "javascript/search_city.php?q=" + str, true);
        xmlhttp.send();
    }
}


