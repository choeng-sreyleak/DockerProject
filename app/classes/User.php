<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $email, $password) {
        try {
            // Check if username or email already exists
            $check_query = "SELECT id FROM " . $this->table_name . " WHERE username = :username OR email = :email";
            $check_stmt = $this->conn->prepare($check_query);
            $check_stmt->bindParam(':username', $username);
            $check_stmt->bindParam(':email', $email);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {
                return array('success' => false, 'message' => 'Username or email already exists');
            }

            // Insert new user
            $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($query);

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Bind parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);

            if ($stmt->execute()) {
                return array('success' => true, 'message' => 'User registered successfully');
            } else {
                return array('success' => false, 'message' => 'Registration failed');
            }

        } catch(PDOException $exception) {
            error_log("Registration error: " . $exception->getMessage());
            return array('success' => false, 'message' => 'Database error: ' . $exception->getMessage());
        }
    }

    public function login($username, $password) {
        try {
            $query = "SELECT id, username, email, password FROM " . $this->table_name . " WHERE username = :username OR email = :username";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $user['password'])) {
                    return array(
                        'success' => true,
                        'user' => array(
                            'id' => $user['id'],
                            'username' => $user['username'],
                            'email' => $user['email']
                        )
                    );
                } else {
                    return array('success' => false, 'message' => 'Invalid password');
                }
            } else {
                return array('success' => false, 'message' => 'User not found');
            }

        } catch(PDOException $exception) {
            error_log("Login error: " . $exception->getMessage());
            return array('success' => false, 'message' => 'Database error: ' . $exception->getMessage());
        }
    }

    public function getUserById($id) {
        try {
            $query = "SELECT id, username, email FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            return false;

        } catch(PDOException $exception) {
            error_log("Get user error: " . $exception->getMessage());
            return false;
        }
    }
}
?>