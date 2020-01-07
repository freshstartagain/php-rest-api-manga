<?php

class Manga
{
    // DB stuff
    private $conn;
    private $table = 'manga';

    // Properties
    public $id;
    public $name;
    public $synopsis;
    public $status;
    public $author_id;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get manga list
    public function read()
    {
        // Create query
        $query = 'SELECT a.name as author_name, m.id, m.name, m.synopsis, m.status, m.author_id, m.created_at 
                        FROM ' . $this->table . ' m 
                        LEFT JOIN 
                            authors a ON m.author_id = a.id 
                        ORDER BY
                            m.created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Get Single Manga
    public function read_single()
    {
        // Create query
        $query = 'SELECT a.name as author_name, m.id, m.name, m.synopsis, m.status, m.author_id, m.created_at 
                        FROM ' . $this->table . ' m 
                        LEFT JOIN 
                            authors a ON m.author_id = a.id 
                        WHERE
                            m.id = :id
                        LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data 
        $stmt->bindParam(':id', $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->name = $row['name'];
        $this->synopsis = $row['synopsis'];
        $this->status = $row['status'];
        $this->author_id = $row['author_id'];
        $this->author_name = $row['author_name'];
    }

    // Create Manga
    public function create()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET name = :name, synopsis = :synopsis, status = :status, author_id = :author_id';

        // Prepare statement
        $stmt =  $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->synopsis = htmlspecialchars(strip_tags($this->synopsis));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':synopsis', $this->synopsis);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':author_id', $this->author_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Update Manga
    public function update()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                             SET name = :name, synopsis = :synopsis, status = :status, author_id = :author_id
                             WHERE
                                id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->synopsis = htmlspecialchars(strip_tags($this->synopsis));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->id  = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':synopsis', $this->synopsis);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // Delete Manga
    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id  = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
