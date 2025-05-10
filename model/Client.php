<?php
class Client {
    public $id;
    public $nom;
    public $email;

    public function __construct($id, $nom, $email) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
    }
}
