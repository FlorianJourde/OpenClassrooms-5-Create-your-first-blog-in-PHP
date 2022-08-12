<?php

declare(strict_types=1);

class Pont
{
	private const UNITE = 'm²';
	private const SURFACE_TEXT = 'Ce pont mesure %d';
	private float $longueur;
	private float $largeur;
	public const CONST = 20;
	public static int $nombrePietons = 0;

	public function nouveauPieton()
	{
		self::$nombrePietons++;
	}

	public static function validerTaille (float $taille): bool
	{
		if ($taille < 20) {
			trigger_error(
				' La taille est trop courte. (min 20)',
				E_USER_ERROR
			);
		}

		return true;
	}

	public function setLongueur(float $longueur): void
	{
		self::validerTaille($longueur);

		$this->longueur = $longueur;
	}

	public function getLongueur(): float
	{
		return $this->longueur;
	}

	public function setLargeur(float $largeur): void
	{
		self::validerTaille($largeur);

		$this->largeur = $largeur;
	}

	public function getLargeur(): float
	{
		return $this->largeur;
	}

	public function getSurface(): string
	{
		return ($this->longueur * $this->largeur) . ' ' . self::UNITE;
	}

	public function printSurface(): string
	{
		return sprintf(self::SURFACE_TEXT, $this->getSurface());
	}
}

//Accesseurs & mutateurs
$towerBridge = new Pont;
$towerBridge->setLongueur(286.0);
$towerBridge->setLargeur(25.0);

var_dump($towerBridge->getSurface());
//var_dump($towerBridge->printSurface());
//$towerBridge->printSurface();

//Exploitation de la méthode statique
//var_dump(Pont::validerTaille(150));
//var_dump(Pont::CONST);

//Ajout de piétons via les fonctions static. Valeurs partagées entre toutes les classes
$pontLondres = new Pont;
$pontLondres->nouveauPieton();

$pontManhattan = new Pont;
$pontManhattan->nouveauPieton();

//var_dump(Pont::$nombrePietons);
