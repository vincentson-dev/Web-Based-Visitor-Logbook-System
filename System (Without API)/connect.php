<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];
    $Contact_Number = $_POST['Contact'];
    $Visit_Reason = $_POST['visit-reason']; // New addition to retrieve radio button value

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'visitor_registration1');
    if ($conn->connect_error) {
        die('Connection failed : ' . $conn->connect_error);
    } else {
        // Prepare SQL statement to insert data
        $stmt = $conn->prepare("INSERT INTO registration (Name, Email, Address, Contact, Visit_Reason) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $Name, $Email, $Address, $Contact_Number, $Visit_Reason);
        $stmt->execute();
        echo 'REGISTRATION SUCCESSFUL';

        // Close prepared statement and database connection
        $stmt->close();
        $conn->close();

        // Redirect to another page 
        header('Location: regcomplete.html');
        exit(); // Ensure that no more output is sent after redirection header
    }
}
?>
