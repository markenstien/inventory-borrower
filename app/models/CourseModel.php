<?php

	class CourseModel extends Model {
		public $table = 'courses';

		public $_fillables = [
			'course',
			'course_abbr'
		];

		public function store($courseData) {
			$fillable_datas = parent::getFillablesOnly($courseData);
			return parent::store($fillable_datas);
		}

		public function update($courseData, $id) {
			$fillable_datas = parent::getFillablesOnly($courseData);
			return parent::update($fillable_datas, $id);
		}
	}