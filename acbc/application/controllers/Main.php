<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$data['page'] = 'index';
		if ($this->input->post()) {
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('affiliation', 'Affiliation', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('confirm_email', 'Confirm email', 'required|valid_email');
			$this->form_validation->set_rules('presentation', 'Type of Presentation', 'required');
			$this->form_validation->set_rules('conference[]', 'Conference Topic', 'required');
			$this->form_validation->set_rules('abstract_title', 'Conference Topic', 'required');
			if ($this->form_validation->run() === TRUE) {
				extract($this->input->post());
				$formData = $this->input->post();

				// REPORT UPLOAD
				$config['upload_path']          = './uploads/abstract';
                $config['allowed_types']        = 'doc|pdf|docx';
                $config['encrypt_name'] = TRUE;
				$config['max_size'] = 2000;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('abstract')) {
					$error = array('error' => $this->upload->display_errors());
					echo json_encode(array('error' => true, 'message' => '<p>' . $error['error'] . '</p>'));
					exit;
                } else {
					$data = array('abstract' => $this->upload->data());
					$formData['abstract'] = pathinfo($data['abstract']['full_path'])['basename'];
				}

				$formData['conference'] = serialize($formData['conference']);
				$formData['datetime'] = date('Y-m-d H:i:s');
				unset($formData['confirm_email']);
                $insert_data = $this->dbconnect->insert(TBL_REGISTER, $formData);
				if ($insert_data) {
					echo json_encode(array('error' => false, 'message' => '<div style="line-height: 2; text-align: center;">Registration successfull</div>'));
					exit();
				} else {
					echo json_encode(array('error' => true, 'message' => 'Unable to process the request. Please try again or contact administrator.'));
					exit();
				}
			} else {
				$response = array('error' => true, 'message' => implode('<br/>', $this->form_validation->error_array()));
				echo json_encode($response);
				exit();
			}
		}
		$this->load->view('index');
	}

	public function export_data() {
		if ($this->input->post()) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() === TRUE) {
				extract($this->input->post());
				if ($password == 's&VrB=vjH3qmS') {
					$all_data = $this->dbconnect->getAll(TBL_REGISTER, 'id ASC');
					$this->__excel_data(['data' => $all_data]);
				} else {
					echo json_encode(array('error' => true, 'message' => 'You have entered wrong password!'));
					exit();
				}
			} else {
				echo json_encode(array('error' => true, 'message' => '<p>' . implode('<br/>', $this->form_validation->error_array()) . '</p>'));
				exit;
			}
		}
		$this->load->view('header');
		$this->load->view('export-data');
		$this->load->view('footer');
	}

	public function __excel_data($params)
	{
		extract($params);
		$this->excel->setActiveSheetIndex(0);

		$this->excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
		$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToPage(true);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$this->excel->getActiveSheet()->getPageSetup()->setFitToHeight(0);


		$excel = new stdClass();
		$excel->format = (extension_loaded('zip') && class_exists('ZipArchive')) ? 'Excel2007' : 'Excel5';
		switch ($excel->format) {
			case 'Excel5':
				$excel->extention = '.xls';
				$excel->content_type = 'application/vnd.ms-excel;charset=utf-8;';
				break;
			case 'Excel2007':
				$excel->extention = '.xlsx';
				$excel->content_type = 'application/openxmlformats-officedocument.spreadsheetml.sheet;charset=utf-8;';
				break;
		}

		$start_cell = 1;
		$col = 0;
		$LeftColumns = [];
		$RightColumns = [];
		$CenterColumns = [];

		$this->excel->getActiveSheet()->setCellValue("A{$start_cell}", 'First Name');
		$this->excel->getActiveSheet()->setCellValue("B{$start_cell}", 'Last Name');
		$this->excel->getActiveSheet()->setCellValue("C{$start_cell}", 'Country');
		$this->excel->getActiveSheet()->setCellValue("D{$start_cell}", 'Affiliation');
		$this->excel->getActiveSheet()->setCellValue("E{$start_cell}", 'Email');
		$this->excel->getActiveSheet()->setCellValue("F{$start_cell}", 'Type of Presentation');
		$this->excel->getActiveSheet()->setCellValue("G{$start_cell}", 'Conference Topic');
		$this->excel->getActiveSheet()->setCellValue("H{$start_cell}", 'Abstract Title');
		$this->excel->getActiveSheet()->setCellValue("I{$start_cell}", 'Abstract');
		$this->excel->getActiveSheet()->setCellValue("J{$start_cell}", 'Date Time');

		$last_cell_num = 10;
		$last_cell_name = $this->excel->getNameFromNumber($last_cell_num);
		$exceldata = [];
		$num = 1;
		foreach ($data as $row) {
			$conference = implode(", ",unserialize($row->conference));
			$exceldata_row = [];
			$exceldata_row[] = $row->firstname;
			$exceldata_row[] = $row->lastname;
			$exceldata_row[] = $row->country;
			$exceldata_row[] = $row->affiliation;
			$exceldata_row[] = $row->email;
			$exceldata_row[] = $row->presentation;
			$exceldata_row[] = $conference;
			$exceldata_row[] = $row->abstract_title;
			$exceldata_row[] = base_url().'uploads/abstract/'.$row->abstract;
			$exceldata_row[] = $row->datetime;

			$exceldata[] = $exceldata_row;
			$num++;
		}
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
							$this->excel->getActiveSheet()->setCellValueExplicit("{$columnList[$num]}{$rowid}", $row[$num], PHPExcel_Cell_DataType::TYPE_STRING);
					}
				}
				$rowid++;
			}
		}

		ob_start();
		$filename = 'acbc-register-' . date('d-m-Y') . $excel->extention;
		header('Content-Type: ' . $excel->content_type);
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, $excel->format);
		$objWriter->save('php://output');
		$xlsData = ob_get_contents();
		ob_end_clean();
		$response =  array(
			'file_name' => $filename,
			'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData)
		);
		die(json_encode($response));
	}
}
