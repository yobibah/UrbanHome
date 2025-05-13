<?php
namespace model;

require_once __DIR__ . '/../vendor/autoload.php';
use model\Users;
use config\Config;
Class Client extends Users {
    private $username;
 
    public function __construct(string $nom, string $prenom, string $email, string $password, $numero_telephone, $username, $adresse)
    {
        parent::__construct($nom, $prenom, $email, $password, $numero_telephone, $username, $adresse);
        $this->username = $username;
    }
     public function getusername(): string
    {
        return $this->username;
    }
 
  public function setUsername($username): string
{
    $this->username = $username;
    return $this->username;
}

}

//test sur limplementation de la classe Clientz

$client = new Client("Doe", "John", "johndoe@gmail.com", "password", "77777777", "johndoe", "rue de la paix");
echo ''.$client->setUsername("titi")."\n";
echo $client->getusername();
echo $client->getNom();
