<?php
$name = $email = $password = $confirm = '';
$errors = [];
$success = false;
$jsonFile = 'users.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    
    if ($name === '') {
        $errors['name'] = 'Name is required';
    }
    
    if ($email === '') {
        $errors['email'] = 'Email is required';
    } elseif (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
        $errors['email'] = 'Invalid email format';
    }
    
    if ($password === '') {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors['password'] = 'Password must contain at least one uppercase letter';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Password must contain at least one number';
    } elseif (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        $errors['password'] = 'Password must contain at least one special character';
    }
    
    if ($confirm === '') {
        $errors['confirm'] = 'Please confirm your password';
    } elseif ($password !== $confirm) {
        $errors['confirm'] = 'Passwords do not match';
    }
    
    if (empty($errors)) {
        try {
            $users = [];
            if (file_exists($jsonFile)) {
                $json = file_get_contents($jsonFile);
                if ($json) {
                    $users = json_decode($json, true);
                    if ($users === null) {
                        $users = [];
                    }
                }
            }
            
            $newUser = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            
            $users[] = $newUser;
            
            $jsonData = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            if (file_put_contents($jsonFile, $jsonData) !== false) {
                $success = true;
                $name = $email = $password = $confirm = '';
            } else {
                $errors['file'] = 'Error writing to file. Please try again.';
            }
        } catch (Exception $e) {
            $errors['file'] = 'An error occurred: ' . htmlspecialchars($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .error { color: red; font-size: 12px; }
        .success { color: green; padding: 10px; background: #e8f5e9; margin-bottom: 20px; border-radius: 4px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h2>User Registration Form</h2>
    
    <?php if ($success): ?>
        <div class="success">
            <strong>Success!</strong> You have been registered successfully.
        </div>
    <?php endif; ?>
    
    <?php if (isset($errors['file'])): ?>
        <div style="color: red; background: #ffebee; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
            <?= $errors['file'] ?>
        </div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="error"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="text" id="email" name="email" value="<?= htmlspecialchars($email) ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?= htmlspecialchars($password) ?>">
            <?php if (isset($errors['password'])): ?>
                <div class="error"><?= $errors['password'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="confirm">Confirm Password:</label>
            <input type="password" id="confirm" name="confirm" value="<?= htmlspecialchars($confirm) ?>">
            <?php if (isset($errors['confirm'])): ?>
                <div class="error"><?= $errors['confirm'] ?></div>
            <?php endif; ?>
        </div>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>
