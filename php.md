#connect to database 
        $servername = "localhost";
        $username = "visal";
        $password = "visal@123";
        $dbname = "examdb";
        
        $conn = new mysqli($servername, $username, $password,$dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
#create student form in create.html
        <body>
        <h1>Create Student</h1>
            <form action="create.php" method="post" enctype="multipart/form-data">
                <div>
                    <label for="studentName">Student Name</label>
                    <input type="text" placeholder="Enter student name" id="studentName" name="studentName" required>
                </div>
                <div>
                    <label for="birthDate">Birth Date</label>
                    <input type="date"  id="birthDate" name="birthDate" required>
                </div>
                <div>
                    <label for="address">Address</label>
                <textarea  placeholder="Enter student name" id="address" name="address" required></textarea>
                </div>
                <div>
                    <label for="photo">Photo</label>
                    <input type="file"  id="photo" name="photo" required>
                </div>
                <button type="submit">Create Student</button>
            </form>
        </body>
#create.php file
    include "conn.php"; (this line using for $conn)
    
    //check name and birthdate already exit if exit == true
    function checkName($name,$conn){
        $sql = "SELECT *FROM student WHERE studentName='".$name."' and bithDate='".$_POST['birthDate']."'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0)
            return true;
        else
            return false;
    }
    
    
    
    //upload image to dir photos
    function uploadPhoto(){
        $oldpath = $_FILES['photo']['tmp_name'];
        $newpath ="photos/".$_FILES['photo']['name'];
        move_uploaded_file($oldpath, $newpath);
    }
    
    
    //Insert Data to database
    function addData($conn){
        $sql="INSERT INTO student (studentName, bithDate,address,photoName)
        VALUES ('".$_POST['studentName']."', '".$_POST['birthDate']."', '".$_POST['address']."','photos/".$_FILES['photo']['name']."')";
        if (mysqli_query($conn, $sql)) {
            echo "<h3>Create Student Successfully</h3>";
          uploadPhoto();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    if(checkName($_POST['studentName'],$conn)){
        echo "<h3>Student Information is Already exist</h3>";
    }
    else{
        addData($conn);
    }
    
    //print more and view
    echo "<a href='create.html'>More </a>";
    echo "<a href='display.php'> View</a>";
    
#display.php file
    include "conn.php";(this line using for connect database in conn.php)
    echo "<h3>All Students</h3>";
    $tbHeader = "<tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Birth Date</th>
                    <th>Address</th>
                    <th>Photo</th>
                </tr>";
    $tbBody = '';
    $sql = "SELECT *FROM student";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tbBody .= "<tr>
                            <td>".$row['studentId']."</td>
                            <td>".$row['studentName']."</td>
                            <td>".$row['bithDate']."</td>
                            <td>".$row['address']."</td>
                            <td><img src='".$row['photoName']."'/></td>
                       </tr>";
        }
        echo "<table>".$tbHeader.$tbBody."</table>";
    }
    
    //print more and view
    echo "<a href='create.html'>More </a>";
    echo "<a href='display.php'> View</a>";
