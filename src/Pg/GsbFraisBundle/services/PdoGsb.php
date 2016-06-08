<?php
namespace Pg\GsbFraisBundle\services;
use PDO;
class PdoGsb{   		
	private static $monPdo;
	private static $monPdoGsb=null;
/**
 * Constructeur public, crée l'instance de PDO qui sera sollicitée
 * pour toutes les méthodes de la classe
 */				

        public function __construct($serveur,$bdd,$user,$mdp){
            PdoGsb::$monPdo = new PDO($serveur.';'.$bdd, $user, $mdp); 
            PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
               
	}
        
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crée l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}

        
        
/**
 * Retourne les informations d'un visiteur
 
 * @param $login 
 * @param $mdp
 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
*/
	public function getInfosVisiteur($login, $mdp){
             $req = "SELECT Visiteur.id as id, Visiteur.nom as nom, Visiteur.prenom as prenom, Visiteur.role as role, affectationt.nomtab as nomtab, bicyclette.marque as marque, bicyclette.genre as genre, affectation.idnumImmat as idnumImmat 
from Visiteur, affectation, affectationt, bicyclette
where  Visiteur.id = affectation.idVisiteur and 
        Visiteur.login='$login' and Visiteur.mdp='$mdp'
ORDER BY affectation.dateFin Desc";
		/*var_dump($req);*/
		$stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':log', $login);
		$stmt->bindParam(':md', $mdp);
                $stmt->execute();
		$ligne = $stmt->fetch();
            //    var_dump($ligne);
		return $ligne;
	}

     public function getbicyclette($id, $login, $mdp){
                $req = "SELECT nom, prenom, marque, couleur, genre FROM Visiteur, bicyclette WHERE Visiteur.id = bicyclette.id AND Visiteur.id= '".$id."'";
        //var_dump($req);
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $bicyclette = $stmt->fetchAll();
        
        return $bicyclette;
    }



    public function getListeVehicules($id){
                $req = "SELECT nom, prenom, numImmat, marque, modele, couleur, dateD, dateF FROM affectation, vehicule, Visiteur WHERE Visiteur.id = affectation.idVisiteur and affectation.idnumImmat=vehicule.numImmat and Visiteur.id= '".$id."'";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll();
        
        return $listevehicules;
    }

    


        public function getTouslesvehicules(){
                $req = "SELECT nom, prenom, numImmat, marque, modele, couleur, dateD, dateF FROM affectation, vehicule, Visiteur WHERE Visiteur.id = affectation.idVisiteur and affectation.idnumImmat=vehicule.numImmat";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll();
        
        return $listevehicules;
    }
        

            public function getInfosvehicules(){
                $req = "SELECT numImmat, marque, modele, couleur FROM vehicule";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll();
        
        return $listevehicules;
    }

        public function getInfostablette(){
                $req = "SELECT nomt, ext, inter, couleur, modele FROM tablette";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listetablette = $stmt->fetchAll();
        
        return $listetablette;
    }


            public function getImmat(){
                $req = "SELECT numImmat FROM vehicule";
            
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $listevehicules;
    }

            public function getVisiteur(){
                $req = "SELECT id, nom, prenom FROM Visiteur";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $listevehicules;
    }
              public function gettablette($id, $login, $mdp){
                $req = "SELECT nomt FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt AND Visiteur.id= '".$id."' ";
                
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $tablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $tablette;
    }

                  public function getintablette($id, $login, $mdp){
                $req = "SELECT inter FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt AND Visiteur.id= '".$id."' ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $intablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $intablette;
    }
                public function getextablette($id, $login, $mdp){
                $req = "SELECT ext FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt AND Visiteur.id= '".$id."' ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $extablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $extablette;
    }
                public function getnomtablette($id, $login, $mdp){
                $req = "SELECT nom FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt AND Visiteur.id= '".$id."' ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $nom = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $nom;
    }
                    public function getprenomtablette($id, $login, $mdp){
                $req = "SELECT prenom FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt AND Visiteur.id= '".$id."' ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $prenom = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $prenom;
    }

            public function getcouleurtablette($id, $login, $mdp){
                $req = "SELECT couleur FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt AND Visiteur.id= '".$id."' ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $couleur = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $couleur;
    }
            public function getmodeletablette($id, $login, $mdp){
                $req = "SELECT modele FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt AND Visiteur.id= '".$id."' ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $modele = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $modele;
    }
                public function getNom(){
                $req = "SELECT nom FROM Visiteur";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $listevehicules;
    }

                    public function getPrenom(){
                $req = "SELECT prenom FROM Visiteur";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $listevehicules;
    }



                    public function getPrenomNom(){
                $req = "SELECT prenom, nom, id FROM Visiteur";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetchAll();
        
        return $listevehicules;
    }
  public function Addvehicule($numImmat, $marque, $modele, $couleur){      
        $request = "INSERT INTO vehicule (numImmat, marque, modele, couleur) Value ('".$numImmat."', '".$marque."', '".$modele."', '".$couleur."')";
        var_dump($request);
        $sql= PdoGsb::$monPdo->prepare($request);
        $sql->execute();
        echo($request);
    }

    public function Addtablette($nomt, $ext, $inter, $couleur, $modele){      
        $request = "INSERT INTO tablette (nomt, ext, inter, couleur, modele) Value ('".$nomt."', '".$ext."', '".$inter."', '".$couleur."', '".$modele."')";
        var_dump($request);
        $sql= PdoGsb::$monPdo->prepare($request);
        $sql->execute();
        echo($request);
    }
     public function delvehicule($numImmat, $marque, $modele, $couleur){
                $req = "DELETE FROM vehicule WHERE affectation.idnumImmat =:numImmat ";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':numImmat', $numImmat);
                $stmt->execute();
    }


  public function Affectationvehicule($idnumImmat, $idVisiteur, $dateDebut, $dateFin){      
        $request = "INSERT INTO affectation (idnumImmat, idVisiteur, dateDebut, dateFin) Value ((SELECT numImmat from vehicule WHERE vehicule.numImmat ='".$idnumImmat."' ), (SELECT id from Visiteur WHERE Visiteur.id ='".$idVisiteur."' ), '2011-01-01', '2011-01-01')";
        var_dump($request);
        $sql= PdoGsb::$monPdo->prepare($request);
        $sql->execute();
        echo($request);
    }



     public function Affectationtablette($nomtab, $externe, $interne, $idVisiteur){      
        $request = "INSERT INTO affectationt (nomtab, externe, interne, idVisiteur) Value ((SELECT id from Visiteur WHERE Visiteur.id ='".$idVisiteur."' )";
        var_dump($request);
        $sql= PdoGsb::$monPdo->prepare($request);
        $sql->execute();
        echo($request);
    }



        public function getRole($id){
                $req = "SELECT role From visiteur where id ='".$id."'";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $listevehicules = $stmt->fetch();
        
        return $listevehicules;
    }

    public function gettest(){
     
// Check connection

$req = "INSERT INTO vehicule (numImmat, marque, modele, couleur)
VALUES ('BE 741 42', 'y', 'x', 'rouge')";
  $sql= PdoGsb::$monPdo->prepare($req);
$sql->execute();


    }

 public function gettab(){
     
// Check connection

$req = "INSERT INTO tablette (nomt, ext, inter, couleur, modele)
VALUES ('macin', '22', '05', 'a131')";
  $sql= PdoGsb::$monPdo->prepare($req);
$sql->execute();


    }


