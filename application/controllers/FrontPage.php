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
		$data['page'] = 'home';
		$this->load->view('header', $data);
		$this->load->view('index', $data);
		$this->load->view('footer', $data);
	}

	public function submission()
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

		$this->load->view('header', $data);
		$this->load->view('submission-portal', $data);
		$this->load->view('footer', $data);
	}

	public function cfp()
	{
		$data['page'] = 'cfp';
		$this->load->view('header', $data);
		$this->load->view('cfp', $data);
		$this->load->view('footer', $data);
	}

	public function call_documents() {
		$data['page'] = 'call_documents';
		$this->load->view('header', $data);
		$this->load->view('cfp', $data);
		$this->load->view('footer', $data);
	}
}
