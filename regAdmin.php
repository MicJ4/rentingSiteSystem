<!DOCTYPE html>
<html>
<head>
    <title>register an administrator</title>
    <link rel="stylesheet" href="register.css"/>
</head>
<body class="registrationBody"
style = "
 background-image: url(party.jpg);
    font-family:dubai;
    background-size:cover ;
    background-repeat: none;
    width: 100%;
    height: 100vh;
    overflow:hidden;
    justify-content: center;
"
>
    <div>
        <span class="rForm" id="rForm1" style="height:400px;">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <center><i>Please fill the form below to register an administrator:</i></center>
                <input type="text" placeholder="First Name" style="margin:5px 0px;" pattern="[A-Za-z]+" title="Enter your name please" name="firstName" id="firstName" required/>

                <input type="text" placeholder="Surname" style="margin:5px 0px;" pattern="[A-Za-z]+" title="Your surname please" name="lastName" id="lastName" required/>
                
                <span style="display: flex;flex-direction:row;padding-top:5px;margin-top:5px;" class="contact">
                    <input type="text" placeholder="username"  class="contact" pattern="[A-Za-z0-9]+" name="username" id="username" required/>
                </span>
                
                <span style="display: flex;flex-direction:row;padding-top:5px;margin-top:5px;" class="contact">
                    <input type="password" placeholder="Password" class="contact" pattern="[A-Za-z0-9]+" title="Password should only contain letters and numbers" name="passwords" id="passwords" required/>
                </span>

                <span>
                    <select class="regionsRegistration" name="cityTown">
                        <option selected disabled>City/Town</option>
                        <option>Arusha</option>
                        <option>Dar es salaam</option>
                        <option>Dodoma</option>
                        <option>Geita</option>
                        <option>Iringa</option>
                        <option>Kagera</option>
                        <option>Katavi</option>
                        <option>Kigoma</option>
                        <option>Kilimanjaro</option>
                        <option>Lindi</option>
                        <option>Manyara</option>
                        <option>Mara</option>
                        <option>Mbeya</option>
                        <option>Mjini magharibi (Zanzibar)</option>
                        <option>Morogoro</option>
                        <option>Mtwara</option>
                        <option>Mwanza</option>
                        <option>Njombe</option>
                        <option>Pemba Kaskazini</option>
                        <option>Pemba Kusini</option>
                        <option>Pwani</option>
                        <option>Rukwa</option>
                        <option>Ruvuma</option>
                        <option>Simiyu</option>
                        <option>Singida</option>
                        <option>Songwe</option>
                        <option>Tabora</option>
                        <option>Tanga</option>
                        <option>Unguja North</option>
                        <option>Unguja South</option>
                    </select>
                </span>
               
                
                <span style="display: flex;flex-direction:row;padding-top:5px;" >
                    <img src="phone.png" alt="" width="30px" />
                    <input type="text" placeholder="phone" style="width: 266px;margin-left:5px;" class="contact" pattern="[0-9]*" title="Please provide a valid phone number" name="phone" id="phone" required/>
                </span>
                
                <div class="buttonContainer" >
                    <button class="nextButton" type="submit" name="submit">
                        Sign Up
                    </button>
                </div>
            </form>
        </span>
    </div>
    
    <?php
   
    if (isset($_POST['submit'])) {
      
        $servername = "localhost"; 
        $username = "root"; 
        $password = ""; 
        $dbname = "rentingSite";

      
        $conn = new mysqli($servername, $username, $password, $dbname);

    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $passwords = $_POST['passwords'];
        $cityTown = $_POST['cityTown'];
        $phone = $_POST['phone'];
       
        $sql = "INSERT INTO userDetails (firstName, lastName, username , passwords ,cityTown, phone , userStatus)
                VALUES ('$firstName', '$lastName', '$username','$passwords','$cityTown', '$phone', 'admin')";

       
        if ($conn->query($sql) === TRUE) {
            echo " Admin registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

       
        $conn->close();
    }
    ?>

</body>
</html>