/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
 * concernées par les deux arguments
 
 * La boucle foreach ne peut être utilisée ici car on procède
 * à une modification de la structure itérée - transformation du champ date-
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
*/
	public function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur = :idVisiteur 
		and lignefraishorsforfait.mois = :mois ";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
		$stmt->bindParam(':mois', $mois);
                $stmt->execute();
		$lesLignes = $stmt->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
	}
/**
 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return le nombre entier de justificatifs 
*/
	public function getNbjustificatifs($idVisiteur, $mois){
		$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur =:idVisiteur and fichefrais.mois = :mois";
		$stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
		$stmt->bindParam(':mois', $mois);
                $stmt->execute();
		$laLigne = $stmt->fetch();
		return $laLigne['nb'];
	}
/**
 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
 * concernées par les deux arguments
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
*/
	public function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois= :mois 
		order by lignefraisforfait.idfraisforfait";	
		$stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
		$stmt->bindParam(':mois', $mois);
                $stmt->execute();
		$lesLignes = $stmt->fetchAll();
		return $lesLignes; 
	}
/**
 * Retourne tous les id de la table FraisForfait
 
 * @return un tableau associatif 
*/
	public function getLesIdFrais(){
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();
		$lesLignes = $stmt->fetchAll();
		return $lesLignes;
	}
