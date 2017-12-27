<?php
    class Account
    {
        private $con;
        private $errorArray;

        public function __construct($con)
        {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function login($email, $pass)
        {
            $encryptedPw = md5($pass);
            $query =  mysqli_query($this->con, "SELECT * FROM users WHERE email = '$email' AND password = '$encryptedPw'");
            if (mysqli_num_rows($query) == 1) {
                return true;
            } else {
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function register($name, $email, $pass1, $pass2)
        {
            $this->valdiateName($name);
            $this->valdiateEmail($email);
            $this->validatePasswords($pass1, $pass2);

            if (empty($this->errorArray) == true) {
                //Insert into db
                return $this->insertUserDetails($name, $email, $pass1);
            } else {
                return false;
            }
        }

        public function getError($error)
        {
            if (!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

        private function insertUserDetails($name, $email, $pass1)
        {
            $encryptedPw = md5($pass1);
            $date = date("Y-m-d");

            // echo  " INSERT INTO users (name, email , password, date) VALUES ('$name', '$email', '$encryptedPw', '$date') ";
            $result = mysqli_query($this->con, "INSERT INTO users (name, email , password, signUpDate) VALUES ('$name', '$email', '$encryptedPw', '$date')");

            return $result;
        }

        private function valdiateName($name)
        {
            if (strlen($name) > 25 || strlen($name) < 5) {
                array_push($this->errorArray, Constants::$nameCharacters);
                return;
            }

            //TODO: check if username exists
        }

        private function valdiateEmail($email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($this->errorArray, Constants::$emailInvalid);
                return;
            }
            //TODO: Check that username hasn't already been used
        }

        private function validatePasswords($pass1, $pass2)
        {
            if ($pass1 != $pass2) {
                array_push($this->errorArray, Constants::$passwordsDoNoMatch);
                return;
            }

            if (preg_match('/[^A-Za-z0-9]/', $pass1)) {
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
                return;
            }

            if (strlen($pass1) > 30 || strlen($pass1) < 5) {
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }
        }
    }
