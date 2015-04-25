<?php
class EmbedTest extends MongoTestCase
{
    public $fixtures = array('users','products','copies');
    
    public function testAdd() {
        $copy = new Copy;
        $product = Product::model()->findOne();
        $owner = User::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = $owner;
        $copy->product = $product;
        $this->assertTrue($copy->save());
    }
    
    public function testAddNull() {
        $copy = new Copy;
        $product = Product::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = null;
        $copy->product = $product;
        $this->assertFalse($copy->save());
    }
    
    public function testAddInvalidRecord() {
        $copy = new Copy;
        $product = Product::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = new User;
        $copy->product = $product;
        $this->assertFalse($copy->save());
    }
    
    public function testAddEmpty() {
        $copy = new Copy;
        $product = Product::model()->findOne();
        $copy->ean = $product->ean;
        $this->assertFalse($copy->save());
    }
    
    
    public function testGetEmbed() {
        
        // init
        $copy = new Copy;
        $product = Product::model()->findOne();
        $owner = User::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = $owner;
        $copy->product = $product;
        $this->assertTrue($copy->save());
        
        // refresh
        $copy->refresh();
        
        // test
        $this->assertNotNull($copy->_embed_owner);
        $this->assertEquals($owner->name, $copy->_embed_owner['name']);
        $this->assertEquals($owner->nid, $copy->_embed_owner['nid']);
        
        $this->assertNotNull($copy->_embed_product);
        $this->assertEquals($product->title, $copy->_embed_product['title']);
        $this->assertEquals($product->ean, $copy->_embed_product['ean']);
    }
    
    public function testEmbedHash() {
        
        $user = new User;
        $user->name = 'Han van der Veen';
        $user->nid = '123';
        
        $this->assertEquals(md5(serialize(array('name' => 'Han van der Veen', 'nid' => '123'))), $user->embedHash());
    }
    
    public function testDisableEmbed() {
        
        $copy = new Copy;
        $copy->setIsEmbed(false);
        
        $this->assertFalse($copy->getIsEmbed());
        
        $product = Product::model()->findOne();
        $owner = User::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = $owner;
        $copy->product = $product;
        
        $this->assertTrue($copy->save());
        $this->assertFalse(isset($copy->_embed_owner));
        $this->assertFalse(isset($copy->_embed_product));
    }
    
    public function testUpdateReferencesChanged() {
        $copy = new Copy;
        $product = Product::model()->findOne();
        $owner = User::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = $owner;
        $copy->product = $product;
        $this->assertTrue($copy->save());
        $copy->refresh();
        $this->assertEquals($owner->name, $copy->_embed_owner['name']);
        
        // change name
        $owner->name = 'Pietje Puk';
        $owner->save();
        
        $copy->refresh();
        $this->assertEquals('Pietje Puk', $copy->_embed_owner['name']);
    }
    
    public function testUpdateReferencesNotChanged() {
        $copy = new Copy;
        $product = Product::model()->findOne();
        $owner = User::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = $owner;
        $copy->product = $product;
        $this->assertTrue($copy->save());
        $copy->refresh();
        $this->assertEquals($owner->name, $copy->_embed_owner['name']);
        
        // change name
        $owner->sub = 'Pietje Puk';
        $owner->save();
        
        $copy->refresh();
        $this->assertEquals($owner->name, $copy->_embed_owner['name']);
    }
    
    public function testRelatedEmbedPartialLoaded() {
        
        $copy = new Copy;
        $product = Product::model()->findOne();
        $owner = User::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = $owner;
        $copy->product = $product;
        $this->assertTrue($copy->save());
        
        unset($copy->owner);
        
        $owner_via_copy = $copy->owner;
        $this->assertEquals($owner->name, $owner_via_copy->name);
        $this->assertEquals($owner->nid, $owner_via_copy->nid);
        $this->assertNull($owner_via_copy->sub);
    }
    
    public function testRelatedEmbedFullLoad() {
        $copy = new Copy;
        $product = Product::model()->findOne();
        $owner = User::model()->findOne();
        $copy->ean = $product->ean;
        $copy->owner = $owner;
        $copy->product = $product;
        $this->assertTrue($copy->save());
        unset($copy->owner);
        
        $owner_via_copy = $copy->owner;
        $owner_via_copy->fullReload();
        
        $this->assertEquals($owner->name, $owner_via_copy->name);
        $this->assertEquals($owner->nid, $owner_via_copy->nid);
        $this->assertEquals($owner->sub, $owner_via_copy->sub);
    }
    
    public function testNoEmbedRelation() {
        $copy = Copy::model()->findOne();
        $this->assertNotNull($copy->owner->sub);
    }
}