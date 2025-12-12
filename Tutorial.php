<?php
echo "<h3>Task 1: Basic Output & Conditional Logic</h3>";
echo "Your Name: Avinav Ghimire<br>";
echo "Today's Date: " . date("Y-m-d") . "<br>";
$currentHour = date("H");
if ($currentHour < 12) {
    echo "It is Morning.";
} elseif ($currentHour < 18) {
    echo "It is Afternoon.";
} else {
    echo "It is Evening.";
}

echo "<hr><h3>Task 2: Temperature Decision Program</h3>";
$temp = 25;
if ($temp < 15) {
    echo "Cold";
} elseif ($temp <= 30) {
    echo "Warm";
} else {
    echo "Hot";
}

echo "<hr><h3>Task 3: Multiplication Table Generator</h3>";
?>
<form method="post">
    Enter a number: <input type="number" name="number">
    <input type="submit" name="task3" value="Generate">
</form>
<?php
if (isset($_POST['task3']) && isset($_POST['number'])) {
    $num = (int)$_POST['number'];
    for ($i = 1; $i <= 10; $i++) {
        echo "$num x $i = " . ($num * $i) . "<br>";
    }
}

echo "<hr><h3>Task 4: Reverse a String Without Built-in Functions</h3>";
?>
<form method="post">
    Enter a word: <input type="text" name="word">
    <input type="submit" name="task4" value="Reverse">
</form>
<?php
if (isset($_POST['task4']) && isset($_POST['word'])) {
    $word = $_POST['word'];
    $reversed = '';
    for ($i = strlen($word) - 1; $i >= 0; $i--) {
        $reversed .= $word[$i];
    }
    echo "Reversed: $reversed";
}

echo "<hr><h3>Task 5: Count the Number of Vowels</h3>";
?>
<form method="post">
    Enter a sentence: <input type="text" name="sentence">
    <input type="submit" name="task5" value="Count Vowels">
</form>
<?php
if (isset($_POST['task5']) && isset($_POST['sentence'])) {
    $sentence = strtolower($_POST['sentence']);
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    $count = 0;
    for ($i = 0; $i < strlen($sentence); $i++) {
        if (in_array($sentence[$i], $vowels)) {
            $count++;
        }
    }
    echo "Number of vowels: $count";
}

echo "<hr><h3>Task 6: Mini User Info Preview Form</h3>";
?>
<form method="post">
    Name: <input type="text" name="uname"><br>
    Age: <input type="number" name="age"><br>
    Favorite Programming Language: <input type="text" name="lang"><br>
    <input type="submit" name="task6" value="Preview">
