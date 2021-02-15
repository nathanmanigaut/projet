<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $this->load->view('/front/partials/header');
		$this->load->view('/front/partials/nav');
		$this->load->view('/front/login');
		$this->load->view('/front/partials/footer');
	}
	public function signin()
	{
		$email = $this->input->post('email');
		$pseudo = $this->input->post('name');
		$mdp = $this->input->post('password');
		$password = password_hash($mdp, PASSWORD_DEFAULT);
		$date = date("Y-m-d H:i:s");
		if(!empty($email) && !empty($pseudo) && !empty($mdp)){
			$data = array(
				'email' => $email,
				'pseudo' => $pseudo,
				'password'=> $password,
				'date_create'=> $date,
				'date_update'=> $date,
			);
			$this->load->model('User_model','user');
			$this->user->inserts($data);
			
		}

		 header('Location: http://localhost/projet/login');
	}
	public function connect()
	{
		$name = $this->input->post('name');
		$password = $this->input->post('password');

		
		if(!empty($name) && !empty($password)){
			
			$key = 'pseudo';
			$this->load->model('User_model','user');
			$query = $this->user->selects('*', $key, $name);
					
				if($query->num_rows() == 1){

					foreach($query->result() as $user){

						if(password_verify($password,$user->password)){

							$userdata = array (
								'id' => $user->id,
								'name' => $user->pseudo,
							);
							
							$this->session->set_userdata($userdata);
							header('Location: http://localhost/projet/dashboard/');
							
						} else {
							header('Location: http://localhost/projet/login/'); 
							
						}
					}	
				} else {
					echo"Aucun utilisateur trouvé";
				} 
			    
		} else {
			echo"merci de renseigner un utilisateur ou mot de passe valide";
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		header('Location: http://localhost/projet/login/');
	}
}