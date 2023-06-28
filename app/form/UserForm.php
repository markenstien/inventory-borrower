<?php

	namespace Form;

	load(['Form'], CORE);
	load(['UserService'],SERVICES);
	use Core\Form;
	use Services\UserService;

	class UserForm extends Form
	{

		private $courseModel = null;

		public function __construct( $name = null)
		{
			parent::__construct();

			if(is_null($this->courseModel)) {
				$this->courseModel = model('CourseModel');
			}
			$this->name = $name ?? 'form_user';

			$this->initCreate();
			$this->addUserCode();
			/*personal details*/
			$this->addFirstName();
			$this->addLastName();
			$this->addUserType();
			$this->addUsername();
			$this->addPassword();
			
			$this->addGender();
			$this->addCourse();
			$this->addYearLevel();

			/*end*/
			$this->addPhoneNumber();
			$this->addEmail();
			$this->addAddress();

			
			$this->addProfile();
			
			$this->addSubmit('');
		}

		public function initCreate()
		{
			$this->init([
				'url' => _route('user:create'),
				'enctype' => true
			]);
		}

		public function addUserCode() {
			$this->add([
				'type' => 'text',
				'name' => 'user_code',
				'class' => 'form-control',
				'options' => [
					'label' => 'Barcode'
				],
				'attributes' => [
					'id' => 'user_code',
					'placeholder' => 'focus this field and scan your barcode',
					'autofocus' => true
				]
			]);
		}

		public function addFirstName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'firstname',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'First Name'
				],

				'attributes' => [
					'id' => 'firstname',
					'placeholder' => 'Enter First Name'
				]
			]);
		}


		public function addLastName()
		{
			$this->add([
				'type' => 'text',
				'name' => 'lastname',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Last Name'
				],

				'attributes' => [
					'id' => 'lastname',
					'placeholder' => 'Enter Last Name'
				]
			]);
		}

		public function addUsername()
		{
			$this->add([
				'type' => 'text',
				'name' => 'username',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Username',
				],

				'attributes' => [
					'id' => 'username',
					'placeholder' => 'Enter Username'
				]
			]);
		}

		public function addPassword()
		{
			$this->add([
				'type' => 'password',
				'name' => 'password',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Password',
				],

				'attributes' => [
					'id' => 'password'
				]
			]);
		}

		public function addGender()
		{
			$this->add([
				'type' => 'select',
				'name' => 'gender',
				'class' => 'form-control',
				'options' => [
					'label' => 'Gender',
					'option_values' => [
						'Male' , 'Female'
					]
				],

				'attributes' => [
					'id' => 'gender',
				]
			]);
		}

		public function addAddress()
		{
			$this->add([
				'type' => 'textarea',
				'name' => 'address',
				'class' => 'form-control',
				'options' => [
					'label' => 'Address',
				],

				'attributes' => [
					'id' => 'address',
					'rows' => 3
				]
			]);
		}

		public function addPhoneNumber()
		{
			$this->add([
				'type' => 'text',
				'name' => 'phone',
				'class' => 'form-control',
				'options' => [
					'label' => 'Phone Number',
				],

				'attributes' => [
					'id' => 'phone',
					'placeholder' => 'Eg. 09xxxxxxxxx'
				]
			]);
		}

		public function addEmail()
		{
			$this->add([
				'type' => 'email',
				'name' => 'email',
				'class' => 'form-control',
				'options' => [
					'label' => 'Email',
				],

				'attributes' => [
					'id' => 'email',
					'placeholder' => 'Enter Valid Email'
				]
			]);
		}

		public function addUserType()
		{
			$this->add([
				'type' => 'hidden',
				'name' => 'user_type',
				'class' => 'form-control',
				'required' => true
			]);
		}

		public function addProfile()
		{
			$this->add([
				'type' => 'file',
				'name' => 'profile',
				'class' => 'form-control',
				'options' => [
					'label' => 'Profile Picture',
				],

				'attributes' => [
					'id' => 'profile'
				]
			]);
		}

		public function addCourse() {
			$courses = $this->courseModel->all(null, 'course_abbr asc');
			$coursesArray = arr_layout_keypair($courses, ['id', 'course_abbr@course']);

			$this->add([
				'type' => 'select',
				'name' => 'course_id',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Course',
					'option_values' => $coursesArray
				]
			]);
		}

		public function addYearLevel() {
			$this->add([
				'type' => 'select',
				'name' => 'year_lvl',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Year Level',
					'option_values' => [
						'1st',
						'2nd',
						'3rd',
						'4th',
					]
				]
			]);
		}

		public function addSubmit()
		{
			$this->add([
				'type' => 'submit',
				'name' => 'submit',
				'class' => 'btn btn-primary',
				'attributes' => [
					'id' => 'id_submit'
				],

				'value' => 'Save user'
			]);
		}
	}