</form>
<?php
if (isset($_POST['task6'])) {
    $uname = trim($_POST['uname'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $lang = trim($_POST['lang'] ?? '');
    if ($uname === '' || $age === '' || $lang === '') {
        echo "All fields are required!";
    } elseif (!is_numeric($age) || $age <= 0) {
        echo "Age must be a positive number!";
    } else {
        echo "Preview:<br>Name: $uname<br>Age: $age<br>Favorite Language: $lang";
    }
}

echo "<hr><h3>Task 7: Basic Form Validation – Required Fields</h3>";
?>
<form method="post">
    Full Name: <input type="text" name="fullname"><br>
    Email: <input type="text" name="email7"><br>
    <input type="submit" name="task7" value="Submit">
</form>
<?php
if (isset($_POST['task7'])) {
    $fullname = trim($_POST['fullname'] ?? '');
    $email7 = trim($_POST['email7'] ?? '');
    if ($fullname === '' || $email7 === '') {
        echo "<span style='color:red;'>All fields are required!</span>";
    } else {
        echo "<span style='color:green;'>All good!</span>";
    }
}

echo "<hr><h3>Task 8: Manual Email Format Check</h3>";
?>
<form method="post">
    Email: <input type="text" name="email8">
    <input type="submit" name="task8" value="Check">
</form>
<?php
if (isset($_POST['task8'])) {
    $email8 = trim($_POST['email8'] ?? '');
    if ($email8 === '' || strpos($email8, '@') === false || strpos($email8, '.') === false || strpos($email8, '@') === 0) {
        echo "Email format incorrect (basic check).";
    } else {
        echo "Email format looks okay.";
    }
}

echo "<hr><h3>Task 9: Password Rule Validator</h3>";
?>
<form method="post">
    Password: <input type="password" name="password9">
    <input type="submit" name="task9" value="Validate">
</form>
<?php
if (isset($_POST['task9'])) {
    $password9 = $_POST['password9'];
    $errors = [];
    if (strlen($password9) < 8) {
        $errors[] = "Minimum 8 characters required";
    }
    if (!preg_match('/[0-9]/', $password9)) {
        $errors[] = "Must include at least one number";
    }
    if (!preg_match('/[^a-zA-Z0-9]/', $password9)) {
        $errors[] = "Must include at least one special character";
    }
    if ($errors) {
        foreach ($errors as $e) {
            echo "$e<br>";
        }
    } else {
        echo "Password is valid!";
    }
}

echo "<hr><h3>Task 10: Simple Calculator Using Switch Case</h3>";
?>
<form method="post">
    Number 1: <input type="number" name="num1"><br>
    Number 2: <input type="number" name="num2"><br>
    Operation: <select name="operation">
        <option value="add">Add</option>
        <option value="subtract">Subtract</option>
        <option value="multiply">Multiply</option>
        <option value="divide">Divide</option>
    </select><br>
    <input type="submit" name="task10" value="Calculate">
</form>
<?php
if (isset($_POST['task10'])) {
    $num1 = (float)$_POST['num1'];
    $num2 = (float)$_POST['num2'];
    $operation = $_POST['operation'];
    $result = '';
    switch ($operation) {
        case 'add':
            $result = $num1 + $num2;
            break;
        case 'subtract':
            $result = $num1 - $num2;
            break;
        case 'multiply':
            $result = $num1 * $num2;
            break;
        case 'divide':
            if ($num2 == 0) {
                $result = 'Cannot divide by zero!';
            } else {
                $result = $num1 / $num2;
            }
            break;
        default:
            $result = 'Invalid operation!';
    }
    echo "Result: $result";
}

echo "<hr><h3>Task 11: Array Search Logic (Email Finder)</h3>";
$users = [
    ["email" => "ram@gmail.com"],
    ["email" => "sita@gmail.com"],
    ["email" => "hari@gmail.com"]
];
?>
<form method="post">
    Enter Email: <input type="text" name="newEmail">
    <input type="submit" name="task11" value="Check">
</form>
<?php
if (isset($_POST['task11'])) {
    $newEmail = trim($_POST['newEmail']);
    $exists = false;
    foreach ($users as $user) {
        if ($user['email'] === $newEmail) {
            $exists = true;
            break;
        }
    }
    if ($exists) {
        echo "Email already exists";
    } else {
        echo "Email available";
    }
}

echo "<hr><h3>Task 12: JSON Reading Exercise</h3>";
$jsonFile = 'products.json';
if (file_exists($jsonFile)) {
    $json = file_get_contents($jsonFile);
    $products = json_decode($json, true);
    if ($products) {
        foreach ($products as $product) {
            echo $product['name'] . " - Rs. " . $product['price'] . "<br>";
        }
    } else {
        echo "No products found.";
    }
} else {
    echo "products.json file not found.";
}

echo "<hr><h3>Task 13: Registration Preview Only</h3>";
?>
<form method="post">
    Name: <input type="text" name="regname"><br>
    Email: <input type="text" name="regemail"><br>
    Password: <input type="password" name="regpassword"><br>
    Confirm Password: <input type="password" name="regconfirm"><br>
    <input type="submit" name="task13" value="Preview">
</form>
<?php
if (isset($_POST['task13'])) {
    $regname = trim($_POST['regname'] ?? '');
    $regemail = trim($_POST['regemail'] ?? '');
    $regpassword = $_POST['regpassword'] ?? '';
    $regconfirm = $_POST['regconfirm'] ?? '';
    if ($regname === '' || $regemail === '' || $regpassword === '' || $regconfirm === '') {
        echo "All fields are required!";
    } elseif ($regpassword !== $regconfirm) {
        echo "Passwords do not match!";
    } else {
        $strength = (strlen($regpassword) >= 8 && preg_match('/[A-Z]/', $regpassword) && preg_match('/[0-9]/', $regpassword)) ? 'Strong' : 'Weak';
        echo "Registration Preview:<br>";
        echo "Name: $regname<br>";
        echo "Email: $regemail<br>";
        echo "Password Strength: $strength";
    }
}

echo "<hr><h3>Task 14: Convert Array to JSON</h3>";
$data = [
    "username" => "student123",
    "role" => "learner",
    "active" => true
];
$json = json_encode($data);
echo $json;

echo "<hr><h3>Task 15: Generate a Random 6-Digit OTP</h3>";
$otp = rand(100000, 999999);
echo "Your OTP is: $otp";

echo "<hr><h3>Task 16: Simulate a Simple Login</h3>";
?>
<form method="post">
    Username: <input type="text" name="loginuser"><br>
    Password: <input type="password" name="loginpass"><br>
    <input type="submit" name="task16" value="Login">
</form>
<?php
if (isset($_POST['task16'])) {
    $loginuser = trim($_POST['loginuser'] ?? '');
    $loginpass = $_POST['loginpass'] ?? '';
    if ($loginuser === 'admin' && $loginpass === '1234@admin') {
        echo "Welcome Admin";
    } else {
        echo "Invalid credentials";
    }
}
?>
