<?php
// Define the database connection details
include("ajaxResponse/config.php");
// Check the connection
if ($conn == null) {
    $error = "Connection Problems, Check your Connection and Try again";
    throw new Exception("Connection Problems, Check your Connection and Try again");
}


// Define variables and initialize with empty values
$name = $contact = $email = $dob = $gender = $address = $gname = "";
$nameErr = $contactErr = $emailErr = $dobErr = $genderErr = $addressErr = $gnameErr = "";

// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



// Validate inputs and insert data into the database if all inputs are valid
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = sanitize_input($_POST["name"]);
        // Check that the name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["contact"])) {
        $contactErr = "Contact number is required";
    } else {
        $contact = sanitize_input($_POST["contact"]);
        // Check that the contact number only contains digits and has 10 digits
        if (!preg_match("/^[0-9]{10}$/", $contact)) {
            $contactErr = "Invalid contact number";
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        // Check that the email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["dob"])) {
        $dobErr = "Date of birth is required";
    } else {
        $dob = sanitize_input($_POST["dob"]);
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = sanitize_input($_POST["gender"]);
    }
    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
    } else {
        $address = sanitize_input($_POST["address"]);
    }
    if (empty($_POST["gname"])) {
        $gnameErr = "Guardian name is required";
    } else {
        $gname = sanitize_input($_POST["gname"]);
        // Check that the guardian name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $gname)) {
            $gnameErr = "Only letters and white space allowed";
        }
    }


    // If there are no errors, insert the data into the database
    if (empty($nameErr) && empty($contactErr) && empty($emailErr) && empty($dobErr) && empty($genderErr) && empty($addressErr) && empty($gnameErr)) {

//        SELECT `id`, `lang_id`, `patient_name`, `dob`, `age`, `month`, `day`, `image`, `mobileno`, `email`, `gender`, `marital_status`, `blood_group`, `blood_bank_product_id`, `address`, `guardian_name`, `patient_type`, `identification_number`, `known_allergies`, `note`, `is_ipd`, `app_key`, `insurance_id`, `insurance_validity`, `is_dead`, `is_active`, `disable_at`, `created_at` FROM `patients`
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO patients (patient_name, mobileno, email, dob, gender, address, guardian_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssss", $name, $contact, $email, $dob, $gender, $address, $gname);

        // Execute the statement and check if successful
        if ($stmt->execute()) {
            echo "New patient record created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo $nameErr.$contactErr.$emailErr.$dobErr.$genderErr.$addressErr.$gnameErr;

    }
} else {
    echo "Not server";
}