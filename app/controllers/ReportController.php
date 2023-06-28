<?php

	use Classes\Report\SalesReport;
	use Services\StockService;
	use Services\BorrowService;


	load(['SalesReport'],CLASSES.DS.'Report');
	load(['StockService','BorrowService'],SERVICES);

	class ReportController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->userModel = model('UserModel');
			$this->borrowModel = model('BorrowerModel');

			$this->serviceBorrow = new BorrowService();
		}


		public function index()
		{	
			$req = request()->inputs();

			if(!empty($req['btn_report'])) {

				//get the following.

				/*
				*1. most borrowed item
				*2. least borrowed item
				*3. top 10 borrowed item
				*
				*4. top course borrower
				*5. top year level borrower
				*6. top 10 most borrowed categories
				*/

				$borrowedItems = $this->borrowModel->all([
					'borrow_date' => [
						'condition' => 'between',
						'value' => [
							$req['start_date'], $req['end_date']
						]
					]
				]);

				$this->serviceBorrow->setBorrowItems($borrowedItems);
				$summarizedData = $this->serviceBorrow->summarizeItems();

				$this->data['summarizedData'] = $summarizedData;
				
				return $this->view('report/print_ready', $this->data);
			}

			return $this->view('report/index', $this->data);
		}
	}