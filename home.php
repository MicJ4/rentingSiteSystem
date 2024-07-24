<!DOCTYPE html>
<html>
<head>
    <title>Upload Form</title>
    <link rel="stylesheet" href="home.css"/>
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
$contacts = $_POST["contacts"];
$targetDir = "photos/"; 


if ($_SERVER["REQUEST_METHOD"] == "POST" && $descriptions) {
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

    // Insert into the product table
    $sql = "INSERT INTO product (`imagePath`, `descriptions`, `locations`, `price`, `contacts`) 
    VALUES ('$targetFile', '$descriptions', '$locations', '$price', '$contacts')";

    if ($conn->query($sql) === TRUE) {
        // Product inserted successfully
        $lastProductId = $conn->insert_id;

        // Now, insert account details into the subscriptionDetails table
        $subscriptionSql = "INSERT INTO subscriptionDetails (`accountNumber`, `accountName`, `cvv`) 
        VALUES ('$accountNumber', '$accountName', '$cvv')";

        if ($conn->query($subscriptionSql) === TRUE) {
            echo "<span style='background-color:green;padding:4px;position:absolute;top:5%;left:5%;border-radius:4px;'>uploaded successfully</span>";
        } else {
            echo "Error: " . $subscriptionSql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<nav style="background-color:rgb(21,37,94);padding:20px;color:rgb(245, 245, 245);background-size:cover ;
    background-repeat: none;display:flex;justify-content:center;">
             <a href="search.php" style="color:rgb(245, 245, 245);font-weight:bold;padding:10px;font-size:130%;text-decoration:none;">Search</a>
             <span style="font-size:210%;">|</span>
             <a href="register.php" style="color:rgb(245, 245, 245);font-weight:bold;padding:10px;font-size:130%;text-decoration:none;">Create new account</a>
             <span style="font-size:210%;">|</span>
             <a href="login.php" style="color:rgb(245, 245, 245);font-weight:bold;padding:10px;font-size:130%;text-decoration:none;">Sign out</a>
             <span style="font-size:210%;">|</span>
             <a href="about.php" style="color:rgb(245, 245, 245);font-weight:bold;padding:10px;font-size:130%;text-decoration:none;">About us</a>
             
        </nav>

          
<div style="display:flex;justify-content:space-around;">
    <span>
<form method="post" enctype="multipart/form-data" class="postForm">
    <h1 class='formHead'>Advertise with us.</h1>
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
            <input class="pInput Pinput" type="text" placeholder="contact (0)" name="contacts"/>
        </span>
        <span>
            <input class="pInput Pinput" type="submit" value="Upload">
        </span>
    </form>
</span>

    <span style="width:500px;margin-top:10px;background-color:rgb(21,37,90);padding:10px 20px;color:rgb(245,245,245);border-radius:5px;">
    <img src="building.jpg" alt="" height="30%" width="104%" style="border-radius-bottom-left:5px" />
   
        <h2>This Summer!</h2>
        <p>
            <b>Renting site </b> staff also offers other advertisement services. Professionals are distributed all over the country , you
            name it , we make it.   
        </p>
        <p>
            <i>Posters</i> <br>
            We make both electric , 2D and 3D posters for businesses , hotels and lodges.
            The price is reasonably low for customers registered to our site.
        </p>
        <p>
            <i>Fliers</i> <br>
           We also make fliers for both government and private agencies.We make both coloured fliers and black & white fliers. 
        </p>

        <h2>
            Contact Us.
        </h2>
        <p>+255 789 984 990 (Dar Es Salaam) , +255 789 124 899 (Dodoma).</p>
        <p>+255 689 924 930 (Mwanza) , +255 754 984 597 (Arusha) .</p>
        <p>+255 789 984 990 (Other places).</p>
        <p>Email : rentingSite@gmail.com</p>
        

    </span>
</div>
    
    
   
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