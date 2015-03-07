<?php

class Auteur_Controller extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auteur');
	}

	public function pagelinks(
			$result, 		// objet-résultat d'une requête, à partir duquel on veut générer la table
			$count_all, 	// nombre total d'enregistrements dans la table où a été faite la requête (sans LIMIT ni OFFSET)
			$base_url		// base_url nécessaire pour la fonction de pagination
		) {
		$this->load->library('pagination');

		$config['base_url'] = $base_url;
		$config['total_rows'] = $count_all;
		$config['per_page'] = $result->num_rows();

		$this->pagination->initialize($config);

		return $this->pagination->create_links();
	}
	
	public function createtable($resObjet) 
	{
		$this->load->library('table');
		$tmpl = array (
                    'table_open' => '<table class="table table-striped">',
              );				  
		$this->table->set_template($tmpl); 
		return $this->table->generate($resObjet); 
	}
	
	public function liste($offset = 0, $limit = 20) 
	{
		$result = $this->Auteur->liste($offset, $limit);
		echo $this->createtable($result);
		echo $this->pagelinks(
			$result,
			$this->Auteur->countAll(), 
			'http://localhost/poesie/index.php/auteur/liste/'
		);
	}
	
	public function cherche($nom='')  
	{
		$result = $this->Auteur->cherche($nom);
		echo $this->createtable($result);
	}
	
}