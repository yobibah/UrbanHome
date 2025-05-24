<?php 
namespace model;
use config\Config;
use model\Typepropiete;

class TypepropieteBDD extends Typepropiete{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Config::getpdo()->getconnexion();
    }
    
    public function insertTypepropiete(Typepropiete $type): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO type_propriete (libelle) VALUES (:libelle)");
        return $stmt->execute([
            'libelle'=> $type->getlibele(),
        ]);
    }

    public function getTypepropiete(){
        $stmt = $this->pdo->prepare(query: "SELECT * FROM type_propriete ");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $typeproprietes = [];
        foreach ($data as $row) {
            $typeproprietes[] = [
                'id' => $row['id_type'],
                'objet'=> new Typepropiete($row['libelle']),
            ];
        }
        return $typeproprietes;
    }
}