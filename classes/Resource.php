<?php

class Resource
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    //////////// Creating resources ////////////
    public function createResource($user_id, $title, $category, $description, $file)
    {

        // File extensions allowed
        $allowed_Ext = [
            'pdf',
            'docx',
            'doc',
            'epub',
            'pptx',
            'potx',
            'ppt',
            'md',
            'markdown',
            'txt',
            'xlsx',
            'csv',
            'xls',
            'gsheet',
            'png',
            'jpg',
            'jpeg'
        ];

        if (empty($title) || empty($category) || empty($description) || empty($file)) {
            throw new Exception('All fields must be filled');
        }

        // Handling files
        if (!empty($file['name'])) {

            $originalName = $file['name'];

            $fileExt = strtolower(
                pathinfo(
                    $originalName,
                    PATHINFO_EXTENSION
                )
            );

            $file_Name = uniqid('resource_', true) . '.' . $fileExt;

            $file_Size = $file['size'];
            $file_tmp = $file['tmp_name'];

            $target_Dir = dirname(__DIR__) . "/storage/resources/" . $file_Name;

            $file_ext = explode('.', $file_Name);
            $file_ext = strtolower(end($file_ext));

            if (!in_array($file_ext, $allowed_Ext)) {
                throw new Exception("Please upload file in a valid format");
            }

            if ($file_Size > 10000000) {
                throw new Exception("Maximuim file size should be 10mb");
            }

            if (!move_uploaded_file($file_tmp, $target_Dir)) {
                throw new Exception("File was not uploaded");
            }
        } else {
            throw new Exception("Please choose a file");
        }


        $sql = "INSERT INTO resources (user_id, title, category, description, file_name) VALUES (?, ?, ?, ?, ?)";

        $create = $this->conn->prepare($sql);

        $create->execute([$user_id, $title, $category, $description, $file_Name]);

        return true;
    }

    public function getUserResources($user_id)
    {
        if (empty($user_id)) {
            throw new Exception("Please log in to access resources");
        }

        $sql = "SELECT * FROM resources WHERE user_id = ? ORDER BY created_at ASC";

        $get = $this->conn->prepare($sql);

        $get->execute([$user_id]);

        $resources = $get->fetchAll();

        return $resources;
    }

    public function filterResources(
        $user_id,
        $category
    ) {
        $sql =
            "SELECT *
         FROM resources
         WHERE user_id = ?
         AND category = ?
         ORDER BY id DESC";

        $stmt =
            $this->conn->prepare($sql);

        $stmt->execute([
            $user_id,
            $category
        ]);

        return $stmt->fetchAll();
    }

    public function getUserResourcesPaginated(
        $user_id,
        $limit,
        $offset
    ) {
        $sql =
            "SELECT *
         FROM resources
         WHERE user_id = ?
         ORDER BY id DESC
         LIMIT ?
         OFFSET ?";

        $stmt =
            $this->conn->prepare($sql);

        $stmt->execute([
            $user_id,
            $limit,
            $offset
        ]);

        return $stmt->fetchAll();
    }

    public function getResourceById($id, $user_id)
    {
        if (empty($id) || empty($user_id)) {
            throw new Exception("No resource specified");
        }
        $sql = "SELECT * FROM resources WHERE id = ? AND user_id = ? LIMIT 1";

        $find = $this->conn->prepare($sql);

        $find->execute([$id, $user_id]);

        $resource = $find->fetch();

        if (!$resource) {
            throw new Exception("No resource was found");
        }

        return $resource;
    }

    public function updateResource(
        $id,
        $user_id,
        $title,
        $category,
        $description,
        $file
    ) {

        // Get existing resource
        $resource = $this->getResourceById($id, $user_id);

        if (!$resource) {
            throw new Exception("Resource not found");
        }

        $file_Name = $resource->file_name;

        // If new file uploaded
        if (!empty($file['name'])) {

            $allowed_Ext = [
                'pdf',
                'docx',
                'doc',
                'epub',
                'pptx',
                'potx',
                'ppt',
                'md',
                'markdown',
                'txt',
                'xlsx',
                'csv',
                'xls',
                'gsheet',
                'png',
                'jpg',
                'jpeg'
            ];

            $file_Ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

            if (!in_array($file_Ext, $allowed_Ext)) {
                throw new Exception("Invalid file type");
            }

            if ($file['size'] > 10000000) {
                throw new Exception("File too large");
            }

            $target_Dir = dirname(__DIR__) . "/storage/resources/" . $file['name'];

            if (!move_uploaded_file($file['tmp_name'], $target_Dir)) {
                throw new Exception("File upload failed");
            }

            $file_Name = $file['name'];
        }

        // Update DB
        $sql = "UPDATE resources
            SET title = ?,
                category = ?,
                description = ?,
                file_name = ?
            WHERE id = ?
            AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $title,
            $category,
            $description,
            $file_Name,
            $id,
            $user_id
        ]);

        return true;
    }

    public function deleteResource($id, $user_id)
    {
        if (empty($id) || empty($user_id)) {
            throw new Exception("Invalid delete request");
        }

        $sql = "DELETE FROM resources
            WHERE id = ?
            AND user_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id, $user_id]);

        return true;
    }

    public function getAllResources()
    {
        $sql = "SELECT resources.*, users.fullname FROM resources INNER JOIN users ON resources.user_id = users.id ORDER BY resources.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function searchResources($search)
    {
        $sql = "SELECT resources.*, users.fullname FROM resources INNER JOIN users ON resources.user_id = users.id WHERE resources.title LIKE ? OR resources.category LIKE ? OR users.fullname LIKE ? ORDER BY resources.created_at DESC";

        $stmt = $this->conn->prepare($sql);

        $searchTerm = "%{$search}%";

        $stmt->execute([
            $searchTerm,
            $searchTerm,
            $searchTerm
        ]);

        return $stmt->fetchAll();
    }



    public function getUserResourceCount($user_id)
    {
        $sql = "SELECT COUNT(*) AS total
        FROM resources
        WHERE user_id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$user_id]);

        return $stmt->fetch()->total;
    }



    public function getResourceByAdminId($id)
    {
        $sql = "SELECT *
         FROM resources
         WHERE id = ?
         LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function adminDeleteResource($id)
    {
        $resource = $this->getResourceByAdminId($id);

        if (!$resource) {
            throw new Exception(
                "Resource not found"
            );
        }

        $filePath =
            dirname(__DIR__)
            . "/storage/resources/"
            . $resource->file_name;

        if (file_exists($filePath)) {

            unlink($filePath);
        }

        $sql =
            "DELETE FROM resources
         WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return true;
    }

    public function getTotalResources()
    {
        $sql = " SELECT COUNT(*) AS total
        FROM resources";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetch()->total;
    }

    public function getRecentResources($limit = 5)
    {
        $sql = "SELECT
            resources.*,
            users.fullname

        FROM resources

        INNER JOIN users
            ON resources.user_id = users.id

        ORDER BY resources.created_at DESC

        LIMIT ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(
            1,
            (int) $limit,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getRecentUserResources(
        $user_id,
        $limit = 5
    ) {
        $sql = "SELECT *
        FROM resources
        WHERE user_id = ?
        ORDER BY created_at DESC
        LIMIT ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(1, $user_id, PDO::PARAM_INT);

        $stmt->bindValue(2, $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
