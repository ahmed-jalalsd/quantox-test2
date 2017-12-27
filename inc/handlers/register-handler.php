<?php 

function sanitizeFormPassword($inputText)
{
    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitizeFormName($inputText)
{
    $inputText = strip_tags($inputText);
    return $inputText;
}

function sanitizeFormString($inputText)
{
    $inputText = strip_tags($inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}


if (isset($_POST['registerButton'])) {
    //Register button was pressed
    $name = sanitizeFormName($_POST['name']);
    $email = sanitizeFormString($_POST['email']);
    $password = sanitizeFormPassword($_POST['password']);
    $password2 = sanitizeFormPassword($_POST['password2']);

    $wasSuccessful = $account->register($name, $email, $password, $password2);

    if ($wasSuccessful == true) {
        header("Location: index.php");
    }
}