/**
 * Met à jour la table ligneFraisForfait
 
 * Met à jour la table ligneFraisForfait pour un visiteur et
 * un mois donné en enregistrant les nouveaux montants
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
 * @return un tableau associatif 
*/
	public function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois = :mois
			and lignefraisforfait.idfraisforfait = :unIdFrais";
                         $stmt = PdoGsb::$monPdo->prepare($req);
                        $stmt->bindParam(':idVisiteur', $idVisiteur);
                        $stmt->bindParam(':mois', $mois);
                         $stmt->bindParam(':unIdFrais', $unIdFrais);
                        $stmt->execute();
		}
		
	}


    public function majImmat($idVisiteur, $idnumImmat){
        $lesCles = array_keys($lesImmats);
        foreach($lesCles as $IdnumImmat){
            $qte = $lesImmats[$IdnumImmat];
            $req = "UPDATE affectation set idnumImmat ='$idnumImmat' where idVisiteur='$idVisiteur' and dateDebut='$dateDebut'";
                         $stmt = PdoGsb::$monPdo->prepare($req);
                        $stmt->bindParam(':idVisiteur', $idVisiteur);
                        $stmt->bindParam(':idnumImmat', $idnumImmat);
                        
                        $stmt->execute();
        }
        
    }


/**
 * met à jour le nombre de justificatifs de la table ficheFrais
 * pour le mois et le visiteur concerné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
        public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs){
                $req = "update fichefrais set nbjustificatifs = :nbJustificatifs 
                where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->bindParam(':mois', $mois);
                $stmt->bindParam(':nbJustificatifs', $nbJustificatifs);
                $stmt->execute();
        }
/**
 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return vrai ou faux 
*/	
        public function estPremierFraisMois($idVisiteur,$mois)
        {
                $ok = false;
                $req = "select count(*) as nblignesfrais from fichefrais 
                where fichefrais.mois = :mois and fichefrais.idvisiteur = :idVisiteur";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->bindParam(':mois', $mois);
                $stmt->execute();
                $laLigne = $stmt->fetch();
                if($laLigne['nblignesfrais'] == 0){
                        $ok = true;
                }
                return $ok;
        }
          public function estPremierMat($idVisiteur,$idnumImmat)
        {
                $ok = false;
                $req = "select count(*) as nbnumImmat from affectation 
                where affectation.idnumImmat = :idnumImmat and affectation.idvisiteur = :idVisiteur";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->bindParam(':idnumImmat', $idnumImmat);
                $stmt->bindParam(':dateDebut', $dateDebut);
                $stmt->execute();
                $laLigne = $stmt->fetch();
                if($laLigne['nbnumImmat'] == 0){
                        $ok = true;
                }
                return $ok;
        }
/**
/**
 * Retourne le dernier mois en cours d'un visiteur
 
 * @param $idVisiteur 
 * @return le mois sous la forme aaaamm
*/	
        public function dernierMoisSaisi($idVisiteur){
                $req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = :idVisiteur";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->execute();
                $laLigne = $stmt->fetch();
                $dernierMois = $laLigne['dernierMois'];
                return $dernierMois;
        }
	
/**
 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
*/
        public function creeNouvellesLignesFrais($idVisiteur,$mois){
                $dernierMois = $this->dernierMoisSaisi($idVisiteur);
                $laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur,$dernierMois);
                if($laDerniereFiche['idEtat']=='CR'){
                                $this->majEtatFicheFrais($idVisiteur, $dernierMois,'CL');

                }
                $req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
                values(:idVisiteur,:mois,0,0,now(),'CR')";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                 $stmt->bindParam(':mois', $mois);
                $stmt->execute();
                $lesIdFrais = $this->getLesIdFrais();
                foreach($lesIdFrais as $uneLigneIdFrais){
                        $unIdFrais = $uneLigneIdFrais['idfrais'];
                        $req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
                        values(:idVisiteur,:mois,:unIdFrais,0)";
                        $stmt = PdoGsb::$monPdo->prepare($req);
                        $stmt->bindParam(':idVisiteur', $idVisiteur);
                        $stmt->bindParam(':mois', $mois);
                        $stmt->bindParam(':unIdFrais', $unIdFrais);
                        $stmt->execute();
                 }
        }
