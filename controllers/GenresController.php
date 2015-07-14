<?php

class GenresController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Genres";
        $this->db = new GenresModel();
    }

    public function index() {
        if ($this->isLoggedIn){
        $this->genres = $this->db->getAll();
        }
        else{
            $this->redirect("account","login");
        }
    }

    public function create() {
        if ($this->isPost) {
            $name = $_POST['genre-name'];

            if($this->playlist = $this->db->createGenre($name)){
                $this->addInfoMessage("Genre created !");
            }
            else{
                $this->addErrorMessage("Error creating genre !");
            }
            $this->redirect('genres');
        }

    }

    public function delete() {
    }
}