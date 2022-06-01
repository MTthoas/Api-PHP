<?php

class RoomModel{

    public static function getAll(){
        $connection = getDatabaseConnection();
        $getUsersQuery = $connection->query("Select * from rooms");
        $rooms = $getUsersQuery->fetchAll();

        return $rooms;
    }

    public static function create($room){
        $connection = getDatabaseConnection();
        $createUsersQuery = $connection->
            prepare("INSERT INTO rooms(name,description) 
                    VALUES (:name,:description);");
        $createUsersQuery->execute($room);
    }

    public static function getById($id)
    {
        $connection = getDatabaseConnection();
        $getUserByIdQuery = $connection->prepare("SELECT * FROM rooms WHERE id = :id;");

        $getUserByIdQuery->execute(
            [
            "id" => $id
            ]
        );

        $room = $getUserByIdQuery->fetch();

        return $room;
    }


    public static function deleteById($room)
    {
        $connection = getDatabaseConnection();
        $deleteByIdQuery = $connection->prepare("DELETE FROM rooms WHERE id = :id;");
        $deleteByIdQuery->execute($room);
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
        $sql = "UPDATE rooms SET $set WHERE id = :id";
        $connection = getDatabaseConnection();
        $query = $connection->prepare($sql);
        $query->execute($json);
    }


}