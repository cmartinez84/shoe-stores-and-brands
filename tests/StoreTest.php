<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);

            //Act
            $result = $test_store->getName();
            //Assert
            $this->assertEquals($name, $result);
        }
        function test_getId()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();

            //Acts
            $result = $test_store->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        function test_save()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();

            //Acts
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_store], $result);
        }
        function test_getAll()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();

            $id2 = null;
            $name2 = "Famous Footwear";
            $test_store2 = new Store($id2, $name2);
            $test_store2->save();

            //Acts
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }
        function test_deleteAll()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();

            $id2 = null;
            $name2 = "Famous Footwear";
            $test_store2 = new Store($id2, $name2);
            $test_store2->save();

            //Acts
            Store::deleteAll();
            $result = Store::getAll();

            //Aseert
            $this->assertEquals([], $result);
        }
        function test_delete()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();
            $test_store->delete();

            $id2 = null;
            $name2 = "Foot Locker";
            $test_store2 = new Store($id2, $name2);
            $test_store2->save();

            //Acts
            $result = Store::getAll();
            //Assert
            $this->assertEquals([$test_store2], $result);
        }
        function test_find()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();
            $test_store->delete();

            $id2 = null;
            $name2 = "Foot Locker";
            $test_store2 = new Store($id2, $name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();
            //Asserte
            $this->assertEquals([$test_store2], $result);
        }
        function test_update()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();
            $test_store_id = $test_store->getId();

            $new_name = "Target";
            $test_store->update($new_name);

            //Act
            $updated_store = Store::find($test_store_id);
            $result = $updated_store->getName();

            //Assert
            $this->assertEquals("Target", $result);
        }
        function test_addBrand()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();
            $test_store_id = $test_store->getId();

            $brand_name = "Sketchers";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();
            $test_brand_id = $test_brand->getId();
            //Act
            $test_store->addBrand($test_brand_id);
            $result = $test_store->getBrands();

            //assert
            $this->assertEquals([$test_brand], $result);
        }
        function test_getBrands()
        {
            //Arrage
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();
            $test_store_id = $test_store->getId();

            $brand_name = "Sketchers";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();
            $test_brand_id = $test_brand->getId();

            $brand_name2 = "Sketchers";
            $test_brand2 = new Brand($id2, $brand_name2);
            $test_brand2->save();
            $test_brand_id2 = $test_brand2->getId();

            $test_store->addBrand($test_brand_id);
            $test_store->addBrand($test_brand_id2);
            //Act
            $result = $test_store->getBrands();
            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }
        function test_deleteBrand()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();
            $test_store_id = $test_store->getId();

            $brand_name = "Sketchers";
            $test_brand = new Brand($id, $brand_name);
            $test_brand->save();
            $test_brand_id = $test_brand->getId();

            $brand_name2 = "Sketchers";
            $test_brand2 = new Brand($id2, $brand_name2);
            $test_brand2->save();
            $test_brand_id2 = $test_brand2->getId();

            $test_store->addBrand($test_brand_id);
            $test_store->addBrand($test_brand_id2);
            //Act
            $test_store->removeBrand($test_brand_id2);
            $result = $test_store->getBrands();
            //Assert
            $this->assertEquals([$test_brand], $result);
        }
    }
?>
