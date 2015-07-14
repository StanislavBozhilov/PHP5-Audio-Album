<?php

class PlaylistsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Playlists";
        $this->db = new PlaylistsModel();
    }

    public function index() {
        if ($this->isLoggedIn) {
            $this->playlists = $this->db->getAll();
        }
        else{
            $this->redirect("account","login");
        }
    }

    public function create() {
        if ($this->isPost) {
            $name = $_POST['playlist-name'];
            $genreId = $_POST['genre-id'];

            if($this->playlist = $this->db->createPlaylist($name,$genreId)){
                    $this->addInfoMessage("Playlist created");
            }
            else{
                    $this->addErrorMessage("Error creating playlist.");
            }
            //$this->redirect('playlists');
        }

        $genresModel = new GenresModel();
        $this->genres = $genresModel->getAll();

    }

    public function delete() {
    }
}