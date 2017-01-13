<html>
<head>
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <style>
        div {
            width: 500px;
            height: 300px;
            border: 3px solid red;
        }
    </style>
</head>
<body>

<form>
    <input id="formUpload" type="button" value="zatwierdz" onclick="cropImage()">
</form>


<?php
$target_dir = "Images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo '<img id="imageLoad" onmouseover="Img()" src="' . $target_file . '" style="position:static; " >';

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


?>
<div id="a" onmousedown="elo(event)" onmouseup="clearCoor()" style="position:absolute; top:100px; left:100px;"></div>

<script>
    var a;
    var pokazuj = 0;
    var temx;
    var temy;
    var leftPoint;
    var rightPoint;
    var huj = 99;
    document.addEventListener("mousemove", showCoords);

    function cropImage() {

        obj = {"right": 0, "left": 0, "height": 0, "width": 0};
        console.log(huj);
        obj.right = rightPoint;
        dbParam = JSON.stringify(obj);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo").innerHTML = this.responseText;

            }
        }

        xmlhttp.open("POST", "cropImage.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("x=" + dbParam);
    }
    ;
    function showCoords(event) {
        if (pokazuj) {

            var img = document.getElementById("imageLoad");
            a = document.getElementById("a");
            var x = event.clientX;
            var y = event.clientY;
            a.style.setProperty("left", x - 100 + "px");
            a.style.setProperty("top", y - 50 + "px");
            //console.log(a.offsetLeft-img.offsetLeft);
            leftPoint = a.offsetLeft - img.offsetLeft;
            console.log(leftPoint);
            console.log(leftPoint);
            rightPoint = a.offsetRight - img.offsetRight;
            huj = rightPoint;
            // console.log(a.offsetRight);
            //console.log(img.offsetRight);

        }
    }

    function elo(event) {
        pokazuj = 1;
        temx = event.clientX;
        temy = event.clientY;


    }
    function clearCoor() {
        pokazuj = 0;

    }
    function Img() {


    }
</script>
<div id="demo">Making the Web Beautiful!</div>

</body>
</html>