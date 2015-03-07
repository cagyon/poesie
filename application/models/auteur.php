<?php

class Auteur extends CI_model {

	// tableau associatif pouvant contenir les champs d'une donnée de la table "auteur":
	var $data = array();

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->database();
    }
	
	function  liste($offset = 0, $limit = 20)
	{
		return $this->db->get('auteur', $limit, $offset);
	}
	
	function countAll() 
	{
		return $this->db->count_all('auteur');
	}
    
 	function  insert()
	{
        if (!isset($this->data['nom'])) exit('le nom de l\'auteur doit être défini lors de l\'insertion');
        return ($this->db->insert('auteur', $this->data)) ? $this->db->insert_id() : FALSE ;
	}
    
    function update()
    {
       if (!isset($this->data['id'])) exit('l\'id de l\'auteur doit être défini lors de la mise à jour');
       $this->db->update('auteur', $this->data, array('id' => $this->data['id']));
	   return $this->db->affected_rows();
    }

    function cherche($nom, $prenom = NULL)
    {
		$this->db->like('nom', $nom);
		if (isset($prenom)) {
			$this->db->like('prenom', $prenom);
		}
        return $this->liste();
     }

}