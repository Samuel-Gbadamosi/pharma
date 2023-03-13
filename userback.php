<?php
//connection for the dating website banale
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "mydb";


//create Connection
function connectdB(){
    $conn = new mysqli($servername, $username , $password , $dbname);

//check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


echo "Connected Successfully";

}


//function to register user
function register_user($username, $password , $email , $name , $age , $gender){
    //connect to db
    $conn = new mysqli("localhost" , "username" , "password" ,"mydb");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    //check if usernam and email are taken 
    $sql = "SELECT * FROM users Where username='$username' OR email='$email' ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "Username or email already taken";
        return false;
    }
    //hash password
    $password_hash = password_hash($password , PASSWORD_DEFAULT);
    //INSERT user information in to db
    $sql = "INSERT INTO users(username ,password , email , name , age , gender) VALUES ('$username' , '$password_hash' , '$email' , '$name' , '$age' , '$gender')";
    if($conn->query($sql) === TRUE){
        echo 'User register Successfully';
        return true;
    }else{
        echo 'Error: ' . $sql . "<br>" . $conn->error;
        return false;
    }


    //close db connection
    $conn->close();

}

//login user fucntion
function login_user($username , $password){
//connect to db
    connectdB();
    //retrieve user info from db
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        //check if password matches
        if(password_verify($password , $row["password"])){
            //create session and redirect to user profile page
            session_start();
            $_SESSION["user_id"] = $row["id"];
            //takes you to users page
            header("Location : user_profile.php");
        }else{
            echo "Incorrect password";
        }
    }else{
        echo "username not found";
    }

    //close db connection
    $conn->close();

}

//get users profile 
//search users
function get_user_profile($userid){
    //connect to database
    connectdB();

    //retrieve users information from db
    $sql = "SELECT * from users WHERE id='$userid'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        //display user profile
        echo "Name: " .$row["name"] . "<br>";
        echo "Age : " .$row["age"] . "<br>";
        echo "Gender :" . $row["gender"] . "<br>";
    }else{
        echo "User not found";

    }

    //close databse connection
    $conn->close();

}

function search_users($search_query){
    //escape special character
    $search_query = mysqli_real_escape_string($conn , $search_query);

    //retrieve matching user info from db
    $sql = "SELECT * FROM users WHERE name LIKE '%$search_query%' or email LIKE '%$search_query%' or gender LIKE '%$search_query%' ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        //display search results
        echo "<table>";
        echo "<tr>
        <th> Name </th>
        <th> Email </th>
        <th> Age </th>
        <th> Gender </th>
        </tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "no result found";
    }

    //close connection
    $conn->close();

}




?>