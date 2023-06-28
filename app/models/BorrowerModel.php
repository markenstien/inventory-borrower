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
            
            $_fillables['beneficiary_id'] = $data['borrower_id'];
            $item_id['beneficiary_id'] = $data['item_id'];
            $_fillables['staff_id'] = whoIs('id');

            if (is_null($id)) {
                $_fillables['reference'] = referenceSeries(parent::lastId() + 1, 3, date('Ym').'-');
                $retval= parent::store($_fillables);
            } else {
                $retval = parent::update($_fillables, $id);
            }
            return $retval;
        }

        public function all($where = null , $order = null , $limit = null) {

            if(!is_null($where)) {
                $where = " WHERE ". parent::conditionConvert($where);
            } 

            if(!is_null($order)) {
                $order = " ORDER BY {$order}";
            }

            if(!is_null($limit)) {
                $limit = " LIMIT {$limit}";
            }

            $this->db->query(
                "SELECT borrow.*, item.name as item_name,
                    item.category_id as category_id,
                    concat(user.firstname, ' ',user.lastname) as borrower_name,
                    user.user_identification as user_identification,
                    course, course_abbr, course_id, year_lvl
                    
                FROM {$this->table} as borrow
                    LEFT JOIN items as item 
                        ON item.id = borrow.item_id
                    LEFT JOIN users as user 
                        ON user.id = borrow.beneficiary_id
                    LEFT JOIN courses as course 
                        ON course.id = user.course_id
                {$where} {$order} {$limit}"
            );

            return $this->db->resultSet();
        }

        public function get($id) {
            return $this->all([
                'borrow.id' => $id
            ])[0] ?? false;
        }
    }