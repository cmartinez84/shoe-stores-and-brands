<?php
// ./vendor/bin/phpunit tests
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class BrandTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown(){
                Brand::deleteAll();
        }
        function test_getName()
        {
            //Arange
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
        function test_getId()
        {
            //Arange
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);
            $test_brand->save();

            //Act
            $result = $test_brand->getName();

            //Assert
            $this->assertEquals($name, $result);

        }
        function test_save()
        {
            //Arange
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);
            $test_brand->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand], $result);

        }
        function test_getAll()
        {
            //Arange
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);
            $test_brand->save();

            $id2 = null;
            $name2 = "Nike";
            $test_brand2 = new Brand($id2, $name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand,$test_brand2], $result);
        }
        function test_deleteAll()
        {
        //Arange
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);
            $test_brand->save();

            $id2 = null;
            $name2 = "Nike";
            $test_brand2 = new Brand($id2, $name2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
        function test_delete()
        {
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);
            $test_brand->save();
            $test_brand->delete();

            $id2 = null;
            $name2 = "Nike";
            $test_brand2 = new Brand($id2, $name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand2], $result);
        }
        function test_find()
        {
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);
            $test_brand->save();
            $test_brand_id = $test_brand->getId();
            //Act
            $result = Brand::find($test_brand_id);
            var_dump($result);
            //Assert
            $this->assertEquals($test_brand, $result);
        }
        function test_update(){
            //Act
            $id = null;
            $name = "Nike";
            $test_brand = new Brand($id, $name);
            $test_brand->save();
            $test_brand_id = $test_brand->getId();

            //Act
            $new_name = "Adidas";
            $test_brand->update($new_name);
            $altered_brand = Brand::find($test_brand_id);
            $result = $altered_brand->getName();

            //Assert
            $this->assertEquals($new_name, $result);

        }
    }
?>
