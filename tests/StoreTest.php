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


    }
?>
