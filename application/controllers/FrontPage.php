<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FrontPage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function login_form_1() {

	}

	public function submission_simple()
	{
		$data['page'] = 'submission_portal';

		if ($this->input->post()) {
			$this->form_validation->set_rules('a_title', 'Activity Title', 'required');
			$this->form_validation->set_rules('lead', 'Lead Organization', 'required');
			$this->form_validation->set_rules('name', 'Lead Applicant Name', 'required');
			$this->form_validation->set_rules('email', 'Lead Applicant Email', 'required|valid_email');
			$this->form_validation->set_rules('budget', 'Budget Requested', 'required|numeric|less_than[200000]');

			if ($this->form_validation->run() === TRUE) {
				extract($this->input->post());
				$formData = $this->input->post();

				$config['upload_path']          = './uploads/preproposal/';
				$config['allowed_types']        = 'pdf|png|jpg|jpeg|doc|docx';
				$config['encrypt_name'] = TRUE;
				$config['max_size']             = 5000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('preposal_file')) {
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(array('error' => true, 'message' => '<p>' . $error['error'] . '</p>'));
					exit;
				} else {
					$successData = array('upload_data' => $this->upload->data());
					$formData['preposal_file'] = pathinfo($successData['upload_data']['full_path'])['basename'];
				}
				$formData['datetime'] = date('Y-m-d H:i:s');

				$insert_data = $this->dbconnect->insert(TBL_VIGGO, $formData);

				if ($insert_data) {
					echo json_encode(array('error' => false, 'message' => '<div style="line-height: 2; text-align: center;">Proposal Successfully Submitted!</div>'));
					exit();
				} else {
					echo json_encode(array('error' => true, 'message' => 'Something went wrong!'));
					exit();
				}
			} else {
				$response = array('error' => true, 'message' => implode('<br/>', $this->form_validation->error_array()));
				echo json_encode($response);
				exit();
			}
		}

		$this->load->view('submit_simple/header', $data);
		$this->load->view('submit_simple/submission-portal', $data);
		$this->load->view('submit_simple/footer', $data);
	}

	public function body_museum_bookings()
	{
		$data = [
			'page' => 'register',
			'page_title' => 'Register'
		];
		if ($this->input->post()) {
			$this->form_validation->set_rules('num_visit', 'Please Enter Number of Visitors', 'trim|required|xss_clean');
			if ($this->form_validation->run() === TRUE) {
				extract($this->input->post()); //_e($this->input->post());exit;
				$insertData['number_of_visitors'] = $num_visit;
				$visit_array = [];

				$config['upload_path'] = './uploads/emirates_files';
				$config['allowed_types'] = '*';
				$config['overwrite'] = TRUE;
				$config['encrypt_name'] = TRUE;
				$config['max_size'] = 20000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				$new_file_data = [];
				foreach ($_FILES as $key => $file) {
					if (!$this->upload->do_upload($key)) {
						$error = array('error' => $this->upload->display_errors());
						echo "not uploaded";
					} else {
						$data = array('upload_data' => $this->upload->data());
						$fileData = $this->upload->data();
						array_push($new_file_data, $fileData['file_name']);
					}
				}

				for ($i = 1; $i <= $num_visit; $i++) {
					$trim_array = [
						'name' => ${"name_$i"},
						'sur_name' => ${"sur_name_$i"},
						'mobile' => ${"real_phone_$i"},
						'email' => ${"email_$i"},
						'emirates_passport' => $new_file_data[$i - 1]
					];
					array_push($visit_array, $trim_array);
				}
				$last =  $this->dbconnect->findRecord(TBL_BOOK, 'last');
				($last) ? $last_num = $last->id + 1 : $last_num = 1;
				$insertData['booking_id'] = rand() . sprintf('%04d', $last_num);
				$insertData['visitor_details'] = json_encode($visit_array);
				$insertData['datetime'] = date('Y-m-d H:i:s');
				$insertData['date_visit'] = $date_visit;
				$insertData['time_visit'] = $time_visit;
				$insert_data = $this->dbconnect->insert(TBL_BOOK, $insertData);

				// Mail Start
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => 'bodymususer',
					'smtp_pass' => '#4e0ENmiIK0S',
					'mailtype'  => 'html',
					'charset'   => 'iso-8859-1'
				);
				$message_data = $this->load->view('body_museum/email_template', ['visit_array' => $visit_array, 'book_id' => $insertData['booking_id'], 'book_date' => $insertData['date_visit'], 'book_time' => $insertData['time_visit']], true);
				$result_message = htmlspecialchars_decode(htmlspecialchars($message_data));
				$message = $result_message;
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('no-reply@kuevents.com'); // change it to yours
				$this->email->to('codershinobi@gmail.com'); // body.museum@ku.ac.ae
				$this->email->subject('Body Museum Booking');
				$this->email->message($message);
				$this->email->set_mailtype("html");
				$this->email->send();


				if ($insert_data) {
					echo json_encode(array('error' => false, 'message' => '<div style="line-height: 2; text-align: center;">Thanks for booking. We will contact you shortly. <br>Your booking id is : <strong id="refid">' . $insertData['booking_id'] . '</strong></div>'));
					exit();
				} else {
					echo json_encode(array('error' => true, 'message' => 'Something went wrong!'));
					exit();
				}
			} else {
				$response = array('error' => true, 'message' => implode('<br/>', $this->form_validation->error_array()));
				echo json_encode($response);
				exit();
			}
		}
		$this->load->view('body_museum/elements/header', $data);
		$this->load->view('body_museum/elements/navbar', $data);
		$this->load->view('body_museum/register', $data);
		$this->load->view('body_museum/elements/footer', $data);
	}
}
