<?php

require '../db.php';
require '../vendor/autoload.php';
$app = new \Slim\Slim();
$table = 'ezcosplay';

$app->config('debug', true);

$app->view(new \JsonApiView() );
$app->add(new \JsonApiMiddleware());

$app->get('/', function() use ($app){
	$app->render(200, array(
		'msg' => 'hi'
	));
});

$app->response->header('Access-Control-Allow-Origin', '*');
$app->get('/categories', 'getCats');
$app->get('/categories/:query', 'getProducts');
$app->get('/product/:id', 'getProduct');
$app->run();


function getCats() {
	global $app, $table;
	$sql="select distinct merchantcategory from $table order by merchantcategory";
	try {
		$db=getDB();
		$stmt = $db->query($sql);
		$cats = $stmt->fetchAll( PDO::FETCH_OBJ);
		$out=array();
		foreach($cats as $cat)$out[]=array("name"=>$cat->merchantcategory);
		$db = null;
		$app->render(200, array('time'=>time(), 'categories'=>$out));
	}
	catch(PDOEXCEPTION $e){
		$app->render(500, array("msg"=>$e->getMessage() ));
	}
}

function getProducts($query){
	global $app, $table;
	$db=getDB();
	if( empty($query)){
		getCats();
	}

	$sql = "select productid, name, thumbnail, price, shortdescription from $table where merchantcategory=:query order by name limit 100";


	try {
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":query", $query);
		$stmt->execute();
		$prods = $stmt->fetchAll( PDO::FETCH_OBJ);
		$app->render(200, array('time'=>time(), 'items'=>$prods));
	}
	catch(PDOEXCEPTION $e){
		$app->render(500, array("msg"=>$e->getMessage() ));
	}
	$db = null;
};
function getProduct($id){
	global $app, $table;
	$db=getDB();

	$sql = "select * from $table where productid=:id";
	try {
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":id", $id);
		$stmt->execute();
		$prod = $stmt->fetch( PDO::FETCH_OBJ);
		$app->render(200, array('time'=>time(), 'item'=>$prod));
	}
	catch(PDOEXCEPTION $e){
		$app->render(500, array("msg"=>$e->getMessage() ));
	}
	$db = null;
};
