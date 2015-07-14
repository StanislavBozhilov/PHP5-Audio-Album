<?php

class GenresModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM genres");
        return $statement->fetch_all(MYSQL_ASSOC);
    }
    public function createGenre($name) {
        if (!isset($name) || $name == '' ) {
            return false;
        }
        $statement = self::$db->prepare("INSERT INTO genres VALUES (NULL,?)");
        $statement->bind_param("s",$name);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}