/**
 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
 * à partir des informations fournies en paramètre
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @param $libelle : le libelle du frais
 * @param $date : la date du frais au format français jj//mm/aaaa
 * @param $montant : le montant
*/
        public function creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$date,$montant){
                $dateFr = dateFrancaisVersAnglais($date);
                $req = "insert into lignefraishorsforfait 
                values('',:idVisiteur,:mois,:libelle,'$dateFr',:montant)";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->bindParam(':mois', $mois);
                $stmt->bindParam(':libelle', $libelle);
                $stmt->bindParam(':montant', $montant);
                $stmt->execute();
        }
/**
 * Supprime le frais hors forfait dont l'id est passé en argument
 
 * @param $idFrais 
*/
        public function supprimerFraisHorsForfait($idFrais){
                $req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =:idFrais ";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idFrais', $idFrais);
                $stmt->execute();
        }
/**
 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
 * @param $idVisiteur 
 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
*/
        public function getLesMoisDisponibles($idVisiteur){
                $req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur =:idVisiteur 
                order by fichefrais.mois desc ";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->execute();
                $laLigne = $stmt->fetch();
                $lesMois =array();
                while($laLigne != null)	{
                        $mois = $laLigne['mois'];
                        $numAnnee =substr( $mois,0,4);
                        $numMois =substr( $mois,4,2);
                        $lesMois["$mois"]=array(
                        "mois"=>"$mois",
                        "numAnnee"  => "$numAnnee",
                        "numMois"  => "$numMois"
                        );
                        $laLigne = $stmt->fetch(); 		
                }
                return $lesMois;
        }
/**
 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/	
        public function getLesInfosFicheFrais($idVisiteur,$mois){
                $req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
                        ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
                        where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->bindParam(':mois', $mois);
                $stmt->execute();
                $laLigne = $stmt->fetch();
                return $laLigne;
        }
/**
 * Modifie l'état et la date de modification d'une fiche de frais
 
 * Modifie le champ idEtat et met la date de modif à aujourd'hui
 * @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 */
 
        public function majEtatFicheFrais($idVisiteur,$mois,$etat){
                $req = "update ficheFrais set idEtat = :etat, dateModif = now() 
                where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
                $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':idVisiteur', $idVisiteur);
                $stmt->bindParam(':mois', $mois);
                $stmt->bindParam(':etat', $etat);
                $stmt->execute();

        }
/**
 * Retourne toutes les fiches de frais dont l'état est à validé
 * @return type
 */
        public function getLesFichesValidees()
        {
            $req = "select * from fichefrais
                    inner join etat on fichefrais.idetat = etat.id
                    inner join visiteur on visiteur.id = fichefrais.idVisiteur
                    where idetat = 'VA'";	
            $stmt = PdoGsb::$monPdo->prepare($req);
            $stmt->execute();
            $lesLignes = $stmt->fetchAll();
            return $lesLignes; 
        }
