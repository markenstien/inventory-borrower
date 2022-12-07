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
            $this->stockModel = model('StockModel');
            $this->data['form'] = new BorrowForm();
        }

        public function index() {
            $this->data['borrows'] = $this->model->all();
            return $this->view('borrower/index', $this->data);
        }

        public function create() {
            $req = request()->inputs();

            if (isSubmitted()) {
                $borrowId = $this->model->createOrUpdate($req);
                if(!$borrowId) {
                    Flash::set($this->model->getErrorString(), 'danger');
                    return request()->return();
                } else {
                    $this->stockModel->createOrUpdate([
                        'entry_type' => StockService::ENTRY_DEDUCT,
                        'entry_origin' => StockService::BORROW,
                        'item_id' => $req['item_id'],
                        'quantity' => 1,
                        'date' => today(),
                        'remarks' => $req['borrow_remarks']
                    ]);
                    Flash::set("Borrower Saved!");
                }
            }
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
                $req = request()->inputs();
                $this->model->createOrUpdate($req, $id);
                Flash::set("Boroowed Item Edited");
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
    }