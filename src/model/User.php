<?php

declare(strict_types=1);

namespace DealBreaker\Model;

class User extends Database
{

    // CREATE
    public function addNewUser(string $username): bool
    {
        $username = self::sanitizeInput($username);
        try {
            $query = "INSERT INTO users(username) VALUES (:username);";
            $stmt = parent::connect()->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            die('Query Failed: ' . $e->getMessage());
        }
    }
    // READ
    public function fetchUser($identifier, bool $isUsername = true): array
    {
        $identifier = self::sanitizeInput($identifier);
        try {
            if ($isUsername) {
                $query = "SELECT user_id, username, coins FROM users WHERE username = :identifier;";
            } else {
                $query = "SELECT user_id, username, coins FROM users WHERE user_id = :identifier;";
            }
            $stmt = parent::connect()->prepare($query);
            $stmt->bindParam(':identifier', $identifier);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die('Query Failed: ' . $e->getMessage());
        }
    }
    public function fetchUsers(): array
    {
        try {
            $sql = "SELECT user_id, username, coins FROM users ORDER BY user_id;";
            $stmt = parent::connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Query Failed: " . $e->getMessage());
        }
    }

    // UPDATE
    public function updateUser(int $user_id, string $username, int $coins): bool
    {
        $identifier = self::sanitizeInput($username);
        try {
            $sql = "UPDATE users 
                    SET username = :username,
                        coins = :coins
                    WHERE user_id = :user_id;";
            $stmt = parent::connect()->prepare($sql);
            $stmt->bindParam(':username', $identifier);
            $stmt->bindParam(':coins', $coins);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            die("Query Failed: " . $e->getMessage());
        }
    }

    // DELETE
    public function deleteUser(int $id): bool
    {
        try {
            $query = "DELETE FROM users
                    WHERE user_id = :id;";
            $stmt = parent::connect()->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            die('Query Failed: ' . $e->getMessage());
        }
    }
}
