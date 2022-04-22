<?php


class Produit extends Entity
{

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
    protected static function createFromId(int $id): self
    {
// Préparation de la requête
        $stmt = myPDO::getInstance()->prepare(<<<SQL
    SELECT *
    FROM Produit
    WHERE id_Produit = :id
SQL
        ) ;

        $stmt->execute([$id]) ;
        // Fetch des valeurs retournées.
        $stmt->setFetchMode(PDO::FETCH_CLASS, __CLASS__) ;

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
        // voir addProd
    }

    public static function supprimer(int $id){
        $data = [
            'id'=>$id
        ];
        $stmt = MyPDO::getInstance()->prepare(<<<SQL
        DELETE FROM Produit
        WHERE id_prod = :id;
        
SQL
        );

        $stmt->execute($data);
    }
    public static function addProd(int $id, string $libele){
        $data = [
            ':id'=>$id,
            ':libele'=>$libele
        ];
        $stmt = MyPDO::getInstance()->prepare(<<<SQL
INSERT INTO Produit (num_prod,lib_prod)VALUES (:id, :libele);
SQL
        );
        $stmt->execute($data);

    }
}