<?php 
namespace model;
use  model\Propriete;
use config\Config;
use PDO;

class ProprieteBDD extends Propriete{
    private $pdo;
    public function __construct()
    {
        $this->pdo=Config::getpdo()->getconnexion();
    }

    public function insertPropriete(Propriete $propriete): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO propriete (id_type, etat, opt, situation_geo,prix, image1, image2, image3, descriptions,id_bailleur,date_ajout) VALUES (:id_type, :etat, :opt, :situation_geo,:prix, :image1, :image2, :image3, :descriptions,:id_bailleur,:date_ajout)");
        return $stmt->execute([
            'id_type'=> $propriete->getIdType(),
            'etat'=>$propriete->getEtat(),
            'opt'=>$propriete->getOpt(),
            'situation_geo'=> $propriete->getAdresse(),
            'prix'=>$propriete->getPrix(),
            'image1'=>$propriete->getImage1(),
            'image2'=>$propriete->getImage2(),
            'image3'=>$propriete->getImage3(),
            'descriptions'=>$propriete->getDescription(),
            'id_bailleur'=>$propriete->getIdbailleur(),
            'date_ajout'=>$propriete->getDate()
        
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
                'objet'=> new Propriete($row['id_type'], $row['etat'], $row['opt'], $row['situation_geo'],$row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['descriptions'],$row['id_bailleur'],$row['date_ajout']),
            ];
        }
        return $proprietes;
    }

    // cette fonction consiste a recuperer les donnes liees a la propriete et son bailleur pour l'Admin generale
    public function getAlldataforpropriete($limit,$ofset){
        $smt = $this->pdo->prepare("SELECT p.id_propiete,p.id_type,p.etat,p.opt,p.situation_geo,p.prix,p.image1,p.image2,p.image3,p.descriptions,p.id_bailleur,p.date_ajout,b.nom,b.prenom,b.email,b.adresse, b.telephone,b.raison_social,t.libelle
        FROM propriete p  

        INNER JOIN bailleur b ON p.id_bailleur = b.id_bailleur
        INNER JOIN type_propriete t ON p.id_type = t.id_type
        WHERE p.etat = 'libre' 
        ORDER BY p.date_ajout DESC
        LIMIT :limit OFFSET :ofset 
        ");

        $smt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $smt->bindParam(':ofset', $ofset, \PDO::PARAM_INT); 
        $smt->execute();
        $data = $smt->fetchAll(\PDO::FETCH_ASSOC);
        $mot='';
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propiete'],
                'objet'=> new Propriete( $row['id_type'], $row['etat'], $row['opt'], $row['situation_geo'],$row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['descriptions'],$row['id_bailleur'],$row['date_ajout']),
                'bailleur'=> new Bailleur($row['nom'], $row['prenom'], $row['raison_social'], $row['adresse'], $row['email'], $row['telephone'], $mot),
                'type'=> new Typepropiete($row['libelle']),
            ];
        }
        return $proprietes;
    }

    public function getProprieteById($id)
    {
        $stmt = $this->pdo->prepare("SELECT *, t.libelle 
        FROM propriete 
        INNER JOIN type_propriete t ON propriete.id_type = t.id_type
        WHERE id_propiete = :id");
        $stmt->execute([
            ':id'=>$id]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propiete'],
                'type'=> new Typepropiete($row['libelle']),
                'objet'=> new Propriete($row['id_type'], $row['etat'], $row['opt'], $row['situation_geo'],$row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['descriptions'],$row['id_bailleur'],$row['date_ajout']),
            ];
        }
        return $proprietes;
    }
// cette fonction permet de modifier les proprietes

    public function deletePropriete($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM propriete WHERE id_propiete = ?");
        return $stmt->execute([$id]);
    }

