<?php

class login{
   

    public function select(){
       $servername ="localhost";
       $username="root";
       $password="ekenem12345";
       $dbname ="phpdb";

    //connect
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    //check connection
    if (!$conn){
      die("Connection failed: " .mysqli_connect_error());
    }
    echo "Connected successfully";

    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($_POST["username"])) {
      $usernameErr = "User Name is required";
    } else {
      $username = $this->test_input($_POST["username"]);
    }
  
    if (empty($_POST["password"])) {
      $passErr = "Email is required";
    } else {
      $pass =  $this->test_input($_POST["password"]);
    }

}

    $sql = "SELECT * FROM myguest WHERE Email='".$username."'";
    $result = mysqli_query($conn,$sql);
    
    if (mysqli_num_rows($result) == 1){
        while($row=mysqli_fetch_assoc($result)){
                if (password_verify($pass, $row['password'])){ 
                    //$login = true;
                   // session_start();
                    //$_SESSION['loggedin'] = true;
                    //$_SESSION['username'] = $username;
                    header("Location:forms-editors.html");
                } 
                else{
                    $showError = "Invalid Credentials";
                }
              }
    }
    else
    { echo "0 results";}
    
   
mysqli_close($conn);
  
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }








  public function insert(){
    $servername ="localhost";
    $username="root";
    $password="ekenem12345";
    $dbname ="phpdb";

 //connect
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 
 //check connection
 if (!$conn){
   die("Connection failed: " .mysqli_connect_error());
 }
 echo "Connected successfully";

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

 if (empty($_POST["Fname"])) {
   $FirstNameErr = "User Name is required";
 } else {
   $FirstName = $this->test_input($_POST["Fname"]);
 }

 if (empty($_POST["Lname"])) {
  $LastNameErr = "User Name is required";
} else {
  $LastName = $this->test_input($_POST["Lname"]);
}

if (empty($_POST["email"])) {
  $EmailErr = "User Email is required";
} else {
  $Email = $this->test_input($_POST["email"]);
}

 if (empty($_POST["password"])) {
   $passErr = "Email is required";
 } else {
  
   $pass=password_hash(($_POST["password"]), PASSWORD_DEFAULT);
 }

}

 $sql = "INSERT INTO myguest (FirstName, LastName, Email, password)
 VALUES ('".$FirstName."', '".$LastName."', '".$Email."','".$pass."' )";
 
 if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
 
 

mysqli_close($conn);

}
}
?>