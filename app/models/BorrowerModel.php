<?php 

    class BorrowerModel extends Model
    {
        public $table = 'borrowers';
        public $_fillables = [
            'beneficiary_id',
            'staff_id',
            'beneficiary_id',
            'item_id',
            'borrow_date',
            'borrow_time',
            'borrow_state',
            'borrow_remark',
            'return_date',
            'return_on_date',
            'return_time',
            'return_state',
            'return_remark',
            'status'
        ];

        public function createOrUpdate($data, $id = null) {
            $_fillables = parent::getFillablesOnly($data);
            $retval = false;

            $borrower = $this->searchBorrower($data['borrower']);

            if(!$borrower) {
                $this->addError("Borrower not found!");
                return false;
            }
            
            $_fillables['beneficiary_id'] = $borrower->id;
            $_fillables['staff_id'] = whoIs('id');

            if (is_null($id)) {
                $_fillables['reference'] = referenceSeries(parent::lastId() + 1, 3, date('Ym').'-');
                $retval= parent::store($_fillables);
            } else {
                $retval = parent::update($_fillables, $id);
            }
            return $retval;
        }

        private function searchBorrower($borrower) {
            $this->userModel = model('UserModel');

            return $this->userModel->single([
                'user_key_code' => [
                    'condition' => 'equal',
                    'value' => $borrower,
                    'concatinator' => 'OR'
                ],

                'user_identification' => [
                    'condition' => 'equal',
                    'value' => $borrower,
                    'concatinator' => 'OR'
                ],
            ]);
        }

        public function all($where = null , $order_by = null , $limit = null) {

            if(!is_null($where)) {
                $where = " WHERE ". parent::conditionConvert($where);
            } 

            if(!is_null($order_by)) {
                $order = " ORDER BY {$order_by}";
            }

            if(!is_null($limit)) {
                $limit = " LIMIT {$limit}";
            }

            $this->db->query(
                "SELECT borrow.*, item.name as item_name,
                    concat(user.firstname, ' ',user.lastname) as borrower_name,
                    user.user_identification as user_identification
                    
                FROM {$this->table} as borrow
                LEFT JOIN items as item 
                ON item.id = borrow.item_id
                LEFT JOIN users as user 
                ON user.id = borrow.beneficiary_id
                {$where} {$order_by} {$limit}"
            );

            return $this->db->resultSet();
        }

        public function get($id) {
            return $this->all([
                'borrow.id' => $id
            ])[0] ?? false;
        }
    }