// obtient les proprietes par bailleur
public function getProprieteByBailleurId($id_bailleur, $limit, $offset)
{
    $smt = $this->pdo->prepare("
        SELECT 
            p.id_propiete, p.id_type, p.etat, p.opt, p.situation_geo, p.prix,
            p.image1, p.image2, p.image3, p.descriptions, p.id_bailleur, p.date_ajout,
            b.nom, b.prenom, b.raison_social, b.adresse, b.email, b.telephone,
            t.libelle
        FROM propriete p  
        INNER JOIN bailleur b ON p.id_bailleur = b.id_bailleur
        INNER JOIN type_propriete t ON p.id_type = t.id_type
        WHERE p.id_bailleur = :id_bailleur
        ORDER BY p.date_ajout DESC
        LIMIT :limit OFFSET :offset
    ");

    $smt->bindParam(':id_bailleur', $id_bailleur, \PDO::PARAM_INT);
    $smt->bindParam(':limit', $limit, \PDO::PARAM_INT);
    $smt->bindParam(':offset', $offset, \PDO::PARAM_INT);

    $smt->execute();
    $data = $smt->fetchAll(\PDO::FETCH_ASSOC);

    $proprietes = [];
    foreach ($data as $row) {
        $mot = ''; // si mot de passe n'est pas nécessaire ici

        $proprietes[] = [
            'id' => $row['id_propiete'],
            'objet' => new Propriete(
                $row['id_type'], $row['etat'], $row['opt'], $row['situation_geo'],
                $row['prix'], $row['image1'], $row['image2'], $row['image3'],
                $row['descriptions'], $row['id_bailleur'], $row['date_ajout']
            ),
            'bailleur' => new Bailleur(
                $row['nom'], $row['prenom'], $row['raison_social'],
                $row['adresse'], $row['email'], $row['telephone'], $mot
            ),
            'type' => new Typepropiete($row['libelle']),
        ];
    }

    return $proprietes;
}



    public function propriete_libre($limit,$offset){
        $stmt = $this->pdo->prepare("SELECT * FROM propriete WHERE etat = 'libre'
        LIMIT :limit OFFSET :offset");
        
        $stmt->execute([
            ':limit'=>$limit,\PDO::PARAM_INT,
            ':ofset'=>$offset,\PDO::PARAM_INT,
        ]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $proprietes = [];
        foreach ($data as $row) {
            $proprietes[] = [
                'id' => $row['id_propiete'],
                'objet'=> new Propriete($row['id_type'], $row['etat'], $row['opt'], $row['situation_geo'],$row['prix'], $row['image1'], $row['image2'], $row['image3'], $row['descriptions'],$row['id_bailleur'],$row['date_ajout']),
            ];
        }
        return $proprietes;
    }

    

    
    //nombre de propriete par bailleur 
public function getNbProprieteByBailleurId($id_bailleur) {
    $req = "SELECT COUNT(*) as nb_proprietes FROM propriete WHERE id_bailleur = :id_bailleur";
    $smt = $this->pdo->prepare($req);
    $smt->execute(['id_bailleur' => $id_bailleur]);
    $resultat = $smt->fetch();
    return $resultat['nb_proprietes'];
}


    public function updateEtat($id){
        $stmt = $this->pdo->prepare("UPDATE propriete SET etat = 'ocuppe' WHERE id_propriete = :id");
        return $stmt->execute([
            ':id'=>$id
        ]);
    }

    public function UpdateOption($id,$opt){
        $stmt = $this->pdo->prepare("UPDATE propriete SET opt = :opt WHERE id_propriete = :id");
        return $stmt->execute([
            ':id'=>$id,
            ':opt'=>$opt
        ]);
    }

    public function getBannieresAccueil(): array {
    $sql = "SELECT image1 FROM propriete ORDER BY date_ajout DESC LIMIT 3";
    $stmt = $this->pdo->prepare($sql);
  $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $bannieres = [];
        foreach ($data as $row) {
            $bannieres[] = [
                'im' => $row['image1'],
                
            ];
        }
        return $bannieres;
    }
    

    public function countProprietesLibres(): int {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM propriete WHERE etat = 'libre'");
        return (int)$stmt->fetchColumn();
    }

   
    // pour l'instantj'ai plus d'autres methodes a definir 

    public function nbProprietesVendu($id_bailleur){
    
        $req= "SELECT COUNT(*) as nb_ventes FROM achat WHERE id_bailleur = :id_bailleur";
        $smt= $this->pdo->prepare($req);
        $smt->bindParam(":id_bailleur",$id_bailleur,\PDO::PARAM_INT);
        $smt->execute();
        $data = $smt->fetch(\PDO::FETCH_ASSOC);
        return $data['nb_ventes'] ?? 0;  
    }

      public function nbProprietesLouer($id_bailleur){
        $req= "SELECT COUNT(*) as nb_locataires FROM locations WHERE id_bailleur = :id_bailleur";
        $smt= $this->pdo->prepare($req);
        $smt->bindParam(":id_bailleur",$id_bailleur,\PDO::PARAM_INT);
        $smt->execute();
        $data = $smt->fetch();
        return $data['nb_locataires'] ?? 0;  
    }

    public function UpdateProprieteById($id, Propriete $propriete): bool
    {
        $stmt = $this->pdo->prepare("UPDATE propriete SET id_type = :id_type, etat = :etat, opt = :opt, situation_geo = :situation_geo, prix = :prix, image1 = :image1, image2 = :image2, image3 = :image3, descriptions = :descriptions WHERE id_propiete = :id");
        return $stmt->execute([
            'id_type' => $propriete->getIdType(),
            'etat' => $propriete->getEtat(),
            'opt' => $propriete->getOpt(),
            'situation_geo' => $propriete->getAdresse(),
            'prix' => $propriete->getPrix(),
            'image1' => $propriete->getImage1(),
            'image2' => $propriete->getImage2(),
            'image3' => $propriete->getImage3(),
            'descriptions' => $propriete->getDescription(),
            'id' => $id
        ]);

    }

    public function getimagesById($id) {
        $stmt = $this->pdo->prepare("SELECT image1, image2, image3 FROM propriete WHERE id_propiete = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }
}