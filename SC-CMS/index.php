<?php

session_start();
include_once 'classes/modelClass.php';
include_once 'classes/viewClass.php';
include_once 'classes/sCartClass.php';
	
class PageSelector
{
/*
**	This class gets the pageID from the URL and instantiates th corresponding view class that generates the html tags necessary to display the page
*/
	public function run()
	{
		if ($_GET['pageID']) {
			$pageID = $_GET['pageID'];			//  get pageID from URL if available
		}
		else {
			$pageID = 'home';					//  set default pageID to home
		}
		if ($_GET['result']) {
			$pageID = 'checkout';
		}
		$model = new Model;						//   instantiate model class which automatically connect to the DB
//		$db = $model->connectToDB();
		
//		if ($_GET['pageID'] != 'logout') {
		if (!in_array($_GET['pageID'], array('logout','rss'))) {
			if ($_GET['pageID'] == 'editView') {
				$page = $_GET['page'];
				
			}
			else {
				$page = $pageID;
			}
			$rs = $model->getPage($page);
		}
		
		switch($pageID) {
			case 'home': include('classes/homeViewClass.php');
				$view = new HomeView($rs);
				break;
			case 'gallery': include('classes/galleryViewClass.php');
				$view = new GalleryView($rs, $model, $_GET['p']);
				break;
			case 'productView': include('classes/productViewClass.php');
				$view = new ProductView($rs, $model, $_GET['PID']);
				break;	
			case 'viewCart': include('classes/cartViewClass.php');
				$view = new CartView($rs, $model);
				break;
			case 'checkout': include('classes/checkoutViewClass.php');
				$view = new CheckoutView($rs, $model);
				break;
			case 'logout':		
			case 'login': include('classes/adminViewClass.php');
				$view = new AdminView($rs, $model);
				break;	
			case 'editView' : include('classes/editViewClass.php');
				$view = new EditView($rs, $model, $_GET['page']);
				break;	
			case 'addProduct' : include('classes/addProductViewClass.php');
				$view = new AddProductView($rs, $model);
				break;	
			case 'editProduct' : include('classes/editProductViewClass.php');
				$view = new EditProductView($rs, $model, $_GET['pid']);
				break;	
			case 'deleteProduct' : include('classes/deleteProductViewClass.php');
				$view = new DeleteProductView($rs, $model, $_GET['pid']);
				break;	
			case 'contact' : include('classes/contactViewClass.php');
				$view = new ContactView($rs, $model);
				break;
			case 'rss': include('classes/rssViewClass.php');
				$view = new RSSView($model);
				break;	
			case 'imageGallery': include('classes/imageViewClass.php');
				$view = new ImageView($rs, $model, $_GET['start']);
				break;		
		}
		echo $view->displayPage();
	}
}

$page = new PageSelector;
$page->run();

?>