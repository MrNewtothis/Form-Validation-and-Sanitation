<?php
session_start(); 

$userName = $userEmail = $userBiography = ''; //Shortcut
$errorMessages = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $userName = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $userEmail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $userBiography = filter_var(trim($_POST['biography']), FILTER_SANITIZE_STRING);
    
    // Validate user inputs
    if (empty($userName) || !preg_match("/^[a-zA-Z\s]*$/", $userName)) {
        $errorMessages['name'] = "Please enter a valid name (letters and spaces only, NO NUMBERS!).";
    }
    if (empty($userEmail) || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errorMessages['email'] = "Please enter a valid email";
    }
    if (empty($_POST['password']) || strlen($_POST['password']) < 8 || !preg_match("/[A-Z]/", $_POST['password'])) {
        $errorMessages['password'] = "Password must be at least 8 characters long and that contains at least 1 uppercase letter.";
    }
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $errorMessages['confirm_password'] = "Passwords doesn't match";
    }
    if (empty($_POST['gender'])) {
        $errorMessages['gender'] = "Please select your gender.";
    }
    if (empty($_POST['country'])) {
        $errorMessages['country'] = "Please select your country.";
    }
    if (empty($_POST['skills'])) {
        $errorMessages['skills'] = "Please select at least one skill.";
    }
    if (empty($userBiography) || strlen($userBiography) > 200) {
        $errorMessages['biography'] = "Biography is required and must be less than 200 characters.";
    }

    // If there's no error it'll proceed
    if (empty($errorMessages)) {
        // Stores user inputs
        $_SESSION['user'] = [
            'name' => $userName,
            'email' => $userEmail,
            'biography' => $userBiography,
            'gender' => $_POST['gender'],
            'country' => $_POST['country'],
            'skills' => $_POST['skills'],
        ];
        // Redirect to "about.php"
        header("Location: about.php");
        exit();
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Registration Form</title>
</head>
<body>

    <video class="video-background" autoplay muted loop>
        <source src="media/vid/Genshin.mp4" type="video/mp4">
        If this shows up its not supported
    </video>

   

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="text-center mb-4">Registration Form</h2>
                <form method="post" action="registration.php">
                    <table class="table table-borderless">
                        <tr>
                            <td><label>Name</label></td>
                            <td>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($userName); ?>">
                                <div class="text-danger"><?php echo isset($errorMessages['name']) ? $errorMessages['name'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($userEmail); ?>">
                                <div class="text-danger"><?php echo isset($errorMessages['email']) ? $errorMessages['email'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Password</label></td>
                            <td>
                                <input type="password" class="form-control" name="password">
                                <div class="text-danger"><?php echo isset($errorMessages['password']) ? $errorMessages['password'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Confirm Password</label></td>
                            <td>
                                <input type="password" class="form-control" name="confirm_password">
                                <div class="text-danger"><?php echo isset($errorMessages['confirm_password']) ? $errorMessages['confirm_password'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Gender</label></td>
                            <td>
                                <input type="radio" name="gender" value="Male" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'male') ? 'checked' : ''; ?>> Male
                                <input type="radio" name="gender" value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'female') ? 'checked' : ''; ?>> Female
                                <div class="text-danger"><?php echo isset($errorMessages['gender']) ? $errorMessages['gender'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Country</label></td>
                            <td>
                                <select name="country" class="form-control">
                                    <option value="">Select Country</option>
                                    <option value="Philippines" <?php echo (isset($_POST['country']) && $_POST['country'] === 'Philippines') ? 'selected' : ''; ?>>Philippines</option>
                                    <option value="USA" <?php echo (isset($_POST['country']) && $_POST['country'] === 'USA') ? 'selected' : ''; ?>>USA</option>
                                    <option value="Canada" <?php echo (isset($_POST['country']) && $_POST['country'] === 'Canada') ? 'selected' : ''; ?>>Canada</option>
                                    <option value="South Korea" <?php echo (isset($_POST['country']) && $_POST['country'] === 'South Korea') ? 'selected' : ''; ?>>South Korea</option>
                                </select>
                                <div class="text-danger"><?php echo isset($errorMessages['country']) ? $errorMessages['country'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Skills</label></td>
                            <td>
                                <input type="checkbox" name="skills[]" value="PHP" <?php echo (isset($_POST['skills']) && in_array('PHP', $_POST['skills'])) ? 'checked' : ''; ?>> PHP 
                                <input type="checkbox" name="skills[]" value="HTML" <?php echo (isset($_POST['skills']) && in_array('HTML', $_POST['skills'])) ? 'checked' : ''; ?>> HTML 
                                <input type="checkbox" name="skills[]" value="CSS" <?php echo (isset($_POST['skills']) && in_array('CSS', $_POST['skills'])) ? 'checked' : ''; ?>> CSS 
                                <input type="checkbox" name="skills[]" value="AJAX" <?php echo (isset($_POST['skills']) && in_array('AJAX', $_POST['skills'])) ? 'checked' : ''; ?>> AJAX 
                                <input type="checkbox" name="skills[]" value="JavaScript" <?php echo (isset($_POST['skills']) && in_array('JavaScript', $_POST['skills'])) ? 'checked' : ''; ?>> JavaScript 
                                <div class="text-danger"><?php echo isset($errorMessages['skills']) ? $errorMessages['skills'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Biography</label></td>
                            <td>
                                <textarea name="biography" class="form-control" rows="3"><?php echo htmlspecialchars($userBiography); ?></textarea>
                                <div class="text-danger"><?php echo isset($errorMessages['biography']) ? $errorMessages['biography'] : ''; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    

</body>
</html>

On this code apply it 

