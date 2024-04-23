<?php
    if (isset($_POST['submit'])){
        $file = $_FILES['file'];
        $photoNum = $_POST['number'];
        echo '<pre>';
print_r($_FILES);
echo '</pre>';
echo $_POST['number'];
        
        
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        echo $fileActualExt;
        $allowed = array('jpg', 'jpeg', 'png');
        
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0){
                if ($fileSize < 1000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'Uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    include 'db_connect.php';

                    // Prepare SQL statement to update the profilepicture column in the profiles table
                    $sql = "UPDATE profiles SET photo" . $photoNum . " = '$fileDestination' WHERE userid = '{$_SESSION['userid']}'";
    
                    // Execute the SQL statement
                    if (mysqli_query($conn, $sql)) {
                        echo "Photo updated successfully!";
                    } else {
                    echo "Error updating about me: " . mysqli_error($conn);
                    }


                    header("Location: myprofile.php");
                } else {
                    "Your file is too big!";
                    header('Refresh: 10; URL=myprofile.php');
                }

            } else {
                echo "There was an error uploading your file!";
                header('Refresh: 10; URL=myprofile.php');

            }
        } else {
            echo "You cannot upload files of this type!";
            header('Refresh: 10; URL=myprofile.php');
        }
    }
    

?>