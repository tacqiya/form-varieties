<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->site_config = $this->config->item('site_config');
	}
	public function index_old()
	{
		redirect('login');
		exit;
		if ($this->input->cookie('user_name', TRUE)) {

			$all_data['page'] = 'index';
			$all_data['user_details'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['id' => $this->input->cookie('user_name', TRUE)]);
			$all_data['registered_data'] = $this->dbconnect->fetchAllDetails(TBL_ALUMNI_FORM, ['profile_id' => $this->input->cookie('user_name', TRUE)]);

			if ($this->input->post()) {
				extract($this->input->post());
				$this->form_validation->set_rules('reg_email', 'Registered email at KU Alumni Platform', 'trim|required|valid_email');
				$this->form_validation->set_rules('full_name', 'Full name', 'required');
				$this->form_validation->set_rules('degree', 'Degree', 'required');
				$this->form_validation->set_rules('major', 'Major', 'required');
				$this->form_validation->set_rules('d_year', 'Degree graduation year', 'required');
				$this->form_validation->set_rules('g_insti', 'Graduation institution', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile', 'numeric|required');
				$this->form_validation->set_rules('personal_email', 'Personal Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('linkd_in', 'LinkedIn Account', 'required');
				$this->form_validation->set_rules('e_status', 'Employment status', 'required');
				// if ($this->input->post('e_status') == 'Self-Employed') {
				// 	$this->form_validation->set_rules('c_name', 'Company name', 'required');
				// 	$this->form_validation->set_rules('industry', 'Industry', 'required');
				// }

				if ($this->form_validation->run() === TRUE) {
					$formData = $this->input->post();
					// echo "<pre>";
					// print_r($formData);
					// exit;
					$employment_details = [];
					if ($formData['e_status'] == 'Employed and satisfied') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['j_title'] = $formData['j_title'];
						$employment_details['w_email'] = $formData['w_email'];
						// $employment_details['work_study_1'] = $formData['work-study-1'];
						$employment_details['sector'] = $formData['sector'];
						$employment_details['business_1'] = $formData['business-1'];
						$employment_details['type_sec_1'] = $formData['type-sec-1'];

						if ($formData['type-sec-1'] == 'Other') {
							$employment_details['other_type_1'] = $formData['other_type_1'];
							unset($formData['other_type_1']);
						}
						unset($formData['type-sec-1']);
						unset($formData['c_name']);
						unset($formData['j_title']);
						unset($formData['w_email']);
						// unset($formData['work-study-1']);
						unset($formData['sector']);
						unset($formData['business-1']);
					} else if ($formData['e_status'] == 'Employed, but unsatisfied') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['w_email'] = $formData['w_email'];
						// $employment_details['field_2'] = $formData['field-2'];
						$employment_details['sector'] = $formData['sector'];
						$employment_details['business_2'] = $formData['business-2'];
						$employment_details['satisfied'] = $formData['satisfied'];
						$employment_details['type_sec_2'] = $formData['type-sec-2'];
						if ($formData['type-sec-2'] == 'Other') {
							$employment_details['other_type_2'] = $formData['other_type_2'];
							unset($formData['other_type_2']);
						}
						unset($formData['type-sec-2']);
						unset($formData['c_name']);
						unset($formData['w_email']);
						// unset($formData['field-2']);
						unset($formData['sector']);
						unset($formData['business-2']);
						unset($formData['satisfied']);
					} else if ($formData['e_status'] == 'Self-Employed') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['industry'] = $formData['industry'];
						$employment_details['w_email'] = $formData['w_email'];
						$employment_details['special_3'] = $formData['special-3'];
						unset($formData['c_name']);
						unset($formData['industry']);
						unset($formData['w_email']);
						unset($formData['special-3']);
					} else if ($formData['e_status'] == 'Unemployed and looking for a job') {
						$employment_details['preference_4'] = $formData['preference-4'];
						$employment_details['w_emirate'] = $formData['w_emirate'];
						$employment_details['type_sec_4'] = $formData['type-sec-4'];
						if ($formData['type-sec-4'] == 'Other') {
							$employment_details['other_type_4'] = $formData['other_type_4'];
							unset($formData['other_type_4']);
						}
						unset($formData['type-sec-4']);
						unset($formData['preference-4']);
						unset($formData['w_emirate']);
					} else if ($formData['e_status'] == 'Unemployed, but not looking for a job') {
						$employment_details['looking_job_5'] = $formData['looking-job-5'];
						if ($formData['looking-job-5'] == 'Other') {
							$employment_details['other_look_job'] = $formData['other_look_job'];
							unset($formData['other_look_job']);
						}
						unset($formData['looking-job-5']);
					}
					$formData['employment_details'] = json_encode($employment_details);
					// echo "<pre>";print_r($formData);exit;

					$formData['profile_photo'] = $formData['profile_pic_org'];
					unset($formData['profile_pic_org']);

					$formData['profile_id'] = $this->input->cookie('user_name', TRUE);
					// echo "<pre>";print_r($formData);exit;
					if (!$formData['profile_photo']) {
						$formData['profile_photo'] = $all_data['registered_data']->profile_photo;
					}

					// $check_data_exist = '';
					if ($all_data['registered_data']) {
						$update_data = $this->dbconnect->updateQuery(TBL_ALUMNI_FORM, ['profile_id' => $this->input->cookie('user_name', TRUE)], $formData);
					} else {
						$insert_data = $this->dbconnect->register_data(TBL_ALUMNI_FORM, $formData);
					}
					delete_cookie('user_name');
					echo json_encode(array('error' => false, 'message' => 'Thank you for applying for KU Alumni card. Alumni Office will contact you once your card is ready for collection'));
					exit;
				} else {
					echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
					exit;
				}
			}
			// echo "<pre>";print_r($all_data);exit;
			$this->load->view('includes/header', $all_data);
			$this->load->view('index', $all_data);
			$this->load->view('includes/footer');
		} else {
			redirect('login');
		}
	}

	public function emirates_id_page()
	{
		$all_data['page'] = 'Enter emirates id';

		if ($this->input->post()) {
			extract($this->input->post());
			$this->form_validation->set_rules('emirates_id', 'Emirates ID', 'trim|required');

			if ($this->form_validation->run() === TRUE) {
				$get_user = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['emirates_id' => $emirates_id]);
				if ($get_user) {
					$get_user->entered_status = 'emirates_id';
				}
				if (!$get_user) {
					$get_user = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['ku_id' => $emirates_id]);
					if ($get_user) {
						$get_user->entered_status = 'ku_id';
					}
				}
				if ($get_user) {
					$get_user->form_type = 'registered_user';
					$get_user->entered_eid = $emirates_id;
					// $this->session->set_flashdata('data_name', $get_user);
					$this->session->set_tempdata('temp_item', $get_user, 300);
					echo json_encode(array('error' => false, 'status' => 'registered', 'message' => 'Logged into the portal successfully!'));
				} else {
					$check_in_em = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $emirates_id]);
					$check_in_ku = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['ku_id' => $emirates_id]);
					if ($check_in_em) {
						$get_user = $check_in_em;
						$get_user->entered_eid = $emirates_id;
						$get_user->entered_status = 'emirates_id';
						echo json_encode(array('error' => false, 'status' => 'unregistered', 'message' => 'Logged into the portal successfully!'));
					} else if ($check_in_ku) {
						$get_user = $check_in_ku;
						$get_user->entered_eid = $emirates_id;
						$get_user->entered_status = 'ku_id';
						echo json_encode(array('error' => false, 'status' => 'unregistered', 'message' => 'Logged into the portal successfully!'));
					} else {
						$get_user = new stdClass();
						$get_user->form_type = 'unregistered_user';
						$get_user->entered_eid = $emirates_id;
						$get_user->entered_status = '';
						echo json_encode(array('error' => false, 'status' => 'unregistered', 'message' => 'Unable locate the entered Emirates ID, You will now be redirected!'));
					}

					// $this->session->set_flashdata('data_name', $get_user);
					$this->session->set_tempdata('temp_item', $get_user, 300);
					//echo json_encode(array('error' => false, 'status' => 'unregistered', 'message' => 'Unable locate the entered Emirates ID, You will now be redirected!'));
				}
				// echo "<pre>";print_r($get_user);exit;
				exit;
			} else {
				echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
				exit;
			}
		}

		$this->load->view('includes/header', $all_data);
		$this->load->view('enter_emirates', $all_data);
		$this->load->view('includes/footer');
	}

	public function register_user_details()
	{
		if ($this->session->tempdata('temp_item')) {
			$all_data['page'] = 'index';

			if ($this->input->post()) {
				extract($this->input->post());
				$this->form_validation->set_rules('ku_id', 'KU ID', 'trim|required');
				$this->form_validation->set_rules('emirates_id', 'Emirates ID', 'trim|required');
				$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
				$this->form_validation->set_rules('major', 'Major', 'trim|required');
				$this->form_validation->set_rules('graduation', 'Year of Graduation', 'trim|required');
				$this->form_validation->set_rules('p_email', 'Personal Email', 'trim|required'); //|valid_email
				$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');

				$formData = $this->input->post();
				if ($this->form_validation->run() === TRUE) {
					$saved_data = $this->session->tempdata('temp_item');
					if (!is_numeric($formData['ku_id'])) {
						$formData['ku_id'] = $saved_data->ku_id;
						$ku_id = $saved_data->ku_id;
					}
					if (!is_numeric($formData['emirates_id'])) {
						$formData['emirates_id'] = $saved_data->emirates_id;
						$emirates_id = $saved_data->emirates_id;
					}

					$check_emirates_id = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $emirates_id]);
					$check_ku_id = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['ku_id' => $ku_id]);

					if ($check_emirates_id) {
						if (strpos($formData['p_email'], '*') !== false) {
							$formData['p_email'] = $check_emirates_id->p_email;
						}
						if (strpos($formData['mobile'], '*') !== false) {
							$formData['mobile'] = $check_emirates_id->mobile;
						}
						if (!$formData['profile_pic_org']) {
							$formData['profile_pic_org'] = $check_emirates_id->profile_pic_org;
						}
						$get_e_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['emirates_id' => $emirates_id]);
						$formData['user_status'] = 'updated';
						$update_data = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['emirates_id' => $emirates_id], $formData);
					} else if ($check_ku_id) {
						if (strpos($formData['p_email'], '*') !== false) {
							$formData['p_email'] = $check_ku_id->p_email;
						}
						if (strpos($formData['mobile'], '*') !== false) {
							$formData['mobile'] = $check_ku_id->mobile;
						}
						if (!$formData['profile_pic_org']) {
							$formData['profile_pic_org'] = $check_ku_id->profile_pic_org;
						}
						$get_e_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['ku_id' => $ku_id]);
						$formData['user_status'] = 'updated';
						$update_data = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['ku_id' => $ku_id], $formData);
					} else {
						$get_e_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['emirates_id' => $emirates_id]);
						if ($get_e_id) {
							$formData['foreign_id'] = $get_e_id->id;
						}
						$formData['user_status'] = 'registered';
						$insert_data = $this->dbconnect->register_data(TBL_TMP_USER_DETAILS, $formData);
					}
					// echo "<pre>";print_r($formData);exit;
					if (isset($update_data)) {
						echo json_encode(array('error' => false, 'message' => 'Your details have been updated and send for review!'));
						exit;
					} else if (isset($insert_data)) {
						echo json_encode(array('error' => false, 'message' => 'Your details have been updated and send for review!'));
						exit;
					}
				} else {
					echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
					exit;
				}
			}

			if ($this->session->tempdata('temp_item')->form_type == 'registered_user') {
				$all_data['user_data'] = $this->session->tempdata('temp_item');
				$all_data['non_user_data'] = [];
			} else {
				$all_data['user_data'] = [];
				$all_data['non_user_data'] = $this->session->tempdata('temp_item');
			}
			if ($this->session->tempdata('temp_item')->entered_status == 'emirates_id') {
				$all_data['new_data'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $this->session->tempdata('temp_item')->entered_eid]);
			} else if ($this->session->tempdata('temp_item')->entered_status == 'ku_id') {
				$all_data['new_data'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['ku_id' => $this->session->tempdata('temp_item')->entered_eid]);
			} else {
				$all_data['new_data'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $this->session->tempdata('temp_item')->entered_eid]);
			}

			// echo "<pre>";print_r($all_data);exit;
			$this->load->view('includes/header', $all_data);
			$this->load->view('register_user_page', $all_data);
			$this->load->view('includes/footer');
		} else {
			redirect('enter-e-id');
		}
	}

	public function unregister_user_details()
	{
		if ($this->session->tempdata('temp_item')) {
			$all_data['page'] = 'index';

			if ($this->input->post()) {
				extract($this->input->post());
				$this->form_validation->set_rules('ku_id', 'KU ID', 'trim|required');
				$this->form_validation->set_rules('emirates_id', 'Emirates ID', 'trim|required');
				$this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
				$this->form_validation->set_rules('major', 'Major', 'trim|required');
				$this->form_validation->set_rules('graduation', 'Year of Graduation', 'trim|required');
				$this->form_validation->set_rules('p_email', 'Personal Email', 'trim|required'); //|valid_email
				$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');

				if ($this->form_validation->run() === TRUE) {

					$formData = $this->input->post();
					$saved_data = $this->session->tempdata('temp_item')->entered_eid;
					$check_in_em = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $saved_data]);
					$check_in_ku = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['ku_id' => $saved_data]);
					// if (!is_numeric($formData['ku_id'])) {
					// 	($check_in_em) ? $save_ku = $check_in_em->ku_id : $save_ku = $check_in_ku->ku_id;
					// 	$formData['ku_id'] = $save_ku;
					// 	$ku_id = $save_ku;
					// }
					// if (!is_numeric($formData['emirates_id'])) {
					// 	($check_in_em) ? $save_em = $check_in_em->emirates_id : $save_em = $check_in_ku->emirates_id;
					// 	$formData['emirates_id'] = $save_em;
					// 	$emirates_id = $save_em;
					// }

					if ($_FILES['id_file']['name'] == "") {
						($check_in_em) ? $id_file = $check_in_em->emirates_id_file : $id_file = $check_in_ku->emirates_id_file;
						$formData['emirates_id_file'] = $id_file;
					} else {
						$config['upload_path'] = './uploads/temp_ku_id';
						$config['allowed_types'] = 'pdf|gif|jpg|png|jpeg';
						$config['overwrite'] = TRUE;
						$config['encrypt_name'] = TRUE;
						$config['max_size'] = 20000;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('id_file')) {
							$error = array('error' => $this->upload->display_errors());
							echo json_encode(array('error' => true, 'message' => '<p>' . $error['error'] . '</p>'));
							exit;
						} else {
							$data = array('upload_data' => $this->upload->data());
						}
						$formData['emirates_id_file'] = pathinfo($data['upload_data']['full_path'])['basename'];
					}
					// echo "<pre>";print_r($formData);exit;

					$check_emirates_id = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $emirates_id]);
					$check_ku_id = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['ku_id' => $ku_id]);
					if ($check_emirates_id) {
						if (strpos($formData['p_email'], '*') !== false) {
							$formData['p_email'] = $check_emirates_id->p_email;
						}
						if (strpos($formData['mobile'], '*') !== false) {
							$formData['mobile'] = $check_emirates_id->mobile;
						}
						if (!$formData['profile_pic_org']) {
							$formData['profile_pic_org'] = $check_emirates_id->profile_pic_org;
						}
						$get_e_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['emirates_id' => $emirates_id]);
						$formData['user_status'] = 'updated';
						$update_data = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['emirates_id' => $emirates_id], $formData);
					} else if ($check_ku_id) {
						if (strpos($formData['p_email'], '*') !== false) {
							$formData['p_email'] = $check_ku_id->p_email;
						}
						if (strpos($formData['mobile'], '*') !== false) {
							$formData['mobile'] = $check_ku_id->mobile;
						}
						if (!$formData['profile_pic_org']) {
							$formData['profile_pic_org'] = $check_ku_id->profile_pic_org;
						}
						$get_e_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['ku_id' => $ku_id]);
						$formData['user_status'] = 'updated';
						$update_data = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['ku_id' => $ku_id], $formData);
					} else {
						$get_e_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['emirates_id' => $emirates_id]);
						if ($get_e_id) {
							$formData['foreign_id'] = $get_e_id->id;
						}
						$formData['user_status'] = 'registered';
						$insert_data = $this->dbconnect->register_data(TBL_TMP_USER_DETAILS, $formData);
					}
					// echo "<pre>";print_r($formData);exit;
					if (isset($update_data)) {
						echo json_encode(array('error' => false, 'message' => 'Your details have been updated and send for review!'));
						exit;
					} else if (isset($insert_data)) {
						echo json_encode(array('error' => false, 'message' => 'Your details have been updated and send for review!'));
						exit;
					}
				} else {
					echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
					exit;
				}
			}

			if ($this->session->tempdata('temp_item')->form_type == 'registered_user') {
				$all_data['user_data'] = $this->session->tempdata('temp_item');
				$all_data['non_user_data'] = [];
			} else {
				$all_data['user_data'] = [];
				$all_data['non_user_data'] = $this->session->tempdata('temp_item');
			}
			if ($this->session->tempdata('temp_item')->entered_status == 'emirates_id') {
				$all_data['new_data'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $this->session->tempdata('temp_item')->entered_eid]);
			} else if ($this->session->tempdata('temp_item')->entered_status == 'ku_id') {
				$all_data['new_data'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['ku_id' => $this->session->tempdata('temp_item')->entered_eid]);
			} else {
				$all_data['new_data'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $this->session->tempdata('temp_item')->entered_eid]);
			}

			// echo "<pre>";print_r($all_data);exit;
			$this->load->view('includes/header', $all_data);
			$this->load->view('unregister_user_page', $all_data);
			$this->load->view('includes/footer');
		} else {
			redirect('enter-e-id');
		}
	}

	public function check_strong_password($str)
	{
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
			return TRUE;
		}
		$this->form_validation->set_message('check_strong_password', 'The password field must be contains at least one letter and one digit.');
		return FALSE;
	}

	public function login_page()
	{
		delete_cookie('user_name');
		$all_data['page'] = 'Login';
		if ($this->input->post()) {
			extract($this->input->post());
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required'); //min_length[6]|max_length[25]

			if ($this->form_validation->run() === TRUE) {
				$formData = $this->input->post();
				$password_user = md5(md5($formData['password']));
				$get_user = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['p_email' => $formData['email'], 'password' => $password_user]);
				// echo "<pre>";print_r($get_user);exit;
				if ($get_user) {
					$my_cookie = array(
						'name'   => 'user_name',
						'value'  => $get_user->id,
						'expire' => 86500,
						'secure' => TRUE
					);
					$this->input->set_cookie($my_cookie);
					echo json_encode(array('error' => false, 'message' => 'You have logged in successfully!'));
					exit;
				} else {
					echo json_encode(array('error' => true, 'message' => 'Invalid credentials!'));
					exit;
				}
			} else {
				echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
				exit;
			}
		}

		$this->load->view('includes/header', $all_data);
		$this->load->view('login', $all_data);
		$this->load->view('includes/footer');
	}

	public function download_page()
	{
		$all_data['page'] = 'Download';

		if ($this->input->cookie('ad_mn', TRUE)) {
			redirect('export');
		}

		$this->load->view('includes/header', $all_data);
		$this->load->view('download', $all_data);
		$this->load->view('includes/footer');
	}

	public function export()
	{
		if ($this->input->cookie('ad_mn', TRUE)) {
			$this->load->library('excel');

			$all_data = $this->dbconnect->getAll(TBL_ALUMNI_FORM, 'id', 'ASC');
			foreach ($all_data as $data) {
				$get_det = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['id' => $data->profile_id]);
				$status = $this->dbconnect->getWhere(TBL_STATUS, ['card_profile_id' => $data->id], true);
				
				if ($get_det) {
					($get_det->ku_id) ? $data->ku_id = $get_det->ku_id : $data->ku_id = '';
					($get_det->emirates_id) ? $data->e_id = $get_det->emirates_id : $data->e_id = '';
				} else {
					$data->ku_id = $data->ku_id;
					$data->e_id = $data->emiratesid;
				}
				if ($status) {
					$data->status = $status->card_status;
				} else {
					$data->status = '';
				}
				
				if (!$data->emirates_id_file) {
					$emirates_file = $this->dbconnect->getWhere(TBL_TMP_USER_DETAILS, ['id' => $data->profile_id], true);
					if ($emirates_file) {
						$data->emirates_id_file = $emirates_file->emirates_id_file;
					}
				}
			}
			$stats_ = 'non_ajax_request';
			$worksheet_title = 'KU-Alumni Card Application 2022';
			$logo = FCPATH . 'assets/images/logo.png';
			$this->__excel(array_merge(compact('worksheet_title', 'logo', 'stats_'), ['data' => $all_data]));
		} else {
			if ($this->input->post()) {
				extract($this->input->post());
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				if ($this->form_validation->run() === TRUE) {
					$password_admin = md5(md5(md5($this->input->post('password'))));
					$get_user = $this->dbconnect->fetchAllDetails(TBL_CARD_LOGIN, ['username' => 'admin', 'password' => $password_admin, 'usertype' => 'admin']);
					if ($get_user) {
						$this->load->library('excel');

						$all_data = $this->dbconnect->getAll(TBL_ALUMNI_FORM, 'id', 'ASC');
						foreach ($all_data as $data) {
							$get_det = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['id' => $data->profile_id]);
							$status = $this->dbconnect->getWhere(TBL_STATUS, ['card_profile_id' => $data->id], true);
							if ($get_det) {
								($get_det->ku_id) ? $data->ku_id = $get_det->ku_id : $data->ku_id = '';
								($get_det->emirates_id) ? $data->e_id = $get_det->emirates_id : $data->e_id = '';
							} else {
								$data->ku_id = $data->ku_id;
								$data->e_id = $data->emiratesid;
							}
							if ($status) {
								$data->status = $status->card_status;
							} else {
								$data->status = '';
							}
						}
						$stats_ = 'ajax_request';
						$worksheet_title = 'KU-Alumni Card Application 2022';
						$logo = FCPATH . 'assets/images/logo.png';
						$this->__excel(array_merge(compact('worksheet_title', 'logo', 'stats_'), ['data' => $all_data]));
					} else {
						echo json_encode(array('error' => true, 'message' => 'Wrong Password!'));
						exit;
					}
				} else {
					echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
					exit;
				}
			}
		}
		// echo phpinfo();exit;
	}

	private function __excel($params)
	{
		extract($params);
		//  echo "<pre>";print_r($params);exit;
		$this->excel->setActiveSheetIndex(0);
		$worksheet_title = (strlen($worksheet_title) > 31) ? substr($worksheet_title, 0, 31) : $worksheet_title;
		$this->excel->getActiveSheet()->setTitle($worksheet_title);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

		$this->excel->getActiveSheet()->mergeCells('A1:A3');

		$excelDrawing = new PHPExcel_Worksheet_Drawing();
		$excelDrawing->setPath($logo);

		$excel = new stdClass();
		$excel->format = (extension_loaded('zip') && class_exists('ZipArchive')) ? 'Excel2007' : 'Excel5';
		switch ($excel->format) {
			case 'Excel5':
				$excelDrawing->setCoordinates('A1')->setHeight(60)->setWidth(54.5)->setOffsetX(32.5)->setOffsetY(5);
				$excel->extention = '.xls';
				$excel->content_type = 'application/vnd.ms-excel;charset=utf-8;';
				break;
			case 'Excel2007':
				$excelDrawing->setCoordinates('A1')->setHeight(60)->setWidth(54.5)->setOffsetX(32.5)->setOffsetY(5);
				$excel->extention = '.xlsx';
				$excel->content_type = 'application/openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8;';
				break;
		}
		//$excelDrawing->setWorksheet($this->excel->getActiveSheet());

		//set cell A1 content with some text                
		$this->excel->getActiveSheet()->setCellValue('B2', $worksheet_title);

		$start_cell = 6;
		$col = 0;
		$LeftColumns = [];
		$RightColumns = [];
		$CenterColumns = [];

		// ACCOUNT DETAILS
		$this->excel->getActiveSheet()->setCellValue('A5', '');
		$this->excel->getActiveSheet()->mergeCells("A5:G5");
		$styleArrayGroupCombo1 = [
			'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']],],
			'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '000000'],],
			'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => ['rgb' => 'FFA07A'],]
		];
		$this->excel->getActiveSheet()->getStyle("A5:I5")->applyFromArray($styleArrayGroupCombo1);
		$this->excel->getActiveSheet()->getStyle("A5:I5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue("A{$start_cell}", 'Registered Email');
		$this->excel->getActiveSheet()->setCellValue("B{$start_cell}", 'Full Name');
		$this->excel->getActiveSheet()->setCellValue("C{$start_cell}", 'KU ID');
		$this->excel->getActiveSheet()->setCellValue("D{$start_cell}", 'Emirates ID / Passport');
		$this->excel->getActiveSheet()->setCellValue("E{$start_cell}", 'Emirates ID / Passport File');
		$this->excel->getActiveSheet()->setCellValue("F{$start_cell}", 'Profile Photo');
		$this->excel->getActiveSheet()->setCellValue("G{$start_cell}", 'Degree');
		$this->excel->getActiveSheet()->setCellValue("H{$start_cell}", 'Major');
		$this->excel->getActiveSheet()->setCellValue("I{$start_cell}", 'Degree graduation year');
		$this->excel->getActiveSheet()->setCellValue("J{$start_cell}", 'Graduation institution');

		// PERSONAL DETAILS
		$this->excel->getActiveSheet()->setCellValue('J5', '');
		$this->excel->getActiveSheet()->mergeCells("J5:O5");
		$styleArrayGroupCombo2 = [
			'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']],],
			'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '000000'],],
			'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => ['rgb' => 'FFA07A'],]
		];
		$this->excel->getActiveSheet()->getStyle("H5:M5")->applyFromArray($styleArrayGroupCombo2);
		$this->excel->getActiveSheet()->getStyle("H5:M5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue("K{$start_cell}", 'Mobile');
		$this->excel->getActiveSheet()->setCellValue("L{$start_cell}", 'Personal Email');
		$this->excel->getActiveSheet()->setCellValue("M{$start_cell}", 'Country of Residence');
		$this->excel->getActiveSheet()->setCellValue("N{$start_cell}", 'Nationality');
		$this->excel->getActiveSheet()->setCellValue("O{$start_cell}", 'LinkedIn Account');
		$this->excel->getActiveSheet()->setCellValue("P{$start_cell}", 'Employment status');

		$this->excel->getActiveSheet()->setCellValue("Q{$start_cell}", 'Company name:');
		$this->excel->getActiveSheet()->setCellValue("R{$start_cell}", 'Job Title');
		$this->excel->getActiveSheet()->setCellValue("S{$start_cell}", 'Your work email');
		$this->excel->getActiveSheet()->setCellValue("T{$start_cell}", 'Sector');
		$this->excel->getActiveSheet()->setCellValue("U{$start_cell}", 'Type');
		$this->excel->getActiveSheet()->setCellValue("V{$start_cell}", 'Would you say the specialization you studied at KU is relevant to your business?');

		$this->excel->getActiveSheet()->setCellValue("W{$start_cell}", 'Why you are not satisfied with your job?');

		$this->excel->getActiveSheet()->setCellValue("X{$start_cell}", 'Industry');

		$this->excel->getActiveSheet()->setCellValue("Y{$start_cell}", 'Sector preference');
		$this->excel->getActiveSheet()->setCellValue("Z{$start_cell}", 'Work Emirate Preference');
		$this->excel->getActiveSheet()->setCellValue("AA{$start_cell}", 'What type of job you are looking for?');

		$this->excel->getActiveSheet()->setCellValue("AB{$start_cell}", 'Why are you not looking for a job?');

		$this->excel->getActiveSheet()->setCellValue("AC{$start_cell}", 'Status');
		$this->excel->getActiveSheet()->setCellValue("AD{$start_cell}", 'Date');

		// echo "<pre>";print_r($params);exit;
		$last_cell_num = 30;
		$last_cell_name = $this->excel->getNameFromNumber($last_cell_num);

		// Main Heading
		$this->excel->getActiveSheet()->mergeCells("B2:{$last_cell_name}2");
		$this->excel->getActiveSheet()->getStyle("B2:{$last_cell_name}2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$this->excel->getActiveSheet()->getStyle("B2:{$last_cell_name}2")->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('000000');

		$exceldata = [];
		$num = 1;
		foreach ($data as $row) {
			$emp = json_decode($row->employment_details);
			$new_emp_details = [];

			if ($row->middle_name) {
				if (trim($row->middle_name) == '-') {
					$row->middle_name = '';
				}
			}
			$exceldata_row = [];
			$exceldata_row[] = $row->reg_email;
			$exceldata_row[] = ($row->full_name) ? $row->full_name : $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name;
			$exceldata_row[] = $row->ku_id;
			$exceldata_row[] = ($row->emiratesid) ? $row->emiratesid : $row->e_id;
			$exceldata_row[] = ($row->emirates_id_file) ? base_url() . 'uploads/temp_ku_id/' . $row->emirates_id_file : '';
			$exceldata_row[] = ($row->profile_photo) ? base_url() . 'uploads/' . $row->profile_photo : '';
			$exceldata_row[] = $row->degree;
			$exceldata_row[] = $row->major;
			$exceldata_row[] = $row->d_year;
			$exceldata_row[] = $row->g_insti;

			$exceldata_row[] = $row->mobile;
			$exceldata_row[] = $row->personal_email;
			$exceldata_row[] = $row->country;
			$exceldata_row[] = $row->nationality;
			$exceldata_row[] = $row->linkd_in;
			$exceldata_row[] = $row->e_status;
			if ($row->e_status == 'Employed and satisfied') {
				$exceldata_row[] = $emp->c_name;
				$exceldata_row[] = $emp->j_title;
				$exceldata_row[] = $emp->w_email;
				$exceldata_row[] = $emp->sector;
				$exceldata_row[] = $emp->type_sec_1;
				$exceldata_row[] = $emp->business_1;
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
			} else if ($row->e_status == 'Employed, but unsatisfied') {
				$exceldata_row[] = $emp->c_name;
				$exceldata_row[] = '';
				$exceldata_row[] = $emp->w_email;
				$exceldata_row[] = $emp->sector;
				$exceldata_row[] = $emp->type_sec_2;
				$exceldata_row[] = $emp->business_2;
				$exceldata_row[] = $emp->satisfied;
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
			} else if ($row->e_status == 'Self-Employed') {
				$exceldata_row[] = $emp->c_name;
				$exceldata_row[] = '';
				$exceldata_row[] = $emp->w_email;
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = $emp->special_3;
				$exceldata_row[] = '';
				$exceldata_row[] = $emp->industry;
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
			} else if ($row->e_status == 'Unemployed and looking for a job') {
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = $emp->preference_4;
				$exceldata_row[] = $emp->w_emirate;
				$exceldata_row[] = $emp->type_sec_4;
				$exceldata_row[] = '';
			} else if ($row->e_status == 'Unemployed, but not looking for a job') {
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = '';
				$exceldata_row[] = $emp->looking_job_5;
			}
			$exceldata_row[] = $row->status;
			$exceldata_row[] = $row->datetime;

			$exceldata[] = $exceldata_row;
			$num++;
		}
		// echo "<pre>";print_r($exceldata);exit;
		$last_cell = $start_cell + count($exceldata);

		for ($colNum = 1; $colNum <= $last_cell_num; $colNum++) {
			$colName = $this->excel->getNameFromNumber($colNum);
			switch ($colName) {
				default:
					$this->excel->getActiveSheet()->getColumnDimension($colName)->setAutoSize(true);
			}
			$this->excel->getActiveSheet()->getStyle("{$colName}{$start_cell}:{$colName}{$last_cell}")
				->getAlignment()
				->setHorizontal((in_array($colName, $CenterColumns)) ? PHPExcel_Style_Alignment::HORIZONTAL_CENTER : ((in_array($colName, $RightColumns)) ? PHPExcel_Style_Alignment::HORIZONTAL_RIGHT : PHPExcel_Style_Alignment::HORIZONTAL_LEFT))
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
				->setWrapText(true);
			$this->excel->getActiveSheet()->getStyle("{$colName}{$start_cell}:{$colName}{$last_cell}")
				->getNumberFormat()
				->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		}

		$styleArrayHead = array(
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM, 'color' => array('rgb' => '111111')),),
			'font' => array('bold' => true, 'size' => 11, 'color' => array('rgb' => 'ffffff')),
			'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => '111111'))
		);
		$styleArrayBody = array(
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
			'font' => array('size' => 12),
		);
		$this->excel->getActiveSheet()->getStyle("A{$start_cell}:{$last_cell_name}{$start_cell}")->applyFromArray($styleArrayHead);
		$this->excel->getActiveSheet()->getStyle("A" . ($start_cell + 1) . ":{$last_cell_name}{$last_cell}")->applyFromArray($styleArrayBody);

		if ($exceldata) {
			$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A' . ($start_cell + 1));
			$rowid = ($start_cell + 1);
			foreach ($exceldata as $row) {
				$columnList = array_map(function ($char) {
					return $this->excel->getNameFromNumber($char);
				}, range(1, $last_cell_num));
				foreach (range(0, count($row) - 1) as $num) {
					switch ($num) {
						default:
							//$this->excel->getActiveSheet()->setCellValueExplicit("{$columnList[$num]}{$rowid}", $row[$num],  PHPExcel_Cell_DataType::TYPE_NUMERIC);
							$this->excel->getActiveSheet()->setCellValueExplicit("{$columnList[$num]}{$rowid}", $row[$num], PHPExcel_Cell_DataType::TYPE_STRING);
					}
				}
				$rowid++;
			}
		}

		ob_start();
		$filename = url_title($worksheet_title, '-', true) . '-' . date('d-m-Y') . $excel->extention;
		header('Content-Type: ' . $excel->content_type);
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $excel->format);
		$objWriter->save('php://output'); //echo "<pre>";print_r($last_cell);exit;

		if ($stats_ == 'ajax_request') {
			$xlsData = ob_get_contents();
			ob_end_clean();
			// echo json_encode(array('error' => false, 'file' => 'Wrong Password!'));
			// 		exit;

			$response =  array(
				'file_name' => $filename,
				'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData)
			);
			die(json_encode($response));
		}
	}

	public function reset_password($code)
	{
		if ($code) {
			$check_code = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['user_code' => $code]);
			if ($check_code) {
				$all_data['page'] = 'Reset password';
				$all_data['user_details'] = $check_code;

				if ($this->input->post()) {
					extract($this->input->post());
					$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|max_length[25]|callback_check_strong_password');
					$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

					if ($this->form_validation->run() === TRUE) {
						$formData = $this->input->post();
						$get_user = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['user_code' => $code]);
						// $check_password = $this->dbconnect->fetchAllDetails(TBL_CARD_LOGIN, ['email' => $formData['email'], 'reset_code' => $formData['unique_code']]);
						if ($get_user) {
							$new_password = md5(md5($formData['new_password']));
							$update_data = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['p_email' => $get_user->p_email], ['password' => $new_password]);
							if ($update_data) {
								$update_data = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['p_email' => $get_user->p_email], ['user_code' => NULL]);
								echo json_encode(array('error' => false, 'message' => 'Password changed successfully, please login'));
								exit;
							} else {
								echo json_encode(array('error' => false, 'message' => 'Due to some issues unable to change password, please try again'));
								exit;
							}
						} else {
							echo json_encode(array('error' => true, 'message' => 'The code you entered is incorrect!'));
							exit;
						}
					} else {
						echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
						exit;
					}
				}


				$this->load->view('includes/header', $all_data);
				$this->load->view('reset_password', $all_data);
				$this->load->view('includes/footer');
			} else {
				redirect('enter-e-id');
			}
		} else {
			redirect('enter-e-id');
		}
	}

	public function crop_image()
	{
		// echo "<pre>"; print_r($this->input->post());exit;
		$data = $this->input->post('image');
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$imageName = time() . '.jpg';
		$image_path = 'uploads/' . $imageName;
		file_put_contents($image_path, $data);
		echo $imageName;
	}

	public function export_registers()
	{
		if ($this->input->cookie('ad_mn', TRUE)) {
			$this->load->library('excel');

			$all_data = $this->dbconnect->getAll(TBL_TMP_USER_DETAILS, 'id', 'ASC');
			$stats_ = 'non_ajax_request';
			$worksheet_title = 'KU-Alumni Card Registrants 2022';
			$logo = FCPATH . 'assets/images/logo.png';
			$this->__excel_reg(array_merge(compact('worksheet_title', 'logo', 'stats_'), ['data' => $all_data]));
		}
		// echo phpinfo();exit;
	}

	private function __excel_reg($params)
	{
		extract($params);
		//echo '<pre>'; print_r($params);exit;
		$this->excel->setActiveSheetIndex(0);
		$worksheet_title = (strlen($worksheet_title) > 31) ? substr($worksheet_title, 0, 31) : $worksheet_title;
		$this->excel->getActiveSheet()->setTitle($worksheet_title);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

		$this->excel->getActiveSheet()->mergeCells('A1:A3');

		$excelDrawing = new PHPExcel_Worksheet_Drawing();
		$excelDrawing->setPath($logo);

		$excel = new stdClass();
		$excel->format = (extension_loaded('zip') && class_exists('ZipArchive')) ? 'Excel2007' : 'Excel5';
		switch ($excel->format) {
			case 'Excel5':
				$excelDrawing->setCoordinates('A1')->setHeight(60)->setWidth(54.5)->setOffsetX(32.5)->setOffsetY(5);
				$excel->extention = '.xls';
				$excel->content_type = 'application/vnd.ms-excel;charset=utf-8;';
				break;
			case 'Excel2007':
				$excelDrawing->setCoordinates('A1')->setHeight(60)->setWidth(54.5)->setOffsetX(32.5)->setOffsetY(5);
				$excel->extention = '.xlsx';
				$excel->content_type = 'application/openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8;';
				break;
		}
		// /$excelDrawing->setWorksheet($this->excel->getActiveSheet());

		//set cell A1 content with some text                
		$this->excel->getActiveSheet()->setCellValue('B2', $worksheet_title);

		$start_cell = 6;
		$LeftColumns = [];
		$RightColumns = ['H', 'I', 'J', 'AC'];
		$CenterColumns = []; //['B', 'C', 'D', 'E', 'G', 'Q', 'R', 'AA', 'AB', 'AC'];

		// ACCOUNT DETAILS
		$this->excel->getActiveSheet()->setCellValue('A5', '');
		$this->excel->getActiveSheet()->mergeCells("A5:G5");
		$styleArrayGroupCombo1 = [
			'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']],],
			'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '000000'],],
			'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => ['rgb' => 'FFA07A'],]
		];
		$this->excel->getActiveSheet()->getStyle("A5:G5")->applyFromArray($styleArrayGroupCombo1);
		$this->excel->getActiveSheet()->getStyle("A5:G5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue("A{$start_cell}", 'KU ID');
		$this->excel->getActiveSheet()->setCellValue("B{$start_cell}", 'Emirates ID');
		$this->excel->getActiveSheet()->setCellValue("C{$start_cell}", 'Full Name');
		$this->excel->getActiveSheet()->setCellValue("D{$start_cell}", 'Major');
		$this->excel->getActiveSheet()->setCellValue("E{$start_cell}", 'Graduation');
		$this->excel->getActiveSheet()->setCellValue("F{$start_cell}", 'Country');
		$this->excel->getActiveSheet()->setCellValue("G{$start_cell}", 'Nationality');

		// PERSONAL DETAILS
		$this->excel->getActiveSheet()->setCellValue('H5', '');
		$this->excel->getActiveSheet()->mergeCells("H5:O5");
		$styleArrayGroupCombo2 = [
			'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => ['rgb' => '000000']],],
			'font' => ['bold' => true, 'size' => 11, 'color' => ['rgb' => '000000'],],
			'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => ['rgb' => 'FFA07A'],]
		];
		$this->excel->getActiveSheet()->getStyle("H5:O5")->applyFromArray($styleArrayGroupCombo2);
		$this->excel->getActiveSheet()->getStyle("H5:O5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue("H{$start_cell}", 'Personal Email');
		$this->excel->getActiveSheet()->setCellValue("I{$start_cell}", 'Mobile');
		$this->excel->getActiveSheet()->setCellValue("J{$start_cell}", 'Registrant Type');
		$this->excel->getActiveSheet()->setCellValue("K{$start_cell}", 'User Action');
		$this->excel->getActiveSheet()->setCellValue("L{$start_cell}", 'Admin Action');
		$this->excel->getActiveSheet()->setCellValue("M{$start_cell}", 'Emirates ID File');
		$this->excel->getActiveSheet()->setCellValue("N{$start_cell}", 'Profile Picture');
		$this->excel->getActiveSheet()->setCellValue("O{$start_cell}", 'Date');


		//echo "<pre>";print_r($params);exit;
		$last_cell_num = 15;
		$last_cell_name = $this->excel->getNameFromNumber($last_cell_num);

		// Main Heading
		$this->excel->getActiveSheet()->mergeCells("B2:{$last_cell_name}2");
		$this->excel->getActiveSheet()->getStyle("B2:{$last_cell_name}2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$this->excel->getActiveSheet()->getStyle("B2:{$last_cell_name}2")->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('000000');

		$exceldata = [];
		$num = 1;
		foreach ($data as $row) {
			$exceldata_row = [];
			$exceldata_row[] = $row->ku_id;
			$exceldata_row[] = $row->emirates_id;
			$exceldata_row[] = $row->full_name;
			$exceldata_row[] = $row->major;
			$exceldata_row[] = $row->graduation;
			$exceldata_row[] = $row->country;
			$exceldata_row[] = $row->nationality;

			$exceldata_row[] = $row->p_email;
			$exceldata_row[] = $row->mobile;
			$exceldata_row[] = $row->form_type;
			$exceldata_row[] = $row->user_status;
			$exceldata_row[] = $row->admin_status;
			$exceldata_row[] = ($row->emirates_id_file) ? base_url() . 'uploads/temp_ku_id/' . $row->emirates_id_file : '';
			$exceldata_row[] = ($row->profile_pic_org) ? base_url() . 'uploads/' . $row->profile_pic_org : '';
			$exceldata_row[] = $row->datetime;

			$exceldata[] = $exceldata_row;
			$num++;
		} //echo "<pre>";print_r($exceldata_row);exit;
		$last_cell = $start_cell + count($exceldata);
		// echo "<pre>";print_r($last_cell);exit;
		for ($colNum = 1; $colNum <= $last_cell_num; $colNum++) {
			$colName = $this->excel->getNameFromNumber($colNum);
			switch ($colName) {
				default:
					$this->excel->getActiveSheet()->getColumnDimension($colName)->setAutoSize(true);
			}
			$this->excel->getActiveSheet()->getStyle("{$colName}{$start_cell}:{$colName}{$last_cell}")
				->getAlignment()
				->setHorizontal((in_array($colName, $CenterColumns)) ? PHPExcel_Style_Alignment::HORIZONTAL_CENTER : ((in_array($colName, $RightColumns)) ? PHPExcel_Style_Alignment::HORIZONTAL_RIGHT : PHPExcel_Style_Alignment::HORIZONTAL_LEFT))
				->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP)
				->setWrapText(true);
			$this->excel->getActiveSheet()->getStyle("{$colName}{$start_cell}:{$colName}{$last_cell}")
				->getNumberFormat()
				->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		}

		$styleArrayHead = array(
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM, 'color' => array('rgb' => '111111')),),
			'font' => array('bold' => true, 'size' => 11, 'color' => array('rgb' => 'ffffff')),
			'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => '111111'))
		);
		$styleArrayBody = array(
			'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
			'font' => array('size' => 12),
		);
		$this->excel->getActiveSheet()->getStyle("A{$start_cell}:{$last_cell_name}{$start_cell}")->applyFromArray($styleArrayHead);
		$this->excel->getActiveSheet()->getStyle("A" . ($start_cell + 1) . ":{$last_cell_name}{$last_cell}")->applyFromArray($styleArrayBody);

		if ($exceldata) {
			$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A' . ($start_cell + 1));
			$rowid = ($start_cell + 1);
			foreach ($exceldata as $row) {
				$columnList = array_map(function ($char) {
					return $this->excel->getNameFromNumber($char);
				}, range(1, $last_cell_num));
				foreach (range(0, count($row) - 1) as $num) {
					switch ($num) {
						default:
							//$this->excel->getActiveSheet()->setCellValueExplicit("{$columnList[$num]}{$rowid}", $row[$num],  PHPExcel_Cell_DataType::TYPE_NUMERIC);
							$this->excel->getActiveSheet()->setCellValueExplicit("{$columnList[$num]}{$rowid}", $row[$num], PHPExcel_Cell_DataType::TYPE_STRING);
					}
				}
				$rowid++;
			}
		}

		$filename = url_title($worksheet_title, '-', true) . '-' . date('d-m-Y') . $excel->extention;
		header('Content-Type: ' . $excel->content_type);
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $excel->format);
		$objWriter->save('php://output'); //echo "<pre>";print_r($last_cell);exit;
		exit();
	}

	public function image_select($id)
	{
		if ($id) { //_e($decoded);exit;
			$updatedTable = $this->dbconnect->updateQuery(TBL_TMP_EMAIL, ['user_code' => $id], ['receive_status' => 'yes']);
			$updatedTable2 = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['user_code' => $id], ['receive_status' => 'yes']);
		}
	}

	public function image_select_details($id)
	{
		if ($id) { //_e($id);exit;
			$updatedTable = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['p_email' => $id], ['request_detail_status' => 'yes']);
		}
	}

	public function export_images()
	{
		$registrants_data = $this->dbconnect->getAll(TBL_UPDT_DATA, 'id', 'ASC');

		foreach ($registrants_data as $registers) {
			$file_path = FCPATH . 'uploads/' . $registers->profile_photo;
			$ext = pathinfo($file_path, PATHINFO_EXTENSION);
			$newfile = FCPATH . 'download/updates/' . $registers->ku_id . '.' . $ext;
			copy($file_path, $newfile);
		}
		// echo "<pre>"; print_r($registrants_data);exit;
		// $all_data = $registrants_data;
		// 	$stats_ = 'non_ajax_request';
		// 	$worksheet_title = 'KU-Alumni Card Registrants 2022';
		// 	$logo = FCPATH . 'assets/images/logo.png';
		// 	$this->__excel_reg(array_merge(compact('worksheet_title', 'logo', 'stats_'), ['data' => $all_data]));
	}

	public function forget_pass()
	{
		$all_data['page'] = 'Forgot password';
		if ($this->input->post()) {
			extract($this->input->post());
			$check_email = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['p_email' => $email]);
			if ($check_email) {
				if ($check_email->admin_status == 'accepted') {
					if ($check_email->user_code) {
						$code = $check_email->user_code;
					} else {
						$code = uniqid();
						$update_data = $this->dbconnect->updateQuery(TBL_TMP_USER_DETAILS, ['id' => $check_email->id], ['user_code' => $code]);
					}
					$sent_data = $email . '(-)' . $code;
					$encode_code = base64_encode(base64_encode(base64_encode($sent_data)));
					// $url = "https://ku-wordpress.excellencetest.online/ku-card-form-page?forgot-pass=" . $encode_code;
					$url = "https://www.ku.ac.ae/ku-card-form-page?forgot-pass=" . $encode_code;
					echo json_encode(array('error' => false, 'status' => 'success', 'message' => 'An email has been sent to your mail address with reset password link.', 'url' => $url));
					exit;
				} else {
					echo json_encode(array('error' => true, 'message' => 'Your application is still under verification process!'));
					exit;
				}
			} else {
				echo json_encode(array('error' => true, 'message' => 'The email you entered is not registered!'));
				exit;
			}
		}
		$this->load->view('includes/header', $all_data);
		$this->load->view('forgot_password', $all_data);
		$this->load->view('includes/footer');
	}

	public function index()
	{
		if ($this->input->cookie('new_user_name', TRUE)) {
			// echo "<pre>"; print_r(json_decode($this->input->cookie('new_user_name', TRUE)));exit;
			$all_data['user_entered_id'] = json_decode($this->input->cookie('new_user_name', TRUE));
			$all_data['page'] = 'index';
			$all_data['user_details'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['id' => $this->input->cookie('user_name', TRUE)]);
			$all_data['registered_data'] = $this->dbconnect->fetchAllDetails(TBL_ALUMNI_FORM, ['profile_id' => $this->input->cookie('user_name', TRUE)]);

			if ($this->input->post()) {
				extract($this->input->post());
				$this->form_validation->set_rules('emiratesid', 'Emirates ID / Passport', 'required');
				$this->form_validation->set_rules('ku_id', 'KU ID', 'required');
				$this->form_validation->set_rules('first_name', 'First name', 'required');
				$this->form_validation->set_rules('middle_name', 'Middle name', 'required');
				$this->form_validation->set_rules('last_name', 'Last name', 'required');
				$this->form_validation->set_rules('degree', 'Degree', 'required');
				$this->form_validation->set_rules('major', 'Major', 'required');
				$this->form_validation->set_rules('d_year', 'Degree graduation year', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile', 'required');
				$this->form_validation->set_rules('personal_email', 'Personal Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('linkd_in', 'LinkedIn Account', 'required');
				$this->form_validation->set_rules('e_status', 'Employment status', 'required');
				// if ($this->input->post('e_status') == 'Self-Employed') {
				// 	$this->form_validation->set_rules('c_name', 'Company name', 'required');
				// 	$this->form_validation->set_rules('industry', 'Industry', 'required');
				// }

				if ($this->form_validation->run() === TRUE) {
					$formData = $this->input->post();
					// echo "<pre>"; print_r($formData); exit;
					$employment_details = [];
					if ($formData['e_status'] == 'Employed and satisfied') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['j_title'] = $formData['j_title'];
						$employment_details['w_email'] = $formData['w_email'];
						// $employment_details['work_study_1'] = $formData['work-study-1'];
						$employment_details['sector'] = $formData['sector'];
						$employment_details['business_1'] = $formData['business-1'];
						$employment_details['type_sec_1'] = $formData['type-sec-1'];

						if ($formData['type-sec-1'] == 'Other') {
							$employment_details['other_type_1'] = $formData['other_type_1'];
							unset($formData['other_type_1']);
						}
						unset($formData['type-sec-1']);
						unset($formData['c_name']);
						unset($formData['j_title']);
						unset($formData['w_email']);
						// unset($formData['work-study-1']);
						unset($formData['sector']);
						unset($formData['business-1']);
					} else if ($formData['e_status'] == 'Employed, but unsatisfied') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['w_email'] = $formData['w_email'];
						// $employment_details['field_2'] = $formData['field-2'];
						$employment_details['sector'] = $formData['sector'];
						$employment_details['business_2'] = $formData['business-2'];
						$employment_details['satisfied'] = $formData['satisfied'];
						$employment_details['type_sec_2'] = $formData['type-sec-2'];
						if ($formData['type-sec-2'] == 'Other') {
							$employment_details['other_type_2'] = $formData['other_type_2'];
							unset($formData['other_type_2']);
						}
						unset($formData['type-sec-2']);
						unset($formData['c_name']);
						unset($formData['w_email']);
						// unset($formData['field-2']);
						unset($formData['sector']);
						unset($formData['business-2']);
						unset($formData['satisfied']);
					} else if ($formData['e_status'] == 'Self-Employed') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['industry'] = $formData['industry'];
						$employment_details['w_email'] = $formData['w_email'];
						$employment_details['special_3'] = $formData['special-3'];
						unset($formData['c_name']);
						unset($formData['industry']);
						unset($formData['w_email']);
						unset($formData['special-3']);
					} else if ($formData['e_status'] == 'Unemployed and looking for a job') {
						$employment_details['preference_4'] = $formData['preference-4'];
						$employment_details['w_emirate'] = $formData['w_emirate'];
						$employment_details['type_sec_4'] = $formData['type-sec-4'];
						if ($formData['type-sec-4'] == 'Other') {
							$employment_details['other_type_4'] = $formData['other_type_4'];
							unset($formData['other_type_4']);
						}
						unset($formData['type-sec-4']);
						unset($formData['preference-4']);
						unset($formData['w_emirate']);
					} else if ($formData['e_status'] == 'Unemployed, but not looking for a job') {
						$employment_details['looking_job_5'] = $formData['looking-job-5'];
						if ($formData['looking-job-5'] == 'Other') {
							$employment_details['other_look_job'] = $formData['other_look_job'];
							unset($formData['other_look_job']);
						}
						unset($formData['looking-job-5']);
					}
					$formData['employment_details'] = json_encode($employment_details);
					// echo "<pre>";print_r($formData);exit;

					$formData['profile_photo'] = $formData['profile_pic_org'];
					unset($formData['profile_pic_org']);

					$formData['profile_id'] = $this->input->cookie('user_name', TRUE);
					// echo "<pre>";print_r($formData);exit;
					if (!$formData['profile_photo']) {
						$formData['profile_photo'] = $all_data['registered_data']->profile_photo;
					}

					if ($_FILES['emirates_id_file']['name'] != "") {
						$config['upload_path'] = './uploads/temp_ku_id';
						$config['allowed_types'] = 'pdf';
						$config['overwrite'] = TRUE;
						$config['encrypt_name'] = TRUE;
						$config['max_size'] = 20000;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('emirates_id_file')) {
							$error = array('error' => $this->upload->display_errors());
							echo json_encode(array('error' => true, 'message' => '<p>' . $error['error'] . '</p>'));
							exit;
						} else {
							$data = array('upload_data' => $this->upload->data());
							$formData['emirates_id_file'] = pathinfo($data['upload_data']['full_path'])['basename'];
						}
					} else {
						echo json_encode(array('error' => false, 'message' => 'Missing Emirates ID / Passport file!'));
						exit;
					}
					// $formData['mobile'] = $formData['real_phone'];
					// unset($formData['real_phone']);
					// echo "<pre>"; print_r($formData);exit;
					// $check_data_exist = '';

					$insert_data = $this->dbconnect->register_data(TBL_ALUMNI_FORM, $formData);

					delete_cookie('new_user_name');
					$url = base_url() . 'confirmation';
					echo json_encode(array('error' => false, 'message' => 'Thank you for applying for KU Alumni card. Alumni Office will contact you once your card is ready for collection', 'url' => $url));
					exit;
				} else {
					echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
					exit;
				}
			}
			// echo "<pre>";print_r($all_data);exit;
			$this->load->view('includes/header', $all_data);
			$this->load->view('index_1', $all_data);
			$this->load->view('includes/footer');
		} else {
			redirect('login');
		}
	}

	public function thankyou()
	{
		$all_data['page'] = 'Thank you';
		$this->load->view('includes/header', $all_data);
		$this->load->view('thank_page', $all_data);
		$this->load->view('includes/footer');
	}

	public function login_test()
	{
		delete_cookie('new_user_name');
		$all_data['page'] = 'Login';
		$url = base_url();
		if ($this->input->post()) {
			extract($this->input->post());
			$this->form_validation->set_rules('emirates_id', 'Emirates ID / KU ID', 'trim|required');
			// echo "<pre>"; print_r($this->input->post());exit;

			if ($this->form_validation->run() === TRUE) {
				$edit_array = [];
				$get_old_data = $this->dbconnect->fetchAllDetails(TBL_ALUMNI_FORM, ['emiratesid' => $emirates_id]);
				$get_old_data_1 = $this->dbconnect->fetchAllDetails(TBL_ALUMNI_FORM, ['ku_id' => $emirates_id]);
				$get_temp_data_1 = $this->dbconnect->check_alumni_emirates(TBL_TMP_USER_DETAILS, $emirates_id); //print_r($get_temp_data_1);exit;
				// $get_temp_data_1 = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $emirates_id]);
				if ($get_temp_data_1) {
					$get_old_data_2 = $this->dbconnect->fetchAllDetails(TBL_ALUMNI_FORM, ['profile_id' => $get_temp_data_1->id]);
				} else {
					$get_old_data_2 = '';
				}
				$get_temp_data_2 = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['ku_id' => $emirates_id]);
				if ($get_temp_data_2) {
					$get_old_data_3 = $this->dbconnect->fetchAllDetails(TBL_ALUMNI_FORM, ['profile_id' => $get_temp_data_2->id]);
				} else {
					$get_old_data_3 = '';
				}
				array_push($edit_array, $get_old_data, $get_old_data_1, $get_old_data_2, $get_old_data_3);
				// echo "<pre>"; print_r($edit_array);exit;
				if ($edit_array) {
					foreach ($edit_array as $item) {
						if ($item) {
							if (isset($item->emiratesid)) {
								$item->emirates_id = $item->emiratesid;
							}
							if ($item->editable == 'yes') {
								$my_cookie = array(
									'name'   => 'new_user_name',
									'value'  => json_encode(['emirates_id' => $item->emirates_id, 'ku_id' => '']),
									'expire' => 86500,
									'secure' => TRUE
								);
								$this->input->set_cookie($my_cookie);
								$url = base_url('edit');
								echo json_encode(array('error' => false, 'message' => 'You have logged in successfully!', 'url' => $url));
								exit;
							}
						}
					}
				}
				if ($get_old_data || $get_old_data_1 || $get_old_data_2 || $get_old_data_3) {
					echo json_encode(array('error' => true, 'message' => 'You have already submitted the application. <br> For further queries contact <a href="mailto:KUAlumni@ku.ac.ae">KUAlumni@ku.ac.ae</a>'));
					exit;
				} else {
					$get_emirates_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['emirates_id' => $emirates_id]);
					if ($get_emirates_id) {
						$my_cookie = array(
							'name'   => 'new_user_name',
							'value'  => json_encode(['emirates_id' => $get_emirates_id->emirates_id, 'ku_id' => '']),
							'expire' => 86500,
							'secure' => TRUE
						);
						$this->input->set_cookie($my_cookie);
						echo json_encode(array('error' => false, 'message' => 'You have logged in successfully!', 'url' => $url));
						exit;
					} else {
						$get_ku_id = $this->dbconnect->fetchAllDetails(TBL_USER_DETAILS, ['ku_id' => $emirates_id]);
						if ($get_ku_id) {
							$my_cookie = array(
								'name'   => 'new_user_name',
								'value'  => json_encode(['emirates_id' => '', 'ku_id' => $get_ku_id->ku_id]),
								'expire' => 86500,
								'secure' => TRUE
							);
							$this->input->set_cookie($my_cookie);
							echo json_encode(array('error' => false, 'message' => 'You have logged in successfully!', 'url' => $url));
							exit;
						} else {
							echo json_encode(array('error' => true, 'message' => 'Your Emirates ID / KU ID is not registered in the system.<br> For further queries contact <a href="mailto:KUAlumni@ku.ac.ae">KUAlumni@ku.ac.ae</a>'));
							exit;
						}
					}
				}
			} else {
				echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
				exit;
			}
		}

		$this->load->view('includes/header', $all_data);
		$this->load->view('login_1', $all_data);
		$this->load->view('includes/footer');
	}

	public function homepage_edit()
	{
		if ($this->input->cookie('new_user_name', TRUE)) {
			// echo "<pre>"; print_r(json_decode($this->input->cookie('new_user_name', TRUE)));exit;
			$user_entered_id = json_decode($this->input->cookie('new_user_name', TRUE));
			$all_data['page'] = 'index';
			// $all_data['user_details'] = $this->dbconnect->fetchAllDetails(TBL_TMP_USER_DETAILS, ['emirates_id' => $user_entered_id->emirates_id]);
			$all_data['registered_data'] = $this->dbconnect->fetchAllDetails(TBL_ALUMNI_FORM, ['emiratesid' => $user_entered_id->emirates_id]);
			// echo "<pre>"; print_r($all_data['registered_data']);exit;
			if ($this->input->post()) {
				extract($this->input->post());
				$this->form_validation->set_rules('emiratesid', 'Emirates ID / Passport', 'required');
				$this->form_validation->set_rules('ku_id', 'KU ID', 'required');
				$this->form_validation->set_rules('first_name', 'First name', 'required');
				$this->form_validation->set_rules('middle_name', 'Middle name', 'required');
				$this->form_validation->set_rules('last_name', 'Last name', 'required');
				$this->form_validation->set_rules('degree', 'Degree', 'required');
				$this->form_validation->set_rules('major', 'Major', 'required');
				$this->form_validation->set_rules('d_year', 'Degree graduation year', 'required');
				$this->form_validation->set_rules('mobile', 'Mobile', 'required');
				$this->form_validation->set_rules('personal_email', 'Personal Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('linkd_in', 'LinkedIn Account', 'required');
				$this->form_validation->set_rules('e_status', 'Employment status', 'required');
				// if ($this->input->post('e_status') == 'Self-Employed') {
				// 	$this->form_validation->set_rules('c_name', 'Company name', 'required');
				// 	$this->form_validation->set_rules('industry', 'Industry', 'required');
				// }

				if ($this->form_validation->run() === TRUE) {
					$formData = $this->input->post();
					// echo "<pre>"; print_r($formData); exit;
					$employment_details = [];
					if ($formData['e_status'] == 'Employed and satisfied') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['j_title'] = $formData['j_title'];
						$employment_details['w_email'] = $formData['w_email'];
						// $employment_details['work_study_1'] = $formData['work-study-1'];
						$employment_details['sector'] = $formData['sector'];
						$employment_details['business_1'] = $formData['business-1'];
						$employment_details['type_sec_1'] = $formData['type-sec-1'];

						if ($formData['type-sec-1'] == 'Other') {
							$employment_details['other_type_1'] = $formData['other_type_1'];
							unset($formData['other_type_1']);
						}
						unset($formData['type-sec-1']);
						unset($formData['c_name']);
						unset($formData['j_title']);
						unset($formData['w_email']);
						// unset($formData['work-study-1']);
						unset($formData['sector']);
						unset($formData['business-1']);
					} else if ($formData['e_status'] == 'Employed, but unsatisfied') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['w_email'] = $formData['w_email'];
						// $employment_details['field_2'] = $formData['field-2'];
						$employment_details['sector'] = $formData['sector'];
						$employment_details['business_2'] = $formData['business-2'];
						$employment_details['satisfied'] = $formData['satisfied'];
						$employment_details['type_sec_2'] = $formData['type-sec-2'];
						if ($formData['type-sec-2'] == 'Other') {
							$employment_details['other_type_2'] = $formData['other_type_2'];
							unset($formData['other_type_2']);
						}
						unset($formData['type-sec-2']);
						unset($formData['c_name']);
						unset($formData['w_email']);
						// unset($formData['field-2']);
						unset($formData['sector']);
						unset($formData['business-2']);
						unset($formData['satisfied']);
					} else if ($formData['e_status'] == 'Self-Employed') {
						$employment_details['c_name'] = $formData['c_name'];
						$employment_details['industry'] = $formData['industry'];
						$employment_details['w_email'] = $formData['w_email'];
						$employment_details['special_3'] = $formData['special-3'];
						unset($formData['c_name']);
						unset($formData['industry']);
						unset($formData['w_email']);
						unset($formData['special-3']);
					} else if ($formData['e_status'] == 'Unemployed and looking for a job') {
						$employment_details['preference_4'] = $formData['preference-4'];
						$employment_details['w_emirate'] = $formData['w_emirate'];
						$employment_details['type_sec_4'] = $formData['type-sec-4'];
						if ($formData['type-sec-4'] == 'Other') {
							$employment_details['other_type_4'] = $formData['other_type_4'];
							unset($formData['other_type_4']);
						}
						unset($formData['type-sec-4']);
						unset($formData['preference-4']);
						unset($formData['w_emirate']);
					} else if ($formData['e_status'] == 'Unemployed, but not looking for a job') {
						$employment_details['looking_job_5'] = $formData['looking-job-5'];
						if ($formData['looking-job-5'] == 'Other') {
							$employment_details['other_look_job'] = $formData['other_look_job'];
							unset($formData['other_look_job']);
						}
						unset($formData['looking-job-5']);
					}
					$formData['employment_details'] = json_encode($employment_details);
					// echo "<pre>";print_r($formData);exit;

					$formData['profile_photo'] = $formData['profile_pic_org'];
					unset($formData['profile_pic_org']);

					$formData['profile_id'] = $this->input->cookie('user_name', TRUE);
					// echo "<pre>";print_r($formData);exit;
					if (!$formData['profile_photo']) {
						$formData['profile_photo'] = $all_data['registered_data']->profile_photo;
					}

					if ($_FILES['emirates_id_file']['name'] != "") {
						$config['upload_path'] = './uploads/temp_ku_id';
						$config['allowed_types'] = 'pdf';
						$config['overwrite'] = TRUE;
						$config['encrypt_name'] = TRUE;
						$config['max_size'] = 20000;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if (!$this->upload->do_upload('emirates_id_file')) {
							$error = array('error' => $this->upload->display_errors());
							echo json_encode(array('error' => true, 'message' => '<p>' . $error['error'] . '</p>'));
							exit;
						} else {
							$data = array('upload_data' => $this->upload->data());
							$formData['emirates_id_file'] = pathinfo($data['upload_data']['full_path'])['basename'];
						}
					}
					if (!isset($formData['emirates_id_file'])) {
						$formData['emirates_id_file'] = $all_data['registered_data']->emirates_id_file;
					}
					$formData['editable'] = '';
					// unset($formData['real_phone']);
					// echo "<pre>"; print_r($formData);exit;
					// $check_data_exist = '';
					// echo "<pre>"; print_r($formData); exit;
					$update_data = $this->dbconnect->updateQuery(TBL_ALUMNI_FORM, ['id' => $all_data['registered_data']->id], $formData);
					if ($update_data) {
						delete_cookie('new_user_name');
						$url = base_url() . 'confirmation';
						echo json_encode(array('error' => false, 'message' => 'Thank you for applying for KU Alumni card. Alumni Office will contact you once your card is ready for collection', 'url' => $url));
						exit;
					} else {
						echo json_encode(array('error' => true, 'message' => 'Something occured!'));
						exit;
					}
				} else {
					echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
					exit;
				}
			}
			// echo "<pre>";print_r($all_data);exit;
			$this->load->view('includes/header', $all_data);
			$this->load->view('index_2', $all_data);
			$this->load->view('includes/footer');
		} else {
			redirect('login');
		}
	}
}
