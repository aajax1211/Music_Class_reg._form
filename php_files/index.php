<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation for First Name
    if (empty($_POST['first_name']) || !preg_match("/^[a-zA-Z]+$/", $_POST['first_name'])) {
        $errors['first_name'] = "Please enter a valid first name.";
    }

    // Validation for Last Name
    if (empty($_POST['last_name']) || !preg_match("/^[a-zA-Z]+$/", $_POST['last_name'])) {
        $errors['last_name'] = "Please enter a valid last name.";
    }

    // Validation for Date of Birth (User must be 18+)
    $dob = strtotime($_POST['dob']);
    $min_age = strtotime('-18 years');
    if (empty($_POST['dob']) || $dob > $min_age) {
        $errors['dob'] = "You must be at least 18 years old.";
    }

    // Validation for Gender
    if (empty($_POST['gender'])) {
        $errors['gender'] = "Please select your gender.";
    }

    // Validation for Email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email.";
    }

    // Validation for Phone Number (exactly 10 digits)
    if (empty($_POST['phone']) || !preg_match("/^[0-9]{10}$/", $_POST['phone'])) {
        $errors['phone'] = "Please enter a valid 10-digit phone number.";
    }

    // Validation for Music Class Type
    if (empty($_POST['music_class'])) {
        $errors['music_class'] = "Please select a music class type.";
    }

    // Validation for Preferred Class Timing
    if (empty($_POST['class_time'])) {
        $errors['class_time'] = "Please select a class timing.";
    }

    // Validation for Country
    if (empty($_POST['country'])) {
        $errors['country'] = "Please select your country.";
    }

    // Validation for Instrument Experience Level
    if (empty($_POST['experience'])) {
        $errors['experience'] = "Please select your experience level.";
    }

    // If no errors, redirect to success page
    if (empty($errors)) {
        header("Location: success.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Class Registration</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
<div class="image-container">
    
</div>
    <div class="form-container">
        <h2>Music Class Registration Form</h2>
        <form action="index.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" value="<?= isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>">
            <span class="error"><?= $errors['first_name'] ?? ''; ?></span>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" value="<?= isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>">
            <span class="error"><?= $errors['last_name'] ?? ''; ?></span>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" value="<?= isset($_POST['dob']) ? $_POST['dob'] : ''; ?>">
            <span class="error"><?= $errors['dob'] ?? ''; ?></span>

            <label>Gender:</label>
            <input type="radio" name="gender" value="Male" <?= isset($_POST['gender']) && $_POST['gender'] == 'Male' ? 'checked' : ''; ?>> Male
            <input type="radio" name="gender" value="Female" <?= isset($_POST['gender']) && $_POST['gender'] == 'Female' ? 'checked' : ''; ?>> Female
            <input type="radio" name="gender" value="Other" <?= isset($_POST['gender']) && $_POST['gender'] == 'Other' ? 'checked' : ''; ?>> Other
            <span class="error"><?= $errors['gender'] ?? ''; ?></span>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <span class="error"><?= $errors['email'] ?? ''; ?></span>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
            <span class="error"><?= $errors['phone'] ?? ''; ?></span>

            <label for="music_class">Music Class Type:</label>
            <select name="music_class" id="music_class">
                <option value="" disabled selected>Select your class</option>
                <option value="Guitar" <?= isset($_POST['music_class']) && $_POST['music_class'] == 'Guitar' ? 'selected' : ''; ?>>Guitar</option>
                <option value="Piano" <?= isset($_POST['music_class']) && $_POST['music_class'] == 'Piano' ? 'selected' : ''; ?>>Piano</option>
                <option value="Violin" <?= isset($_POST['music_class']) && $_POST['music_class'] == 'Violin' ? 'selected' : ''; ?>>Violin</option>
            </select>
            <span class="error"><?= $errors['music_class'] ?? ''; ?></span>

            <label for="class_time">Preferred Class Timing:</label>
            <select name="class_time" id="class_time">
                <option value="" disabled selected>Select class timing</option>
                <option value="Morning" <?= isset($_POST['class_time']) && $_POST['class_time'] == 'Morning' ? 'selected' : ''; ?>>Morning</option>
                <option value="Afternoon" <?= isset($_POST['class_time']) && $_POST['class_time'] == 'Afternoon' ? 'selected' : ''; ?>>Afternoon</option>
                <option value="Evening" <?= isset($_POST['class_time']) && $_POST['class_time'] == 'Evening' ? 'selected' : ''; ?>>Evening</option>
            </select>
            <span class="error"><?= $errors['class_time'] ?? ''; ?></span>

            <label for="country">Country:</label>
            <select name="country" id="country">
                <option value="" disabled selected>Select your country</option>
                <option value="USA" <?= isset($_POST['country']) && $_POST['country'] == 'USA' ? 'selected' : ''; ?>>USA</option>
                <option value="Canada" <?= isset($_POST['country']) && $_POST['country'] == 'Canada' ? 'selected' : ''; ?>>Canada</option>
                <option value="UK" <?= isset($_POST['country']) && $_POST['country'] == 'UK' ? 'selected' : ''; ?>>UK</option>
            </select>
            <span class="error"><?= $errors['country'] ?? ''; ?></span>

            <label for="experience">Instrument Experience Level:</label>
            <select name="experience" id="experience">
                <option value="" disabled selected>Select your experience level</option>
                <option value="New" <?= isset($_POST['experience']) && $_POST['experience'] == 'New' ? 'selected' : ''; ?>>New</option>
                <option value="Beginner" <?= isset($_POST['experience']) && $_POST['experience'] == 'Beginner' ? 'selected' : ''; ?>>Beginner</option>
                <option value="Intermediate" <?= isset($_POST['experience']) && $_POST['experience'] == 'Intermediate' ? 'selected' : ''; ?>>Intermediate</option>
                <option value="Advanced" <?= isset($_POST['experience']) && $_POST['experience'] == 'Advanced' ? 'selected' : ''; ?>>Advanced</option>
            </select>
            <span class="error"><?= $errors['experience'] ?? ''; ?></span>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    </div>
</body>
</html>