/**
 * Vérifie si un frais existe pour un visiteur et un mois donné
 * @param type $idVisiteur
 * @param type $mois
 * @param type $idFrais
 * @return 1 ou 0
 */
        public function estValideSuppressionFrais($idVisiteur,$mois,$idFrais){
            $req = "select count(*) as nb from lignefraishorsforfait 
            where lignefraishorsforfait.id=:idfrais and lignefraishorsforfait.mois=:mois
            and lignefraishorsforfait.idvisiteur=:idvisiteur";
            $stmt = PdoGsb::$monPdo->prepare($req);
            $stmt->bindParam(':idfrais', $idFrais);
            $stmt->bindParam(':mois', $mois);
            $stmt->bindParam(':idvisiteur', $idVisiteur);
            $stmt->execute();
            $ligne = $stmt->fetch();
            return $ligne['nb'];

        }

 /* @param $idVisiteur 
 * @param $mois sous la forme aaaamm
 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
*/ 

 public function Immat($idVisiteur,$idnumImmat){

        $dateDebut=date(("d/m/Y"));
        $reqtest ="SELECT * From affectation Where idVisiteur='$idVisiteur' and dateDebut='$dateDebut'";
        $res = PdoGsb::$monPdo->query($reqtest);
        $laLigne = $res->fetch();
        if($laLigne[0]==null){
            $req= "INSERT INTO affectation(idVisiteur,dateDebut,idnumImmat) VALUES ('$idVisiteur','$dateDebut','$idnumImmat')";
            PdoGsb::$monPdo->exec($req);
            echo "Ajout de l'immatriculation ".$idnumImmat;          
        }
        else{
            $req= "UPDATE affectation set idnumImmat ='$idnumImmat' where idVisiteur='$idVisiteur' and dateDebut='$dateDebut'";
            PdoGsb::$monPdo->exec($req);
            echo "Modification de l'immatriculation pour le mois ".$idnumImmat;
        }
            

        
    }

    /**
    *Verification d'un couple nom prenom de visiteur et renvoie l'IdVisiteur

    *
    *@param $nom
    *@param $prenom
    */
    
    public function vExistanceVisiteur($idVisiteur, $nom, $prenom){   

        $req ="SELECT Visiteur.id
                FROM Visiteur
                WHERE Visiteur.nom='$nom' AND Visiteur.prenom ='$prenom'";
        $res = PdoGsb::$monPdo->query($req);
        $idValide =$res->fetch();
        if (isset($idValide)){ 
            $ExistanceVisiteur = $idValide[0];
            return $ExistanceVisiteur;
        }
    }
public function getHistorique($login, $mdp){
                $req = "select nom, idnumImmat, marque, dateD, dateF, modele, couleur from affectation, vehicule,Visiteur where Visiteur.id = affectation.idVisiteur and affectation.idnumImmat=vehicule.numImmat ";
        //var_dump($req);
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->bindParam(':log', $login);
        $stmt->bindParam(':md', $mdp);
                $stmt->execute();
        $Historique = $stmt->fetchAll();
        return $Historique;
    }

   
    
      public function gethtablette($id, $login, $mdp){
                $req = "SELECT nomT FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $htablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $htablette;
    }

                  public function gethintablette($id, $login, $mdp){
                $req = "SELECT inter FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $hintablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $hintablette;
    }
                public function gethextablette($id, $login, $mdp){
                $req = "SELECT ext FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt ";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $hextablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $hextablette;
    }
                public function gethnomtablette($id, $login, $mdp){
                $req = "SELECT nom FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $hnom = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $hnom;
    }
                    public function gethprenomtablette($id, $login, $mdp){
                $req = "SELECT prenom FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $hprenom = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $hprenom;
    }
                public function gethcouleurtablette($id, $login, $mdp){
                $req = "SELECT couleur FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $hcouleur = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $hcouleur;
    }

            public function gethmodeletablette($id, $login, $mdp){
                $req = "SELECT modele FROM affectationt, Visiteur, tablette WHERE Visiteur.id = affectationt.idVisiteur AND affectationt.nomtab=tablette.nomt";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $hmodele = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $hmodele;
    }
       public function gettintablette($id, $login, $mdp){
                $req = "SELECT inter FROM tablette";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $tintablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $tintablette;
    }

              public function gettnomtablette($id, $login, $mdp){
                $req = "SELECT nom FROM Visiteur";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $tnom = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $tnom;
    }
    public function gettprenomtablette($id, $login, $mdp){
                $req = "SELECT prenom FROM Visiteur";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $tprenom = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $tprenom;
    }
           public function gettextablette($id, $login, $mdp){
                $req = "SELECT ext FROM tablette";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $textablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $textablette;
    }

          public function gettprenomnomtablette($id, $login, $mdp){
                $req = "SELECT prenom, nom, id FROM Visiteur";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $tprenomnom = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $tprenomnom;
    }
    public function getttablette($id, $login, $mdp){
                $req = "SELECT nomt FROM tablette";
    
        $stmt = PdoGsb::$monPdo->prepare($req);
                $stmt->execute();

        $ttablette = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        
        return $ttablette;
    }
      
      
}




?>


 

