<!DOCTYPE html>
<html>
<head>
    <title>Upload Form</title>
    <link rel="stylesheet" href="posting.css"/>
</head>
<body class="pBody">

<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "rentingSite";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$descriptions = $_POST["description"];
$locations = $_POST["locations"];
$price = $_POST["price"];
$accountNumber = $_POST["accountNumber"];
$accountName = $_POST["accountName"];
$cvv = $_POST["CVV"];


if ($_SERVER["REQUEST_METHOD"] == "POST" && $descriptions ) {
   
    $targetDir = "photos/"; 
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

    $photoPath = $targetFile;
  

    $sql = "INSERT INTO product (`imagePath` , `descriptions` , `locations` ,`price` ,`accountNumber` , `accountName` , `cvv` ) 
    VALUES ('$photoPath', '$descriptions' , '$locations' , '$price' , '$accountNumber' , '$accountName' , '$cvv' )";
    if ($conn->query($sql) === TRUE) {
        echo "<span style='background-color:green;padding:4px;position:absolute;top:5%;left:5%;border-radius:4px;'>uploaded successfully</span>";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>

    
    <form method="post" enctype="multipart/form-data" class="postForm">
    <h1 class='uploadImage'>Advertise with us.</h1>
        <span>
            <div style="display:flex;justify-content:center;">register your product for advertisement.</div>
            <input class="pInput Pinput" type="file" name="photo" accept="image/*" title="product photo is missing" required>
        </span>
        <span>
            <textarea class="pInput" name="description" placeholder="Description" rows="4" cols="50"></textarea>
        </span>
        <span>
            <input  class="pInput Pinput" type="text" placeholder="location" name="locations" id="location"/>
            <div id="suggestions" class="suggestions"></div>
        </span>
        <span>
            <input class="pInput Pinput" type="text" placeholder="price (per unit)" name="price"/>
        </span>
        <span>
            <input class="pInput Pinput" type="text" placeholder="account number" name="accountNumber"/>
        </span>
        <span>
            <input class="pInput Pinput" type="text" placeholder="Account's name" name="accountName"/>
        </span>
        <span>
            <input class="pInput Pinput" type="text" placeholder="CVV" name="CVV"/>
        </span>
        <span>
            <input class="pInput Pinput" type="submit" value="Upload">
        </span>
    </form>

    <script>
       
        const allowedInputs = 
        ["Arusha", "Dar es Salaam", "Dodoma", 
        "Geita", "Iringa", "Kagera",
        "Katavi" , "Kigoma" , "Kilimanjaro" , "Lindi" , "Manyara" , "Mara" ,
        "Mbeya" , "Mjini magharibi (Zanzibar)" , "Morogoro" ,
        "Mtwara" , "Mwanza" , "Njombe" , "Pemba kaskazini" , "Pemba kusini" ,
        "Pwani" , "Rukwa" , "Ruvuma" , "Simiyu" , "Singida" , "Songwe",
        "Tabora" , "Tanga" , "Unguja North" , "Unguja South"
    ];

        const inputElement = document.getElementById("location");
        const suggestionsElement = document.getElementById("suggestions");

        inputElement.addEventListener("input", function() {
            const inputValue = inputElement.value;
            const matchingSuggestions = allowedInputs.filter(input => input.toLowerCase().includes(inputValue.toLowerCase()));

            suggestionsElement.innerHTML = ""; 

            matchingSuggestions.forEach(suggestion => {
                const suggestionDiv = document.createElement("div");
                suggestionDiv.textContent = suggestion;
                suggestionDiv.addEventListener("click", function() {
                    inputElement.value = suggestion;
                    suggestionsElement.innerHTML = ""; 
                });
                suggestionsElement.appendChild(suggestionDiv);
            });
        });
    </script>

</body>
</html>
