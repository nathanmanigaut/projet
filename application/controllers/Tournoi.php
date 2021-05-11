<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tournoi extends CI_Controller
{

    public function index()
    {
        //chargement des models
        $this->load->model('Tournament_model', 'tournoi');
        $this->load->model('Game_model', 'game');
        $this->load->model('Match_model','match');
        $this->load->model('Team_model', 'team');
        $this->load->model('Registered_model', 'register');

        //requêtes à la base de données
        $user_id = $this->session->id;
        $tournaments = $this->tournoi->selects('*', 'create_id', $user_id);
        $date = date('Y-m-d\TH:i');
        $games = $this->game->gets();
        $teams = $this->team->gets();
        //formatage de la date pour l'affichage
        if ($tournaments->num_rows() >= 1) {
            foreach ($tournaments->result() as $tournament) {
                $tournament_id = $tournament->id;
                $date_start = date_create($tournament->date_start);
                $date_start = $date_start->format('Y-m-d\TH:i');
                $register = $this->register->selects('*','tournament_id',$tournament_id);
            } if($register->num_rows() >= 1){
                //requêtes à la base de données
                $matchs = $this->match->selects2('*', 'tournament_id', $tournament_id, 'end', null);
            }
            
            //initialisation du tableau pour passer des donnéess à la view
            $data = array(
                'tournaments' => $tournaments,
                'date' => $date,
                'games' => $games,
                'date_start' => $date_start,
                'matchs' => $matchs,
                'teams' => $teams
            );
            //chargement des views
        $this->load->view('/back/partials/header');
        if (isset($this->session->id)) {
            $this->load->view('/back/partials/nav');
        } else {
            $this->load->view('/front/partials/nav');
        }
        $this->load->view('/back/tournoi', $data);
        $this->load->view('/back/partials/footer');
        } else {
            //initialisation du tableau pour passer des donnéess à la view
        $data = array(
            'tournaments' => $tournaments,
            'date' => $date,
            'games' => $games,
            'teams' => $teams
        );

        //chargement des views
        $this->load->view('/back/partials/header');
        if (isset($this->session->id)) {
            $this->load->view('/back/partials/nav');
        } else {
            $this->load->view('/front/partials/nav');
        }
        $this->load->view('/back/tournoi', $data);
        $this->load->view('/back/partials/footer');
        }


        
    }

    public function display($id)
    {

        //chargement des models
        $this->load->model('Tournament_model', 'tournoi');
        $this->load->model('Game_model', 'game');
        $this->load->model('Registered_model', 'registered');
        $this->load->model('Team_model', 'team');
        $this->load->model('Match_model','match');

        //requêtes à la base de données
        $tournaments = $this->tournoi->selects('*', 'id', $id);
        $games = $this->game->gets();
        $registered = $this->registered->selects('*', 'tournament_id', $id);
        $teams = $this->team->gets();
        $querymatchs = $this->match->selects('*', 'tournament_id', $id);
        $matchs = $querymatchs->result_array();
        foreach ($tournaments->result() as $tournament) {
            $date_start = date_create($tournament->date_start);
            $date_start = $date_start->format('d/m/Y H\hi');
        }

        //initialisation du tableau pour passer des donnéess à la view
        $data = array(
            'id' => $id,
            'tournaments' => $tournaments,
            'games' => $games,
            'registered' => $registered,
            'teams' => $teams,
            'matchs'=> $matchs,
            'date_start' => $date_start,
        );

        //charge les views
        $this->load->view('/front/partials/header');
        if (isset($this->session->id)) {
            $this->load->view('/back/partials/nav');
        } else {
            $this->load->view('/front/partials/nav');
        }
        $this->load->view('/front/tournoi', $data);
        $this->load->view('/front/partials/footer');

    }

    public function add_tournament()
    {

        //chargement du model
        $this->load->model('Tournament_model', 'tournoi');

        //récupèration des post
        $user_id = $this->session->id;
        $name = $this->input->post('name');
        $jeux_id = $this->input->post('jeux_id');
        $date_start = $this->input->post('date_start');
        $nb_team = $this->input->post('nb_team');
        $date = date("Y-m-d H:i:s");

        //verification si tous les champs sont remplis
        if (!empty($name) && !empty($user_id) && !empty($jeux_id) && !empty($date_start) && !empty($date) && !empty($nb_team)) {
            $data = array(
                'create_id' => $user_id,
                'name' => $name,
                'jeux_id' => $jeux_id,
                'date_start' => $date_start,
                'nb_team' => $nb_team,
                'date_create' => $date,
                'date_update' => $date,
            );
            //on insère les données dans la base de donnée
            $this->tournoi->inserts($data);

			//redirection
            header('Location: http://localhost/projet/tournoi');
        } else {
			//message d'erreur + redirection
            echo "<script type='text/javascript'>alert('Veuillez remplir tous les champs');
			document.location.href='http://localhost/projet/tournoi';</script>";
        }
    }

    public function update_tournament()
    {

        //chargement du model
        $this->load->model('Tournament_model', 'tournoi');

		//récupèration des post
        $name = $this->input->post('name');
        $jeux_id = $this->input->post('jeux_id');
        $date_start = $this->input->post('date_start');
        $nb_team = $this->input->post('nb_team');
        $date = date("Y-m-d H:i:s");

		//vérification si tous les champs sont remplis
        if (!empty($name) && !empty($jeux_id) && !empty($date_start) && !empty($date) && !empty($nb_team)) {
			//préparation de la requête
            $data = array(
                'name' => $name,
                'jeux_id' => $jeux_id,
                'date_start' => $date_start,
                'nb_team' => $nb_team,
                'date_update' => $date,
                'end' => $end,
            );

			$user_id = $this->session->id;
        	$key = 'create_id';

			//execution de la requête
            $this->tournoi->updates($data, $key, $user_id);

			//redirection
			header('Location:'.base_url('tournoi'));
        } else {
			//message d'erreur + redirection
            echo "<script type='text/javascript'>alert('Veuillez remplir tous les champs');
					window.location='http://localhost/projet/tournoi';</script>";
        }

    }

    public function register_tournament()
    {
        //Chargement des models
        $this->load->model('Registered_model', 'registered');
        $this->load->model('Tournament_model', 'tournoi');
        $this->load->model('Team_model', 'team');
        $this->load->model('Match_model', 'match');

        //On récupère l'id du tournoi 
        $tournament_id = $this->input->post('tournament_id');

        //on verifie si l'utilisateur à bien créer une équipe
        if (isset($this->session->team_id)) {
			//si une équipe est crée on récupère son id
            $team_id = $this->session->team_id;
		} 
		
		//on verifie si c'est bien un utilisateur connecté
		else if (isset($this->session->id)) {

            //message d'erreur + redirection
            echo "<script type='text/javascript'>alert('Veuillez créer une équipe pour participer au tournoi');
					window.location='http://localhost/projet/equipe';</script>";
        } else {

			//message d'erreur + redirection
            echo "<script type='text/javascript'>alert('Veuillez créer un compte pour créer une équipe et participer au tournoi');
					window.location='http://localhost/projet/equipe';</script>";
        }

        $date = date("Y-m-d H:i:s");
        $key = 'id';
		//requête du tournoi sur le lequel on veut s'inscrire
        $querytournament = $this->tournoi->selects('*', $key, $tournament_id);
		//requête de l'équipe de l'utilisateur à inscrire
        $queryteam = $this->team->selects('*', $key, $team_id);
		//requête d'une equipe inscrite au tournoi
        $queryregister_team = $this->registered->selects2('*', 'team_id', $team_id, 'tournament_id', $tournament_id);
		//requête des équipes inscrite au tournoi
        $queryregister_tournament = $this->registered->selects('*', 'tournament_id', $tournament_id);
        foreach ($querytournament->result() as $tournament) {
            foreach ($queryteam->result() as $team) {
				//vérification si l'equipe n'est pas déjà inscrite au tournoi
                if ($queryregister_team->num_rows() >= 1) {
                    echo "<script type='text/javascript'>alert('Votre equipe est déjà inscrite au tournoi');
						window.location='http://localhost/projet/tournois/' ;</script>";
                } else {
					//vérification si le jeu de l'equipe correspond au jeu du tournoi
                    if ($tournament->jeux_id == $team->jeux_id) {
						//vérification que les données à envoyer ne sont pas vide
                        if (!empty($tournament_id) && !empty($team_id) && !empty($date)) {
                            $data = array(
                                'tournament_id' => $tournament_id,
                                'team_id' => $team_id,
                                'date_inscription' => $date,
                            );
							//execution de la requête, inscription au tournoi
                            $this->registered->inserts($data);
							//nouvelle requête des équipes inscrite au tournoi
                            $queryregister_tournament = $this->registered->selects('*', 'tournament_id', $tournament_id);
							//on verifie si le tournoi est rempli
                            if ($queryregister_tournament->num_rows() == $tournament->nb_team) {
                                $array_team = array();
                                foreach ($queryregister_tournament->result() as $register) {
									//on recupère l'id de chaque équipe inscrite
                                    array_push($array_team, $register->team_id);
                                }
								//on boucle pour créer tous les matchs de ce tournoi
                                for ($i = 0; $i < $tournament->nb_team - 1; $i++) {
                                    $data = array(
                                        'tournament_id' => $tournament->id,
                                        'date_start' => $tournament->date_start,
                                        'date_create' => $date,
                                        'date_update' => $date,
                                    );
									//on verifie si le tableau des equipes est rempli
                                    if (!empty($array_team)) {
										//on recupère une equipe aléatoire
                                        $random_key = array_rand($array_team, 1);
										//on insère cette équipe 
                                        $data['team_1'] = $array_team[$random_key];
										//puis on l'a supprime du tableau des équipes
                                        foreach ($array_team as $key => $value) {
                                            if ($data['team_1'] == $value) {
                                                unset($array_team[$key]);
                                            }
                                        }
										//on recupère une equipe aléatoire
                                        $random_key = array_rand($array_team, 1);
										//on insère cette équipe 
                                        $data['team_2'] = $array_team[$random_key];
										//puis on l'a supprime du tableau des équipes
                                        foreach ($array_team as $key => $value) {
                                            if ($data['team_2'] == $value) {
                                                unset($array_team[$key]);
                                            }
                                        }
                                    }
									//on execute la requête, création d'un match
                                    $this->match->inserts($data); 
                                }
								//redirection
								header('Location: http://localhost/projet/tournoi/display/' . $tournament_id);
                            } else {

								//redirection
                                header('Location: http://localhost/projet/tournoi/display/' . $tournament_id);
                            }
                        }
                    } else {
						//message d'erreur + redirection
                        echo "<script type='text/javascript'>alert('Veuillez inscire une équipe du même jeu que le tournoi');
							window.location='http://localhost/projet/equipe';</script>";
                    }
                }
            }
        }
    }
}
