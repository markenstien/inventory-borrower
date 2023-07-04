<?php 
    namespace Form;
    use Core\Form;
    
    load(['Form'],CORE);

    class BorrowForm extends Form
    {

        public function __construct()
        {
            parent::__construct('form_name');
            $this->userModel = model('UserModel');
            $this->itemModel = model('ItemModel');

            $this->init([
                'method' => 'post',
                'action' => _route('borrow:create')
            ]);
            $this->addBorrower();
            $this->adddItemBarCodeSearch();
            $this->addItem();
            $this->addBorrowDate();
            $this->addBorrowTime();
            $this->addBorrowState();
            $this->addBorrowRemark();
            $this->addReturnDate();
            $this->addReturnTime();
            $this->addReturnState();
            $this->addReturnRemark();
            $this->addReturnToDate();
            $this->addStatus();
        }

        public function addBorrower() {
            $this->add([
                'name' => 'borrower',
                'type' => 'text',
                'required' => true,
                'class' => 'form-control',
                'options' => [
                    'label' => 'Borrower'
                ],
                'attributes' => [
                    'placeholder' => 'Focus this field scan user barcode',
                    'autofocus' => true,
                    'id' => 'borrower'
                ]
            ]);
        }

        public function adddItemBarCodeSearch() {
            $this->add([
                'name' => 'item_barcode_search',
                'type' => 'text',
                'required' => true,
                'class' => 'form-control',
                'options' => [
                    'label' => 'Item Barcode Search'
                ],
                'attributes' => [
                    'placeholder' => 'Focus this field scan user barcode',
                    'id' => 'itemBarSearch'
                ]
            ]);
        }
        public function addItem() {
            $items = $this->itemModel->all();    
            $items = arr_layout_keypair($items,['id', 'category_name@name']);

            $this->add([
                'name' => 'item_id',
                'type' => 'select',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Items',
                    'option_values' => $items
                ],
                'requried' => true
            ]);
        }
        public function addBorrowDate() {
            $this->add([
                'name' => 'borrow_date',
                'type' => 'date',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Borrow Date'
                ],
                'required' => true
            ]);
        }

        public function addReturnToDate() {
            $this->add([
                'name' => 'return_on_date',
                'type' => 'date',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Return To Date'
                ],
                'required' => true
            ]);
        }
        
        public function addBorrowTime() {
            $this->add([
                'name' => 'borrow_time',
                'type' => 'time',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Borrow Time'
                ]
            ]);
        }
        public function addBorrowState() {
            $this->add([
                'name' => 'borrow_state',
                'type' => 'select',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Item State',
                    'option_values' => [
                        'Good Condition',
                        'With Issues',
                        'Broken'
                    ]
                ]
            ]);
        }
        public function addBorrowRemark() {
            $this->add([
                'name' => 'borrow_remark',
                'type' => 'textarea',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Item Borrow Remark'
                ],
                'attributes' => [
                    'rows' => 3
                ]
            ]);
        }
        ## RETURN 
        public function addReturnDate() {
            $this->add([
                'name' => 'return_date',
                'type' => 'date',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Return Date'
                ]
            ]);
        }
        public function addReturnTime() {
            $this->add([
                'name' => 'return_time',
                'type' => 'time',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Return Time'
                ]
            ]);
        }
        public function addReturnState() {
            $this->add([
                'name' => 'return_state',
                'type' => 'select',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Return State',
                    'option_values' => [
                        'Good Condition',
                        'With Issues',
                        'Broken'
                    ]
                ]
            ]);
        }
        public function addReturnRemark() {
            $this->add([
                'name' => 'return_remark',
                'type' => 'textarea',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Item State'
                ],
                'attributes' => [
                    'rows' => 3
                ]
            ]);
        }


        public function addStatus() {
            $this->add([
                'name' => 'status',
                'type' => 'select',
                'class' => 'form-control',
                'options' => [
                    'label' => 'Borrowing Status',
                    'option_values' => [
                        'pending','on-going','returned','cancelled','completed'
                    ]
                ],
                'required' => true,
            ]);
        }
    }