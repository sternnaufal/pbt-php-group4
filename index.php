<?php
require_once 'classes/UserContact.php';

$user = null;
$errorMassage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $address = $_POST['address'] ?? '';

    try {
        // Create a new UserContact object (OOP Requirement)
        $user = new UserContact($firstName, $lastName, $phoneNumber, $address);
    }
    catch (InvalidArgumentException $e) {
        // catch error message from UserContact class
        $errorMessage = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Form - PBO Tugas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
        <h1>Contact Form</h1>

    <?php if (!empty($errorMessage)): ?>
            <div class="error-box" style="color: #ff0019ff; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                <strong>Error!</strong> <?php echo $errorMessage; ?>
            </div>
        <?php
endif; ?>

        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="firstName">Firstname</label>
                <input type="text" id="firstName" name="firstName" placeholder="Enter your firstname" required value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="lastName">Lastname</label>
                <input type="text" id="lastName" name="lastName" placeholder="Enter your lastname" required value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="e.g. 08123456789" required value="<?php echo isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" placeholder="Enter your full address" required><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="submit-btn" id="submitBtn">Submit</button>
        </form>

        <?php if ($user): ?>
            <!-- Render formatted result using the UserContact object -->
            <?php echo $user->getFormattedResult(); ?>
        <?php
endif; ?>
    </div>
</body>
</html>
