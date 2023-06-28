<?php 
	namespace Services;

	class BorrowService {

		private $borrowItems;

		public function __construct() {
			$this->itemModel = model('ItemModel');
			$this->courseModel = model('CourseModel');
			$this->categoryModel = model('CategoryModel');
		}

		public function setBorrowItems($borrowItems = []) {
			$this->borrowItems = $borrowItems;
		}

		public function summarizeItems() {

			$retVal = [
				'topBorrowedItem' => null,
				'leastBorrowedItem' => null,
				'topTenBorrowedItems' => [],
				'topCourseBorrower' => null,
				'topYearLevelBorrower' => null,
				'topTenMostBorrowedItemCategories' => []
			];


			if(!empty($this->borrowItems)) {

				$tmpSummarizedData = [
					'items' => [],
					'courses' => [],
					'yearLevel' => [],
					'categories' => []
				];

				foreach($this->borrowItems as $key => $borrowItem) {
					//item borrowed
					if(!isset($tmpSummarizedData['items'][$borrowItem->item_id])) {
						$tmpSummarizedData['items'][$borrowItem->item_id] = 1;
					} else {
						$tmpSummarizedData['items'][$borrowItem->item_id]++;
					}

					//courses borrowed
					if(!isset($tmpSummarizedData['courses'][$borrowItem->course_id])) {
						$tmpSummarizedData['courses'][$borrowItem->course_id] = 1;
					} else {
						$tmpSummarizedData['courses'][$borrowItem->course_id]++;
					}

					//courses borrowed
					if(!isset($tmpSummarizedData['yearLevel'][$borrowItem->year_lvl])) {
						$tmpSummarizedData['yearLevel'][$borrowItem->year_lvl] = 1;
					} else {
						$tmpSummarizedData['yearLevel'][$borrowItem->year_lvl]++;
					}

					//categories borrowed
					if(!isset($tmpSummarizedData['categories'][$borrowItem->category_id])) {
						$tmpSummarizedData['categories'][$borrowItem->category_id] = 1;
					} else {
						$tmpSummarizedData['categories'][$borrowItem->category_id]++;
					}
				}

				arsort($tmpSummarizedData['items']);
				arsort($tmpSummarizedData['courses']);
				arsort($tmpSummarizedData['yearLevel']);
				arsort($tmpSummarizedData['categories']);


				/*
				*convert result to data
				*/

				if(!empty($tmpSummarizedData['items'])) {
					$itemkeys = array_keys($tmpSummarizedData['items']);
					$retVal['topBorrowedItem'] = [
						'total' => current($tmpSummarizedData['items']),
						'item' => $this->itemModel->get(current($itemkeys))
					];

					$retVal['leastBorrowedItem'] = [
						'total' => end($tmpSummarizedData['items']),
						'item' => $this->itemModel->get(end($itemkeys))
					];

					$topItemBorrowedItems = $this->topTenOnly($tmpSummarizedData['items']);
					$topTenItemKeys = array_keys($topItemBorrowedItems);


					foreach($topTenItemKeys as $key => $item) {
						$retVal['topTenBorrowedItems'][] = [
							'total' => $topItemBorrowedItems[$item],
							'item' => $this->itemModel->get($item)
						];
					}
				}

				if(!empty($tmpSummarizedData['courses'])) {
					$courseKeys = array_keys($tmpSummarizedData['courses']);
					$retVal['topCourseBorrower'] = [
						'total' => current($tmpSummarizedData['courses']),
						'course' => $this->courseModel->get(current($courseKeys))
					];
				}

				if(!empty($tmpSummarizedData['yearLevel'])) {
					$retVal['topYearLevelBorrower'] = [
						'total' => current($tmpSummarizedData['yearLevel']),
						'year' => array_keys($tmpSummarizedData['yearLevel'])[0]
					];
				}

				if(!empty($tmpSummarizedData['categories'])) {
					$topTenBorrowedCategories = $this->topTenOnly($tmpSummarizedData['categories']);
					$topTenCategoryKeys = array_keys($topTenBorrowedCategories);

					foreach($topTenItemKeys as $key => $cat) {
						$retVal['topTenMostBorrowedItemCategories'][] = [
							'total' => $topTenBorrowedCategories[$cat],
							'category' => $this->categoryModel->get($cat)
						];
					}
				}
			}

			return $retVal;
		}

		private function topTenOnly($dataArray = []) {
			$counter = 0;
			$retVal = [];

			if(!empty($dataArray)) {
				foreach($dataArray as $key => $row) {
					if($counter <= 10) {
						$retVal[$key] = $row;
					} else {
						break;
					}
					$counter++;
				}
			}

			return $retVal;
		}
	}


	/*
				*1. most borrowed item
				*2. least borrowed item
				*3. top 10 borrowed item
				*
				*4. top course borrower
				*5. top year level borrower
				*6. top 10 most borrowed categories
				*/