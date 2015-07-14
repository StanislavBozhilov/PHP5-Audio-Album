<?php

class SongsController extends BaseController {

    public function onInit() {
        $this->title = 'Songs';
        $this->songsModel = new SongsModel();
        $this->playlistsModel = new PlaylistsModel();
    }

    public function index() {
        if ($this->isLoggedIn){
            $this->songs = $this->songsModel->getAllWithGenreAndPlaylist();
        }
        else{
            $this->redirect("account","login");
        }

    }

    public function playlist($id) {
        $this->playlistSongs = $this->songsModel->findByPlaylist($id);
    }

    public function id($id) {
        $this->song = $this->songsModel->findById($id);
        $this->songComments = $this->songsModel->songComments($id);
    }
    public function download() {
    // Make sure an ID was passed
    if(isset($_GET['id'])) {
    // Get the ID
    $id = intval($_GET['id']);
    // Make sure the ID is in fact a valid ID
    if($id <= 0) {
    die('The ID is invalid!');
    }
    else {
    // Connect to the database
    $dbLink = new mysqli('127.0.0.1', 'root', '', 'audio');
    if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
    }
    // Fetch the file information
    $query = "
    SELECT `id`,`name`, `path`
    FROM `songs`
    WHERE `id` = {$id}";
    $result = $dbLink->query($query);
        if($result) {
            // Make sure the result is valid
            if($result->num_rows == 1) {
                // Get the row
                $row = mysqli_fetch_assoc($result);

                header("Content-Disposition: attachment; filename=". $row['path']);
                $file = file_get_contents($row['path']);
                echo $file;
                //echo $row['path'];
            }
            else {
                echo 'Error! No image exists with that ID.';
            }

            // Free the mysqli resources
            @mysqli_free_result($result);
        }
    else {
    echo "Error! Query failed: <pre>{$dbLink->error}</pre>";
    }
    @mysqli_close($dbLink);
    }
    }
else {
    echo 'Error! No ID was passed.';
}

    }


    public function add() {
        if ($this->isPost) {
            $extension = pathinfo($_FILES["fileToUpload"]['name'], PATHINFO_EXTENSION);
            $size = $_FILES["fileToUpload"]["size"];
            $name = $_POST['name'];
            $playlist = $_POST['playlist'];
            $dir = 'content/songs/';
            $file = $dir . $playlist . '_' . $name . '.' . $extension;

            if(!$extension){
                $this->addErrorMessage('There is not song extension!');
                $this->redirect('songs', 'add');
                return false;
            }
            if($size > 5000000000) {
                $this->addErrorMessage('Maximum size exceeded!');
                $this->redirect('songs', 'add');
                return false;
            }
            if($extension != 'mp3' && $extension != 'wmv' && $extension != 'wav' &&$extension != 'ogg'){
                $this->addErrorMessage('Allowed song types are : mp3, wmv, wav');
                $this->redirect('songs', 'add');
                return false;
            }
            if (file_exists($file)) {
                $this->addErrorMessage('File already exist!');
                $this->redirect('songs', 'add');
                return false;
            }

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $file)) {
                $this->songsModel->create($name, $file, $playlist);
                $this->addInfoMessage('Successfully Added Song!');
                $this->redirect('songs', 'add', array($playlist));
                //
            } else {
                $this->addErrorMessage('Unable to Add Song!');
                $this->redirect('songs', 'add');
            }
        } else {

            $this->playlists = $this->playlistsModel->getAll();
        }
    }

//    public function delete() {
//        $this->songs = $this->db->getAll();
//        if ($this->isPost) {
//
//            $id = $_POST['id'];
//            if($this->songs = $this->db->deleteSong($id)){
//                $this->addInfoMessage("Song deleted successfully");
//
//            }
//            else{
//                $this->addErrorMessage("Error occurred during deleting.");
//
//            }
//            $this->redirect('songs');
//
//        }
//
//    }
}
