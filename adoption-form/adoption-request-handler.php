<?php
session_start();


require 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assign the POST data to variables
    $userId = $_SESSION['userID']; 
    $dogId = $_POST['dogId']; 
    $adoptionStatus = $_POST['adoptionStatus']; 
    $historyNote = $_POST['historyNote']; 
    
    // Prepare the SQL statement
    $sql = "INSERT INTO History (AdoptionDate, AdoptionStatus, HistoryNote, Dogtable_DogID, UserTable_UserID) VALUES (NOW(), ?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $adoptionStatus, $historyNote, $dogId, $userId);
    
    // Attempt to execute the statement
    if ($stmt->execute()) {
        echo "Adoption request submitted successfully.";
        // redirect or display a success message
    } else {
        echo "Error: " . $stmt->error;
        
    }
    
    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
