<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\Cart;
use app\models\Order;

use Yii;

class CartController extends Controller {

	public function actionIndex() {
		$session = Yii::$app->session;
		$session->open();
		return $this->render('index', compact('session'));
	}

	public function actionAdd() {
		if (Yii::$app->request->isAjax){
			$id = Yii::$app->request->get('id');
			$qty = (int)Yii::$app->request->get('qty');
			$qty = !$qty ? 1 : $qty;
			$product = Product::findOne($id);
			$session = Yii::$app->session;
			$session->open();
			$cart = new Cart();
			if(!empty($product)) {
				$cart->addToCart($product, $qty);
			}
			$this->layout = false;
			$qty = empty($session['cart.qty']) ? 0 : $session['cart.qty'];
			return json_encode(array(
				cart_count=> $qty,
				cart_html=> $this->render('index', compact('session'))
			));
		}
		else{
			return $this->redirect(['site/error']);
		}
	}

	public function actionClear() {
		if (Yii::$app->request->isAjax){
			$session = Yii::$app->session;
			$session->open();
			$session->remove('cart');
			$session->remove('cart.qty');
			$session->remove('cart.sum');
			$this->layout = false;
			$qty = empty($session['cart.qty']) ? 0 : $session['cart.qty'];
			return json_encode(array(
				cart_count=> $qty,
				cart_html=> $this->render('index', compact('session'))
			));
		}
		else{
			return $this->redirect(['site/error']);
		}
	}

	public function actionDel(){
		if (Yii::$app->request->isAjax){
			$id = Yii::$app->request->get('id');
			$session = Yii::$app->session;
			$session->open();
			$cart = new Cart();
			$cart->recalc($id);
			$this->layout = false;
			$qty = empty($session['cart.qty']) ? 0 : $session['cart.qty'];
			return json_encode(array(
				cart_count=> $qty,
				cart_html=> $this->render('index', compact('session'))
			));
		}
		else{
			return $this->redirect(['site/error']);
		}
	}

	public function actionChange(){
		if (Yii::$app->request->isAjax){
			$id = Yii::$app->request->get('id');
			$qty = (int)Yii::$app->request->get('qty');
			$qty = !$qty ? 1 : $qty;
			$product = Product::findOne($id);
			$session = Yii::$app->session;
			$session->open();
			$cart = new Cart();
			if(!empty($product)) {
				$cart->changeToCart($product, $qty);
			}
			$this->layout = false;
			$qty = empty($session['cart.qty']) ? 0 : $session['cart.qty'];
			return json_encode(array(
				cart_count=> $qty,
				cart_html=> $this->render('index', compact('session'))
			));
		}
		else{
			return $this->redirect(['site/error']);
		}
	}

	public function actionConfirm() {
  		if (Yii::$app->request->isAjax) {

   			$session = Yii::$app->session;

   			if (!(\Yii::$app->user->isGuest)) {

    			if (isset($session['cart'])) {

     				foreach ($session['cart'] as $key => $value) {
					    $order = new Order();
					    $order->date = date("Y:m:d");
					    $order->user_id = \Yii::$app->user->id;
					    $order->product_id = $key;
					    $order->quantity = $value['qty'];
					    $order->product_name = $value['name'];
					    $order->price = $value['price'];
					    $order->serv_id = $value['service_id'];
					    $order->save();
     				}

						$session->open();
						$session->remove('cart');
						$session->remove('cart.qty');
						$session->remove('cart.sum');
						$this->layout = false;
						$qty = empty($session['cart.qty']) ? 0 : $session['cart.qty'];
						return json_encode(array(
							cart_count=> $qty,
							cart_html=> $this->render('index', compact('session'))
						));

				    // $session->setFlash('cartConfirm', 'Ваше замовлення було успішно підтверджене!');
				    // return json_encode(['cart_html' => $this->render('index')]);

    			} 
    			
    			else {
    	// 		 	return json_encode(array(
					// 	cart_count=> $qty,
					// 	cart_html=> $this->render('index', compact('session'))
					// ));
    			}
    		}
   			else { 	
				// return json_encode(array(
				// 	cart_count=> $qty,
				// 	cart_html=> $this->render('index', compact('session'))
				// ));
			}
   		}
		else $this->redirect(['site/error']);
	}

}

