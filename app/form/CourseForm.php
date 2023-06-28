<?php 
	namespace Form;

	use Core\Form;
	load(['Form'],CORE);

	class CourseForm extends Form {

		public function __construct() {
			parent::__construct();

			$this->addCourse();
			$this->addCourseAbbr();
		}
		
		public function addCourse() {
			$this->add([
				'type' => 'text',
				'name' => 'course',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Course'
				]
			]);
		}

		public function addCourseAbbr() {
			$this->add([
				'type' => 'text',
				'name' => 'course_abbr',
				'class' => 'form-control',
				'required' => true,
				'options' => [
					'label' => 'Course Abbr'
				]
			]);
		}
	}