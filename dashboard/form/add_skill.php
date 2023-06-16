<?php
// Assuming you have established a database connection
include_once "../../pages/auth/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newSkill'])) {
    // Retrieve the new skill from the POST data
    $newSkill = $_POST['newSkill'];

    // Perform any necessary validation on the new skill
    if (!empty($newSkill)) {
        // Sanitize the new skill to prevent SQL injection
        $newSkill = mysqli_real_escape_string($koneksi, $newSkill);

        // Insert the new skill into the database
        $insertQuery = "INSERT INTO skills (SKILL_NAME) VALUES ('$newSkill')";
        $insertResult = mysqli_query($koneksi, $insertQuery);

        if ($insertResult) {
            // Retrieve the ID of the newly inserted skill
            $newSkillId = mysqli_insert_id($koneksi);

            // Return the ID as the response
            echo $newSkillId;
        } else {
            // Handle any errors that occurred during insertion
            echo "Error: " . mysqli_error($koneksi);
        }
    }
} else {
    // Handle invalid or missing request
    echo "Invalid request";
}