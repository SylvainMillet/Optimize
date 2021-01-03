<?php

error_reporting(E_ALL);

if (0 > version_compare(PHP_VERSION, '5')) {
	die('This file was generated for PHP 5');
}

/**
 * Short description of class Parser_Variable
 *
 * @abstract
 * @access public
 * @author Benjamin PETIT
 * @package Kernel
 * @subpackage Fichier
 */
class Parser_Variable {
	// --- ATTRIBUTES ---
	/**
	 * Short description of attribute delimiter
	 *
	 * @access protected
	 * @var String
	 */
	protected $delimiter;

	/**
	 * Short description of attribute $entete
	 *
	 * @access protected
	 * @var boolean
	 */
	protected $entete;

	// --- OPERATIONS ---

	/**
	 * Short description of method __construct
	 *
	 * @access public
	 * @param
	 * @author Benjamin PETIT
	 */
	public function __construct($parametres) {
		$this -> delimiter = '	';
		$this -> entete = true;
	}

	/**
	 * Short description of method set_delimiter
	 *
	 * @access public
	 * @author Benjamin PETIT
	 * @param  char donnees
	 * @return char
	 */
	public function set_delimiter($delimiter) {
		$this -> delimiter = $delimiter;

		return ($this -> delimiter);
	}

	/**
	 * Short description of method set_entete
	 *
	 * @access public
	 * @author Benjamin PETIT
	 * @param  boolean donnees
	 * @return boolean
	 */
	public function set_entete($entete) {
		$this -> entete = $entete;

		return ($this -> entete);
	}

	/**
	 * Short description of method parser_lecture
	 *
	 * @access public
	 * @author Benjamin PETIT
	 * @param  Array donnees
	 * @return Array
	 */
	public function parser_lecture($donnees) {
		if (is_string($donnees) && $donnees != "") {
			if (file_exists($donnees)) {
				$donnees = file($donnees);
			} else {
				throw new Exception('EE class Parser_Variable::parser_lecture => le fichier ' . $donnees . ' n\'existe pas !');
			}
		} elseif (is_string($donnees)) {
			throw new Exception('EE class Parser_Variable::parser_lecture => le nom du fichier ne peut être vide !');
		} elseif (!is_array($donnees)) {
			throw new Exception('EE class Parser_Variable::parser_lecture => l\'argument reçu n\'est pas valide !');
		}

		$resultat = array();

		if ($this -> entete) {
			$tmp = explode($this -> delimiter, str_replace(PHP_EOL, '', $donnees[0]));

			foreach ($tmp as $value) {
				$resultat[$value] = array();
			}

			unset($tmp);
			unset($donnees[0]);
		} else {
			$tmp = explode($this -> delimiter, str_replace(PHP_EOL, '', $donnees[0]));

			foreach ($tmp as $value) {
				$resultat[] = array();
			}

			unset($tmp);
		}

		$keys = array_keys($resultat);
		$params = array($this -> delimiter, &$resultat, $keys);

		array_walk($donnees, function(&$item, &$key, &$params) {
			$tmp = explode($params[0], $item);

			foreach ($tmp as $k => $value) {
					$params[1][$params[2][$k]][] = $value;
			}

			unset($tmp);
		}, $params);

		unset($keys);
		unset($params);

		return $resultat;
	}

	/**
	 * Short description of method parser_ecriture
	 *
	 * @access public
	 * @author Benjamin PETIT
	 * @param  Array donnees
	 * @return Array
	 */
	public function parser_ecriture($donnees) {
		if (!is_array($donnees)) {
			throw new Exception('EE class Parser_Variable::parser_ecriture => l\'argument reçu n\'est pas valide !');
		}

		$resultat = "";

		$entete = array_keys($donnees);
		if ($this -> entete) {
			foreach ($entete as $key => $value) {
				$resultat .= $value;
				if ($key < (sizeof($entete) - 1)) {
					$resultat .= $this -> delimiter;
				}
			}
			$resultat .= PHP_EOL;
		}

		for ($i = 0; $i < sizeof($donnees[$entete[0]]); $i++) {
			foreach ($entete as $key => $value) {
				$resultat .= $donnees[$value][$i];
				if ($key < (sizeof($entete) - 1)) {
					$resultat .= $this -> delimiter;
				}
			}
			if ($i < (sizeof($donnees[$entete[0]]) - 1)) {
				$resultat .= PHP_EOL;
			}
		}

		return $resultat;
		//throw new Exception('EE class Parser_Variable::parser_ecriture => cette fonctionnalite n\'est pas implementee');
	}

}
?>