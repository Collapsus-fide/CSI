<?php
if (file_exists('../autoload.include.php')) {
    require_once('../autoload.include.php');
}else if(file_exists('autoload.include.php')){
    require_once('autoload.include.php');
}

class Commande extends Entity{

    public $id_commande;
    public $date_commande;
    public $date_retrait;
    public $horaire_retrait;
    public $commande_payee;
    public $prix_a_payer;
    public $etat_commande;

    /**
     * Usine pour fabriquer une instance à partir d'un identifiant.
     *
     * Les données seront issues de la base de données
     *
     * @param int $id identifiant BD de l'entité à créer
     *
     * @throws Exception si l'entité ne peut pas être trouvée dans la base de données
     *
     * @return self instance correspondant à $id
     */
    protected static function createFromId(int $id):array
    {
        $stmt = myPDO::getInstance()->prepare(<<<SQL
    SELECT *
    FROM Commande
    WHERE id_Commande = :id
SQL
        ) ;

        $stmt->execute([$id]) ;
        // Fetch des valeurs retournées.
        $stmt->setFetchMode(PDO::FETCH_CLASS, Commande::class) ;
        return $stmt->fetchAll();
    }

    /**
     * Accesseur à toutes les lignes de la table correspondantes.
     *
     * @return self[]
     * @throws Exception
     */
    protected static function getAll(): array
    {
        $stmt = MyPDO::getInstance()->prepare(<<<SQL
            SELECT *
            FROM Produit
SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, Produit::class);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Fait persister une instance dans la base de données avec ses attribut.
     * @return bool Selon la réussite de l'action
     * @throws Exception
     */
    public function persist(): bool
    {
        // Voir add ou modif
    }

    public static function supprimer(int $id){
        $data = [
            'id'=>$id
        ];
        $stmt = MyPDO::getInstance()->prepare(<<<SQL
        DELETE FROM Commande
        WHERE id_Commande = :id;
        
SQL
        );

        $stmt->execute($data);
    }

    public static function addCommande(int $id, string $libele){
        //TODO
    }

    public static function getByIdCli($id){
        $data = [
            'id'=>$id
        ];
        $stmt = MyPDO::getInstance()->prepare(<<<SQL
            SELECT *
            FROM commande
            where id_client = :id;
SQL
        );
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__);
        $stmt->execute($data);

        return $stmt->fetchAll();
    }

    public function getId(): int
    {
        return $this->id_commande;
    }
}