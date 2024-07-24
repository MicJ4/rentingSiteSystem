<!DOCTYPE html>
<html>
<head>
    <title>Photo Search</title>
    <link rel="stylesheet" href="search.css"/>
</head>
<body class="sBody">
    <nav class="width:100%;">
        <img src="party2.jpg" alt="" width="100%" height="auto" style="border-radius:5px" />
        <div class="quickLinks" style="display:flex;justify-content:end;">
            <a href="login.php" style="color:rgb(21, 37, 94);text-decoration: none;padding: 1px 10px;">Login</a>
            |
            <a href="register.php" style="color:rgb(21, 37, 94);text-decoration: none;padding:1px 10px;">Sign up</a>
        </div>
    </nav>
    <form method="get" action="" class="sForm">
        <h1 class="head">let's find it!
        </h1>
        <span>
            <div> <input type="text" name="search" class="sInput" placeholder="I'm looking for..." autocoomplete="off" required></div>
            <span>
            <input  class="pInput Pinput" type="text" placeholder="location" name="locations" id="location" autocomplete="off"/>
            <div id="suggestions" class="suggestions"></div>
            </span>
            <span>
            <input class="sInput" type="submit" value="Search" id="sButton">
        </span>
        </span>
        
    </form>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rentingSite";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if(isset($_GET['search'])) {
        $search = $_GET['search'];
        $locations = $_GET['locations'];
   
        $sql = "SELECT * FROM product WHERE descriptions LIKE '%$search%' AND locations LIKE '%$locations%'";
        $result = $conn->query($sql);
        echo "<div style='display:flex;flex-direction:column;align-items:center;justify-content:center;'>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<span style='padding:20px;width:500px;'>";
                echo "<img src='".$row['imagePath'] . "' width='500px' height='auto' alt=''/>";
                echo "<p>" . $row['descriptions'] . "</p>";
                echo "<p style='font-style: italic ;color:rgb(21,37,94);'> <img src='./pin.png' alt='' width='20px' class='locationIcon'/>". $row['locations'] . " <span style='padding-left:3rem;'> wasiliana nasi: 0" .$row['contacts']." </span>
                </p>";
                echo "<p>Tsh".$row['price']."/= </p>";
                echo "</span>";
            }
        } else {
            echo "No matching results found.";
        }
        echo "</div>";
    }
    
    $conn->close();
    ?>

<a href="#" id="back-to-top">Back to Top</a>

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
