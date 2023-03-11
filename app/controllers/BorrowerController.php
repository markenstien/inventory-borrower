<?php
    use Form\BorrowForm;
use Services\StockService;

    load(['BorrowForm'], APPROOT.DS.'form');
    
    class BorrowerController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->model = model('BorrowerModel');
            $this->itemModel = model('ItemModel');
            $this->userModel = model('UserModel');
            $this->stockModel = model('StockModel');
            $this->data['form'] = new BorrowForm();
            _requireAuth();
        }

        public function index() {
            if(isEqual(whoIs('user_type'), 'student')) {
                $this->data['borrows'] = $this->model->all([
                    'beneficiary_id' => whoIs('id')
                ], 'borrow.id desc');
            } else {
                $this->data['borrows'] = $this->model->all(null, 'borrow.id desc');
            }
            return $this->view('borrower/index', $this->data);
        }
        public function create() {
            $req = request()->inputs();
            $errors = [];

            if (isSubmitted()) {
                $post = request()->posts();
                //search for borrower

                if(empty($post['borrower_id'])) {
                    $borrow_id = $this->userModel->single([
                        'user_key_code' => [
                            'condition' => 'equal',
                            'value' => $post['borrower'],
                            'concatinator' => 'OR'
                        ],
        
                        'user_identification' => [
                            'condition' => 'equal',
                            'value' => $post['borrower'],
                            'concatinator' => 'OR'
                        ],
                        //barcode
                        'user_code' => [
                            'condition' => 'equal',
                            'value' => $post['borrower'],
                            'concatinator' => 'OR'
                        ],
                    ]);

                    if(!$borrow_id) {
                        $errors[] = 'Borrower not found';
                    }
                }

                if(empty($post['item_id'])) {
                    $item = $this->itemModel->single([
                        'barcode' => $post['item_barcode_search']
                    ]);

                    if(!$item) {
                        $errors[] = " Item not found";
                    }
                }

                if(!empty($errors)) {
                    Flash::set(implode(',', $errors) , 'danger');
                    return request()->return();
                }

                $borrowId = $this->model->createOrUpdate($post);
                if(!$borrowId) {
                    Flash::set($this->model->getErrorString(), 'danger');
                    return request()->return();
                } else {
                    $response = $this->stockModel->createOrUpdate([
                        'entry_type' => StockService::ENTRY_DEDUCT,
                        'entry_origin' => StockService::BORROW,
                        'item_id' => $post['item_id'],
                        'quantity' => 1,
                        'date' => today(),
                        'remarks' => $post['borrow_remark']
                    ]);
                    Flash::set("Borrower Saved!");
                    return redirect(_route('borrow:show', $borrowId));
                }
            }

            $this->data['users'] = $this->userModel->getAll();
            $this->data['items'] = $this->itemModel->all([
                'stock.total_stock' => [
                    'condition' => '>',
                    'value' => 0
                ]
            ]);
            return $this->view('borrower/create', $this->data);    
        }

        public function show($id) {
            $borrow = $this->model->get($id);
            $this->data['borrow'] = $borrow;
            return $this->view('borrower/show', $this->data);
        }

        public function edit($id) {
            $borrow = $this->model->get($id);

            if(isSubmitted()) {
                $post = request()->posts();
                $this->model->createOrUpdate($post, $id);

                if(isset($post['return_date'])) {
                    $borrow = $this->model->get($id);

                    $response = $this->stockModel->createOrUpdate([
                        'entry_type' => StockService::ENTRY_ADD,
                        'entry_origin' => StockService::BORROW,
                        'item_id' => $borrow->item_id,
                        'quantity' => 1,
                        'date' => today(),
                        'remarks' => "Returned Borrowed Equipment"
                    ]);
                }
                Flash::set("Borrowe Item Edited");
                return redirect(_route('borrow:show', $id));
            }
            
            $this->data['form']->setValueObject($borrow);
            $this->data['form']->init([
                'action' => _route('borrow:edit', $id)
            ]);
            $this->data['borrow'] = $borrow;
            $this->data['id'] = $id;

            return $this->view('borrower/edit', $this->data);
        }

        public function returnItem($id) {
            $borrow = $this->model->get($id);
            $this->data['form']->setValueObject($borrow);
            $this->data['form']->init([
                'action' => _route('borrow:edit', $id)
            ]);

            $this->data['borrow'] = $borrow;
            $this->data['id'] = $id;
            return $this->view('borrower/return_page', $this->data);
        }
    }