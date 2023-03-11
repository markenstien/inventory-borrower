<?php 
	require LIBS.'/barcode_lib/'.'vendor/autoload.php'; 

	class TestController extends Controller
	{
		public function index()
		{
			$redColor = [255, 0, 0];
			$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
			echo $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
		}
	}