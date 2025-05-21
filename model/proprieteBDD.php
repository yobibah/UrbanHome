<?php 
namespace model;
use  model\Propriete;
use config\Config;

class ProprieteBDD extends Propriete{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Config::getpdo()->getconnexion();
    }

    public function insertPropriete(Propriete $propriete): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO propriete (type, etat, adresse, prix, image1, image2, image3, description,id_bailleur) VALUES (:type, :etat, :adresse,:prix, :image1,:image2,:image3,:description,:id_bailleur)");
        return $stmt->execute([
            'type'=> $propriete->getType(),
            'etat'=>$propriete->getEtat(),
            'adresse'=> $propriete->getAdresse(),
            'prix'=>$propriete->getPrix(),
            'image1'=>$propriete->getImage1(),
            'image2'=>$propriete->getImage2(),
            'image3'=>$propriete->getImage3(),
            'description'=>$propriete->getDescription(),
            'id_bailleur'=>$propriete->getIdbailleur()
        ]);
    }
    public function getpropriete($limit,$ofset){
        $stmt = $this->pdo->prepare("SELECT * FROM propriete LIMIT :limit OFFSET :ofset");
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propriete'],
                'objet'=> new Propriete($row['type'], $row['etat'], $row['adresse'], $row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['description'],$row['id_bailleur']),
            ];
        }
        return $proprietes;
    }

    // cette fonction consiste a recuperer les donnes liees a la propriete et son bailleur pour l'Admin generale
    public function getAlldataforpropriete($limit,$ofset){
        $smt = $this->pdo->prepare("SELECT p.id_propriete,p.types,p.etat,p.adresse,p.prix,p.image1,p.image2,p.image3,p.description,b.nom,b.prenom,b.email,b.telephone,b.raison_social 
        FROM propriete p  

        INNER JOIN bailleur b ON p.id_bailleur = b.id_bailleur
        LIMIT :limit OFFSET :ofset");
        $smt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $smt->bindParam(':ofset', $ofset, \PDO::PARAM_INT); 
        $smt->execute();
        $data = $smt->fetchAll(\PDO::FETCH_ASSOC);
        $mot='';
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propriete'],
                'objet'=> new Propriete($row['types'], $row['etat'], $row['adresse'], $row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['description'],$row['id_bailleur']),
                'bailleur'=> new Bailleur($row['nom'], $row['prenom'], $row['raison_social'], $row['adresse'], $row['email'], $row['telephone'], $mot),
            ];
        }
        return $proprietes;
    }

    public function getProprieteById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM propriete WHERE id_propriete = :id");
        $stmt->execute([
            ':id'=>$id]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propriete'],
                'objet'=> new Propriete($row['type'], $row['etat'], $row['adresse'], $row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['description'],$row['id_bailleur']),
            ];
        }
        return $proprietes;
    }

    public function updatePropriete($id,$type,$etat,$adresse,$prix,$image1,$image2,$image3,$description): bool
    {
        $stmt = $this->pdo->prepare("UPDATE propriete SET type = ?, etat = ?, adresse = ?, prix = ?, image1 = ?, image2 = ?, image3 = ?, description = ? WHERE id_propriete = ?");
        return $stmt->execute([
            $type,
            $etat,
            $adresse,
            $prix,
            $image1,
            $image2,
            $image3,
            $description,
            $id
        ]);
    }
    public function deletePropriete($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM propriete WHERE id_propriete = ?");
        return $stmt->execute([$id]);
    }
    public function getProprieteByBailleurId($id_bailleur,$limit,$ofset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM propriete WHERE id_bailleur = :id_bailleur 
        LIMIT :limit OFFSET :ofset");
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':ofset', $ofset, \PDO::PARAM_INT);
        $stmt->execute([
            ':id_bailleur'=>$id_bailleur]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propriete'],
                'objet'=> new Propriete($row['type'], $row['etat'], $row['adresse'], $row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['description'],$row['id_bailleur']),
            ];
        }
        return $proprietes;
    }


    public function propriete_libre($limit,$ofset){
        $stmt = $this->pdo->prepare("SELECT * FROM propriete WHERE id_propriete NOT IN (SELECT id_propriete FROM location) 
        AND id_propriete NOT IN (SELECT id_propriete FROM achat)
        LIMIT :limit OFFSET :ofset");
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':ofset', $ofset, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propriete'],
                'objet'=> new Propriete($row['type'], $row['etat'], $row['adresse'], $row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['description'],$row['id_bailleur']),
            ];
        }
        return $proprietes;
    }

    


    // pour l'instantj'ai plus d'autres methodes a definir 

}