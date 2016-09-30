<?php
// ./vendor/bin/phpunit tests
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";


    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Store::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);

            //Act
            $result = $test_store->getName();

            $this->assertEquals($name, $result);
        }
        function test_getId()
        {
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();

            //Acts
            $result = $test_store->getId();

            $this->assertEquals(true, is_numeric($result));
        }
        function test_save(){
            $id = null;
            $name = "Famous Footwear";
            $test_store = new Store($id, $name);
            $test_store->save();

            //Acts
            $result = Store::getAll();

            $this->assertEquals([$test_store], $result);
        }
        function test_getAll()
        {
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

            $this->assertEquals([$test_store, $test_store2], $result);
        }
        function test_deleteAll()
        {
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

            $this->assertEquals([], $result);
        }
        function test_delete()
        {
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

            $this->assertEquals([$test_store2], $result);
        }
        function test_find()
        {
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

            $this->assertEquals([$test_store2], $result);
        }
        function test_update()
        {
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

            $this->assertEquals("Target", $result);
        }
    }
?>
