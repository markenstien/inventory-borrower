<?php 
	load(['UserForm'] , APPROOT.DS.'form');
	load(['UserService'] , SERVICES);

	use Form\UserForm;
	use Services\UserService;

	class UserController extends Controller
	{

		public function __construct()
		{
			parent::__construct();

			$this->model = model('UserModel');
			$this->borrow = model('BorrowerModel');

			$this->data['page_title'] = ' Users ';
			$this->data['user_form'] = new UserForm();
		}

		public function index()
		{
			$params = request()->inputs();

			if(!empty($params))
			{
				$this->data['users'] = $this->model->getAll([
					'where' => $params
				]);
			}else{
				$this->data['users'] = $this->model->getAll( );
			}
			
			return $this->view('user/index' , $this->data);
		}

		public function create()
		{
			$req = request()->inputs();
			$userType = $req['user_type'] ?? 'STUDENT';

			if(isSubmitted()) {
				$post = request()->posts();
				$user_id = $this->model->create($post , 'profile');
				if(!$user_id){
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set('User Record Created');
				return redirect( _route('user:show' , $user_id , ['user_id' => $user_id]) );
			}
			$this->data['user_form'] = new UserForm('userForm');

			if(isEqual($userType,'STUDENT')) {
				$this->data['user_form']->setValue('user_type', UserService::STUDENT);
				return $this->view('user/create_student', $this->data);
			} else {
				$this->data['user_form']->setValue('user_type', UserService::STAFF);
				return $this->view('user/create_staff' , $this->data);
			}
			
		}

		public function edit($id)
		{
			if(isSubmitted()) {
				$post = request()->posts();
				$res = $this->model->update($post , $post['id']);

				if($res) {
					Flash::set( $this->model->getMessageString());
					return redirect( _route('user:show' , $id) );
				}else
				{
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}
			}

			$user = $this->model->get($id);

			$this->data['id'] = $id;
			$this->data['user_form']->init([
				'url' => _route('user:edit',$id)
			]);

			$this->data['user_form']->setValueObject($user);
			$this->data['user_form']->addId($id);
			$this->data['user_form']->remove('submit');
			$this->data['user_form']->add([
				'name' => 'password',
				'type' => 'password',
				'class' => 'form-control',
				'options' => [
					'label' => 'Password'
				]
			]);

			if(!isEqual(whoIs('user_type'), 'admin'))
				$this->data['user_form']->remove('user_type');

			$this->data['user'] = $user;

			return $this->view('user/edit' , $this->data);
		}

		public function show($id)
		{
			$user = $this->model->get($id);

			if(!$user) {
				Flash::set(" This user no longer exists " , 'warning');
				return request()->return();
			}

			$borrows = $this->borrow->all([
				'beneficiary_id' => $id
			]);

			$this->data['user'] = $user;
			$this->data['is_admin'] = $this->is_admin;
			if($user->user_code) {
				$this->data['barcode'] = $this->_barCode->getBarcode($user->user_code, $this->_barCode::TYPE_CODE_128);
			}

			$number_of_days_after_deployment = null;
			$number_of_days_remaining = null;
			
			$this->data['number_of_days_remaining'] = $number_of_days_remaining;
			$this->data['number_of_days_after_deployment'] = $number_of_days_after_deployment;
			$this->data['borrows'] = $borrows;

			return $this->view('user/show' , $this->data);
		}

		public function sendCredential($id)
		{
			$this->model->sendCredential($id);
			Flash::set("Credentials has been set to the user");
			return request()->return();
		}
	}