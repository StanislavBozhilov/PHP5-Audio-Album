<?php

class PlaylistsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM playlists");
        return $statement->fetch_all(MYSQL_ASSOC);
    }

    public function createPlaylist($name,$genre) {
        if (!isset($name) || $name == '' ) {
            return false;
        }
        $statement = self::$db->prepare("INSERT INTO playlists VALUES (NULL,?,?)");
        $statement->bind_param("si",$name,$genre);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}