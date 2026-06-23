<?php

class User
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Email verfication

    public function emailExists($email)
    {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";

        $checkEmail = $this->conn->prepare($sql);

        $checkEmail->execute([$email]);

        return $checkEmail->fetch() ? true : false;
    }

    // Registration & Authentication

    public function register(
        $fullname,
        $email,
        $password,
        $confirm_password
    ) {
        // Ensuring complete fields
        if (!empty($fullname) && !empty($email) && !empty($password) && !empty($confirm_password)) {

            // Confirming same passwords
            if ($password === $confirm_password) {


                // Checking if email exists
                if ($this->emailExists($email)) {

                    throw new Exception("Email already exists, please log in or use a different email");
                } else {

                    // Hashing password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Registering user
                    $sql = "INSERT INTO users (fullname, email, password, role, email_verified) VALUES (?, ?, ?, 'user', 0)";

                    $register = $this->conn->prepare($sql);

                    $register->execute([$fullname, $email, $hashedPassword]);

                    return true;
                }
            } else {
                throw new Exception("Incorrect password confirmation");
            }
        } else {
            throw new Exception("All fields must be filled.");
        }
    }

    ##################################################################################

    public function login(
        $email,
        $password
    ) {
        if (empty($email) || empty($password)) {
            throw new Exception("Please fill all fields");
        }

        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";

        $login = $this->conn->prepare($sql);

        $login->execute([$email]);

        $user = $login->fetch();

        // User not found
        if (!$user) {
            throw new Exception("Invalid credentials");
        }

        // Verify password
        if (!password_verify($password, $user->password)) {
            throw new Exception("Invalid credentials");
        }

        if (!$user->email_verified) {
            throw new Exception("Please verify your email to login");
        }

        return $user;
    }

    // User Retrieval

    public function getUserById($id)
    {
        if (empty($id)) {
            throw new Exception("Invalid user specified");
        }

        $sql = "SELECT *
            FROM users
            WHERE id = ?
            LIMIT 1";

        $find = $this->conn->prepare($sql);

        $find->execute([$id]);

        $user = $find->fetch();

        if (!$user) {
            throw new Exception("User not found");
        }

        return $user;
    }

    public function findByEmail($email) {}

    // Profile Management

    public function updateProfile(
        $id,
        $fullname,
        $email,
        $image
    ) {
        $user = $this->getUserById($id);

        // Keep existing values if empty
        $fullname = !empty($fullname) ? trim($fullname) : $user->fullname;

        $email = !empty($email) ? trim($email) : $user->email;

        // Email ownership check
        if ($email !== $user->email && $this->emailExists($email)) {
            throw new Exception(
                "Email already exists"
            );
        }

        // Keep current image by default
        $imageName = $user->profile_image;

        // New image uploaded?
        if (!empty($image['name'])) {

            $allowedExt = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];

            $extension = strtolower(
                pathinfo(
                    $image['name'],
                    PATHINFO_EXTENSION
                )
            );

            if (!in_array($extension, $allowedExt)) {
                throw new Exception(
                    "Invalid image format"
                );
            }

            if ($image['size'] > 5000000) {
                throw new Exception(
                    "Image must be less than 5MB"
                );
            }

            $imageName = time() . '_' . $image['name'];

            $targetPath =
                dirname(__DIR__)
                . "/uploads/profile-images/"
                . $imageName;

            if (
                !move_uploaded_file(
                    $image['tmp_name'],
                    $targetPath
                )
            ) {
                throw new Exception(
                    "Image upload failed"
                );
            }

            // Delete old image
            if (
                !empty($user->profile_image)
            ) {

                $oldImage =
                    dirname(__DIR__)
                    . "/uploads/profile-images/"
                    . $user->profile_image;

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
        }

        $sql = "UPDATE users
        SET
            fullname = ?,
            email = ?,
            profile_image = ?
        WHERE id = ?
    ";

        $update = $this->conn->prepare($sql);

        $update->execute([
            $fullname,
            $email,
            $imageName,
            $id
        ]);

        return true;
    }

    public function updatePassword(
        $id,
        $current_password,
        $new_password,
        $confirm_password
    ) {

        $user = $this->getUserById($id);

        if (
            empty($current_password) ||
            empty($new_password) ||
            empty($confirm_password)
        ) {
            throw new Exception(
                "All password fields are required"
            );
        }

        if (
            !password_verify(
                $current_password,
                $user->password
            )
        ) {
            throw new Exception(
                "Current password is incorrect"
            );
        }

        if ($new_password !== $confirm_password) {
            throw new Exception(
                "Password confirmation does not match"
            );
        }

        $hashedPassword = password_hash(
            $new_password,
            PASSWORD_DEFAULT
        );

        $sql = "
        UPDATE users
        SET password = ?
        WHERE id = ?
    ";

        $update = $this->conn->prepare($sql);

        $update->execute([
            $hashedPassword,
            $id
        ]);

        return true;
    }



    public function deleteAccount($user_id, $password)
    {
        // 1. Get user
        $user = $this->getUserById($user_id);

        if (!$user) {
            throw new Exception("User not found");
        }

        // 2. Verify password
        if (!password_verify($password, $user->password)) {
            throw new Exception("Incorrect password");
        }

        // 3. Delete profile image (if exists)
        if (!empty($user->profile_image)) {

            $profilePath = dirname(__DIR__) . "/uploads/profile-images/" . $user->profile_image;

            if (file_exists($profilePath)) {
                unlink($profilePath);
            }
        }

        // 4. Delete all user resources first
        $sqlResources = "SELECT file_name FROM resources WHERE user_id = ?";
        $stmt = $this->conn->prepare($sqlResources);
        $stmt->execute([$user_id]);
        $resources = $stmt->fetchAll();

        foreach ($resources as $res) {

            $filePath = dirname(__DIR__) . "/uploads/" . $res->file_name;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $deleteResources = "DELETE FROM resources WHERE user_id = ?";
        $stmt2 = $this->conn->prepare($deleteResources);
        $stmt2->execute([$user_id]);

        // 5. Delete user record
        $sqlUser = "DELETE FROM users WHERE id = ?";
        $stmt3 = $this->conn->prepare($sqlUser);
        $stmt3->execute([$user_id]);

        // 6. Destroy session
        session_start();
        $_SESSION = [];
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        return true;
    }




    // Email Verification

    public function createVerificationToken($userId) {}

    public function verifyEmail($token) {}

    public function requestEmailChange(
        $userId,
        $newEmail
    ) {}

    public function confirmEmailChange($token) {}




    // Admin Functions

    public function getAllUsers()
    {
        $sql = " SELECT id, fullname, email, role, email_verified, created_at FROM users ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function searchUsers($search)
    {
        $sql = " SELECT id, fullname, email, role, email_verified, created_at FROM users WHERE fullname LIKE ? OR email LIKE ? ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $searchTerm = "%{$search}%";

        $stmt->execute([
            $searchTerm,
            $searchTerm
        ]);

        return $stmt->fetchAll();
    }

    public function promoteUser($id)
    {

        $user = $this->getUserById($id);


        if (!$user) {
            throw new Exception("User not found");
        }

        if ($id == $_SESSION['user_id']) {
            throw new Exception(
                "You cannot perform this action on yourself"
            );
        }

        if ($user->role === 'admin') {
            throw new Exception("User is already an admin");
        }

        $sql = "UPDATE users SET role = 'admin' WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return true;
    }

    public function demoteUser($id)
    {
        $user = $this->getUserById($id);

        if (!$user) {
            throw new Exception("User not found");
        }

        if ($id == $_SESSION['user_id']) {
            throw new Exception(
                "You cannot demote yourself"
            );
        }

        if ($user->role !== 'admin') {
            throw new Exception(
                "User is not an admin"
            );
        }

        $sql = " UPDATE users SET role = 'user' WHERE id = ? ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return true;
    }

    public function adminDeleteUser($id)
    {
        $user = $this->getUserById($id);

        if (!$user) {
            throw new Exception("User not found");
        }

        if ($id == $_SESSION['user_id']) {
            throw new Exception(
                "You cannot perform this action on yourself"
            );
        }

        // Prevent deleting admins
        if ($user->role === 'admin') {
            throw new Exception(
                "Admins cannot be deleted from this action"
            );
        }

        // Remove profile image
        if (!empty($user->profile_image)) {

            $profileImage =
                dirname(__DIR__)
                . "/uploads/profile-images/"
                . $user->profile_image;

            if (file_exists($profileImage)) {
                unlink($profileImage);
            }
        }

        // Get resource files
        $sql = "
        SELECT file_name
        FROM resources
        WHERE user_id = ?
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        $resources = $stmt->fetchAll();

        foreach ($resources as $resource) {

            $filePath =
                dirname(__DIR__)
                . "/uploads/"
                . $resource->file_name;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete resources
        $deleteResources =
            $this->conn->prepare(
                "DELETE FROM resources WHERE user_id = ?"
            );

        $deleteResources->execute([$id]);

        // Delete user
        $deleteUser =
            $this->conn->prepare(
                "DELETE FROM users WHERE id = ?"
            );

        $deleteUser->execute([$id]);

        return true;
    }

    // Authorization Helpers

    public function isLoggedIn() {}

    public function isAdmin() {}

    public function getTotalUsers()
    {
        $sql = "SELECT COUNT(*) AS total FROM users";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch()->total;
    }

    public function getTotalAdmins()
    {
        $sql = "SELECT COUNT(*) AS total
        FROM users
        WHERE role = 'admin'
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch()->total;
    }

    public function getVerifiedUsers()
    {
        $sql = "SELECT COUNT(*) AS total
        FROM users
        WHERE email_verified = 1
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch()->total;
    }

    public function getRecentUsers($limit = 5)
    {
        $sql = "SELECT
            id,
            fullname,
            email,
            role,
            created_at
        FROM users
        ORDER BY created_at DESC
        LIMIT ?
    ";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(
            1,
            (int) $limit,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
