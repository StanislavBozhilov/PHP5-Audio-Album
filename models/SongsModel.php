<?php

class SongsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM songs");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllWithGenreAndPlaylist() {
        $statement = self::$db->query("SELECT s.id, s.name, s.path, g.name as genreName, p.name as playlistName FROM songs s JOIN playlists p ON s.playlist_id = p.id JOIN genres g ON p.genre_id = g.id ");

        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function findByPlaylist($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM songs WHERE playlist_id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function findById($id) {
        $statement = self::$db->prepare(
            "SELECT s.id, s.name, s.path, p.name as playlistName, g.name as genreName FROM songs s JOIN playlists p ON p.id = s.playlist_id AND s.id = ? JOIN genres g ON g.id = p.genre_id");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }



    public function create($name, $path, $playlistId) {
        $zero = 0;
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO songs VALUES (NULL, ?, ?, ?)");
        $statement->bind_param("ssi", $name, $path, $playlistId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
//    public function deleteSong($id) {
//        if (!isset($id) || $id == '' ) {
//            return false;
//        }
//        $statement = self::$db->prepare("DELETE FROM songs WHERE id = ?");
//        $statement->bind_param("i", $id);
//        $statement->execute();
//        return $statement->affected_rows > 0;
//    }
}
