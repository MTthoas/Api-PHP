<?php

require __DIR__ . "/../library/get-database-connection.php";

class MessageModel{

    public static function getAll(){
        $connection = getDatabaseConnection();
        $getUsersQuery = $connection->query("Select * from messages");
        $messages = $getUsersQuery->fetchAll();

        return $messages;
    }

    public static function create($message){
        $connection = getDatabaseConnection();
        $createUsersQuery = $connection->
            prepare("INSERT INTO messages(name,description) 
                    VALUES (:name,:description);");
        $createUsersQuery->execute($message);
    }

    public static function getById($id)
    {
        $connection = getDatabaseConnection();
        $getUserByIdQuery = $connection->prepare("SELECT * FROM messages WHERE id = :id;");

        $getUserByIdQuery->execute(
            [
            "id" => $id
            ]
        );

        $message = $getUserByIdQuery->fetch();

        return $message;
    }


    public static function deleteById($message)
    {
        $connection = getDatabaseConnection();
        $deleteByIdQuery = $connection->prepare("DELETE FROM messages WHERE id = :id;");
        $deleteByIdQuery->execute($message);
    }

    public static function updateById($json)
    {
        $allowedColumns = ["id","name", "description"];
        $columns = array_keys($json);
        $set = [];

        foreach ($columns as $column) {
            if (!in_array($column, $allowedColumns)) {
                continue;
            }

            $set[] = "$column = :$column";
        }

        $set = implode(", ", $set);
        $sql = "UPDATE messages SET $set WHERE id = :id";
        $connection = getDatabaseConnection();
        $query = $connection->prepare($sql);
        $query->execute($json);
    }


}