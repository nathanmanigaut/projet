<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller {

	public function update_match()
	{
		//chargement des models
		$this->load->model('Match_model','match');
		
		//récupèration des post
        $match_id = $this->input->post('match_id');
        $winner = $this->input->post('winner');

		//vérification si tous les champs sont remplis
		if (!empty($match_id) && !empty($winner)) {
			//préparation de la requête
            $data = array(
                'end' => true,
                'winner' => $winner
            );
			$key = 'id';	
		
			//execution de la requête
			$this->match->updates($data, $key, $match_id);	

			//requête du match à mettre à jour pour mettre le gagnant du match dans le prochain match
			$matchs_maj = $this->match->selectsOr('*', 'team_1', null, 'team_2', null);

			//on selectionne le premier match pour le mettre à jour
			$matchs_maj_row = $matchs_maj->row(1);

		
			if(isset($matchs_maj_row)){
				
				if($matchs_maj_row->team_1 == null){

					//préparation de la requête
					$data = array(
						'team_1' => $winner
					);	
					$match_id = $matchs_maj_row->id;
					$key = 'id';

					//execution de la requête
					$this->match->updates($data, $key, $match_id);

				}else if($matchs_maj_row->team_2 == null){
					
					//préparation de la requête
					$data = array(
						'team_2' => $winner
					);	
					$match_id = $matchs_maj_row->id;
					$key = 'id';

					//execution de la requête
					$this->match->updates($data, $key, $match_id);
				}
			}
			//redirection
			header('Location:'.base_url('tournoi'));
		}	
	}
}