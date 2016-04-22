<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exams extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

  public function index(){
    // $this->load->view('/index');
		redirect('/main');
  }

	public function main(){
    $this->load->view('/index');
  }

  public function register(){
    $this->load->model('Exam');
    $name = $this->input->post('name');
    $username = $this->input->post('username');
    $password1 = $this->input->post('password1');
    $password2 = $this->input->post('password2');

    // form data validation
    $this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('name', 'NAME', 'required|min_length[3]');
    $this->form_validation->set_rules('username', 'USERNAME', 'required|min_length[3]');
    $this->form_validation->set_rules('password1', 'PASSWORD', 'required|min_length[8]');
    $this->form_validation->set_rules('password2', 'CONFIRM PASSWORD', 'required|matches[password1]');
    if($this->form_validation->run() == FALSE){
      // var_dump(validation_errors());
      // die();
      $this->load->view('/index', array('register_errors' => validation_errors()));
    }
    else{
			$add_user = $this->Exam->add_user($name, $username, $password1);
      if($add_user) {
				$this->session->set_flashdata('registered', true);
				// var_dump($this->session->flashdata('registered'));
				// die();
        // $this->load->view('/index');
				redirect('/');
      }
      else{
        die("Problem occurred while register your information!");
			}
    }
  }

  public function login(){
    // form data validation
    $this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('username', 'USERNAME', 'required');
    $this->form_validation->set_rules('password', 'PASSWORD', 'required|min_length[8]');
    if($this->form_validation->run() == FALSE){
      $this->load->view('/index', array('login_errors' => validation_errors()));
    }
    else{
      $this->load->model('Exam');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $user = $this->Exam->get_user_by_username($username);
      if($user && $user['password'] == $password){
        $this->session->set_userdata('user_id',$user['id']);
				$this->session->set_userdata('user_name',$user['username']);
				redirect('/travels');
      }
      else{
        die("Fetching user data failed!");
      }
    }
  }

	public function travels(){
		$this->load->model('Exam');
		$trips = $this->Exam->get_all_travel();
		$this->load->view('/dashboard', array('trips' => $trips));
		// if($trips){
		// 	$this->load->view('/dashboard', array('trips' => $trips));
		// }
		// else{
		// 	echo "Fetching trip data failed!";
		// }
	}

	public function add(){
		$this->load->view('/add_trip');
	}

	public function checkStartDate($date) {
		if(strtotime($date) <= strtotime(date('m/d/Y'))){
			$error = "<div class='error'>The start date must be a future date.</div>";
			return false;
		}
		return true;
	}

	public function checkEndDate($date) {
		if(strtotime($date) < strtotime($this->input->post('from'))){
			return ;
		}
		return true;
	}

	public function add_travel(){
		date_default_timezone_set('America/Los_Angeles');
		// form data validation
		var_dump($this->input->post());
    $this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    $this->form_validation->set_rules('destination', 'DESTINATION', 'required');
		$this->form_validation->set_rules('description', 'DESCRIPTION', 'required');
    $this->form_validation->set_rules('from', 'START DATE', 'required|callback_checkStartDate');
		$this->form_validation->set_rules('to', 'END DATE', 'required|callback_checkEndDate');
    if($this->form_validation->run() == FALSE){
      $this->load->view('/add_trip', array('travel_errors' => validation_errors()));
    }
    else{
      $this->load->model('Exam');
      $destination = $this->input->post('destination');
      $description = $this->input->post('description');
			$startdate = $this->input->post('from');
			$enddate = $this->input->post('to');
      $add_travel = $this->Exam->add_travel($this->session->userdata['user_id'], $destination, $description, $startdate, $enddate);
      if($add_travel){
				redirect('/travels');
      }
      else{
        die("Uploading travel information failed!");
      }
    }
	}

	public function join_travel($travel_id){
		$this->load->model('Exam');
		// var_dump($get_travel);
		// die();
		$join_travel = $this->Exam->join_travel($this->session->userdata['user_id'], $travel_id);
		if($join_travel){
			redirect('/travels');
		}
		else{
			die("Updating travel information failed!");
		}
	}

	public function detail($travel_id){
		$this->load->model('Exam');
		$get_travel =$this->Exam->get_travel_by_id($travel_id);
		// var_dump($get_travel);
		// die();
		if($get_travel){
			$get_joiners =$this->Exam->get_joined_users($get_travel['trip_id']);
			$this->load->view('/detail', array('travel_info' => $get_travel, 'joiners' => $get_joiners));
		}
		else{
			die("Updating travel information failed!");
		}
	}

  public function reset_session(){
    $this->session->sess_destroy();
    redirect('/');
  }
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
