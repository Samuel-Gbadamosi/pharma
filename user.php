<?php 
//to test for a receipt

class User {


    private $conn;


//connection to db with a private connection

    public function __construct(){
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "interuzzionedb";


        //create connection
        $this->conn = new mysqli($servername , $username , $password, $dbname);

        //check connection
        if($this->conn->connect_error){
            die("Connection failed :" . $this->conn->connect_error);
        }
    }

//function to add users to db
    public function addUser(){
        $sql = "INSERT INTO users(username , email) VALUES ('$username' , '$email')";

        if($this->conn->query($sql) === TRUE){
            return "New user added successfully";
        } else{
            return "Error:" . $sql . "<br>" .  $this->conn->error;
        }
    }

    //function to get user
    public function getUser($username){

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $this->conn->query($sql);

        if($result->num_rows > 0){
            //output data of each row
            while($row = $result->fetch_assoc()){
                return "Username: " . $row["username"]. " - Email :" . $row["email"];
            }
        }else{
            return "0 results";
        }

    }

//calling api to connec to db and display current weather
    function callApi(){
        $city = "Lagos";
        $sql = "SELECT get_weather('$city')";
        $result = $conn->query($sql);

        if($result->num_rows > 0) {
             while($row = $result->fetch_assoc()){
                 $weather_url = $row["get_weather('$city')"];

                 //get weather data from the API
                 $weather_data = file_get_contents($weather_url);
                 $weather_json = json_decode($weather_data);


                 //return the weather data as JSON
                 echo json_encode($weather_json);
             }
        }else{
            echo "0 results";
        }

        __destruct();
    }

    //destruct function
    public function __destruct(){
        $this->conn->close();
    }

}

$user = new User();
echo $user->addUser("johnDoe" ,"john@example.com");
echo $user->getUser("Precise");








?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>