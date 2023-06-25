    <?php
    include_once "../../assets/alert.php";
    include_once "../../pages/auth/koneksi.php";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if file is uploaded successfully
        if ($_FILES['pic']['error'] === UPLOAD_ERR_OK) {
            // Specify the target directory to save the uploaded file
            $targetDirectory = '../../uploads/';
            
            // Generate a unique name for the uploaded file
            $fileName = uniqid() . '_' . $_FILES['pic']['name'];
            
            // Specify the file path to save the file
            $filePath = $targetDirectory . $fileName;

            // Move the uploaded file to the specified path
            if (move_uploaded_file($_FILES['pic']['tmp_name'], $filePath)) {
                // File upload successful, display success message
                AlertMessage::displayAlert('success', 'Image uploaded successfully', 'check-circle-fill');

                // Save the file path to the database
                // Add your database code here to save the file path ($filePath) to the appropriate table and column
                $profilePicUrl = mysqli_real_escape_string($koneksi, $fileName);

                $idUser = $_SESSION['user']['ID_USER'];
                $sql = "UPDATE freelancers SET PROFILE_PIC_URL = '$profilePicUrl' WHERE id_user = $idUser";
                $result = mysqli_query($koneksi, $sql);
                if ($result) {
                    // Database update successful
                    AlertMessage::displayAlert('success', 'Profile picture updated successfully', 'check-circle-fill');
                } else {
                    // Database update failed
                    AlertMessage::displayAlert('danger', 'Failed to update profile picture', 'exclamation-triangle-fill');
                }
            } else {
                // File upload failed, display error message
                AlertMessage::displayAlert('danger', 'Failed to upload image', 'exclamation-triangle-fill');
            }
        } else {
            // File upload failed, display error message
            AlertMessage::displayAlert('danger', 'Failed to upload image', 'exclamation-triangle-fill');
        }

        // Retrieve the user's ID
        // $idUser = $_SESSION['id_user']; // Assuming you have the user's ID stored in a session

        // Retrieve the selected skills array
        $skills = $_POST['skills']; // Assuming 'skills' is the name of the checkbox group

        $queryFreelancerID = "SELECT id_freelancer FROM freelancers WHERE id_user = '$idUser'";
        $resultFreelancerID = mysqli_query($koneksi, $queryFreelancerID);
        $freelancerID = mysqli_fetch_assoc($resultFreelancerID)['id_freelancer'];

        // Insert the skills into the freelancer_skill table
        foreach ($skills as $skillId) {
            $sql = "INSERT INTO freelancer_skill (id_freelancer, id_skill) VALUES ('$freelancerID', '$skillId')";
            $result = mysqli_query($koneksi, $sql);

            if (!$result) {
                // Error: Failed to insert skill
                AlertMessage::displayAlert('danger', 'Failed to insert skill', 'exclamation-triangle-fill');
                exit; // Exit the loop if an error occurs
            }
        }

        // Success: Skills inserted
        AlertMessage::displayAlert('success', 'Skills inserted successfully!', 'check-circle-fill');

        $bio = mysqli_real_escape_string($koneksi, $_POST['bio']);
        $portfolioUrl = mysqli_real_escape_string($koneksi, $_POST['portofolio']);

        $sql = "UPDATE freelancers SET bio = '$bio', portofolio_url = '$portfolioUrl' WHERE id_user = $idUser";
        $result = mysqli_query($koneksi, $sql);
        if ($result) {
            AlertMessage::displayAlert('success', 'Bio and portfolio updated successfully', 'check-circle-fill');
        } else {
            AlertMessage::displayAlert('danger', 'Failed to update bio and portfolio', 'exclamation-triangle-fill');
        }

        header('Location: ../../dashboard/freelancer');
    }
