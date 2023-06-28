<?php 
	use Form\CourseForm;
	load(['CourseForm'], FORM);

	class CourseController extends Controller
	{
		private $formCourse;

		public function __construct() {
			parent::__construct();
			$this->formCourse = new CourseForm();

			$this->data['formCourse'] = $this->formCourse;
			$this->model = model('CourseModel');
		}

		public function index() {
			$courses = $this->model->all();

			$this->data['courses'] = $courses;
			$this->view('course/index', $this->data);
		}

		public function create() {
			if(isSubmitted()) {
				$post = request()->posts();

				$res = $this->model->store($post);

				if($res) {
					Flash::set($this->model->getMessageString());
					return redirect(_route('course:index'));
				} else {
					Flash::set($this->model->getErrorMessage(),'danger');
					return request()->return();
				}
			}
			$this->view('course/create', $this->data);
		}

		public function edit($id) {
			if(isSubmitted()) {
				$post = request()->posts();
				$res = $this->model->update($post,$post['id']);

				if($res) {
					Flash::set($this->model->getMessageString());
					return redirect(_route('course:index'));
				} else {
					Flash::set($this->model->getErrorString(), 'danger');
					return request()->return();
				}
			}
			$course = $this->model->get($id);
			$this->data['course'] = $course;
			$this->data['formCourse']->setValueObject($course);

			return $this->view('course/edit', $this->data);
		}
	}