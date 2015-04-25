<?php

class SiteController extends CController {

    /**
     * This is the default action that displays the phonebook Flex client.
     */
    public function actionIndex() {
        
        foreach(User::model()->findAll() as $u) {
            var_dump($u);
        }
        
        $this->render('index');
    }

    public function actionTest() {
       
        $product = Product::model()->findOne(array('ean' => '1234'));
        $product->title = 'First gen Calculus';
        $product->save();
        foreach($product->copies as $c) {
            var_dump($c);
        }
        
        die;
        
        $calc = Copy::model()->findOne(array('ean' => '1234'));
        var_dump($calc->owner->name);
        
        $this->render('index');
    }
    
    public function actionCreateTestSet() {
        
        // clean
        User::model()->deleteAll();
        Product::model()->deleteAll();
        Copy::model()->deleteAll();
        
        $han = new User();
        $han->name = 'Han';
        $han->nid = '2';
        $han->sub = 'Owner of Spull';
        $han->save();
        
        $wieringa = new User();
        $wieringa->name = 'Albert';
        $wieringa->nid = '123';
        $wieringa->sub = 'Owner of Spull Albert';
        $wieringa->save();
        
        $calculus = new Product;
        $calculus->ean = '1234';
        $calculus->title = 'Calculus';
        $calculus->description = 'Description of calculus';
        $calculus->save();
        
        $prog = new Product;
        $prog->ean = '8888';
        $prog->title = 'Programming';
        $prog->description = 'Description of Programming';
        $prog->save();
        
        $copy = new Copy();
        $copy->ean = $prog->ean;
        $copy->product = $prog;
        $copy->owner = $han;
        $copy->save();
        
        $wieringaCopy = new Copy;
        $wieringaCopy->ean = $calculus->ean;
        $wieringaCopy->owner = $wieringa;
        $wieringaCopy->product = $calculus;
        $wieringaCopy->save();
    }
    
}
