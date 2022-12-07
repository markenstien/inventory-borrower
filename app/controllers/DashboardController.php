<?php
	use Services\OrderService;
	load(['OrderService'],SERVICES);
	class DashboardController extends Controller
	{
		public function __construct()
		{
			$this->user_model = model('UserModel');
			$this->itemModel = model('ItemModel');
			$this->orderItemModel = model('OrderItemModel');
		}

		public function index()
		{
			$this->data['page_title'] = 'Dashboard';
			return $this->view('tmp/maintenance', $this->data);
		}
	}