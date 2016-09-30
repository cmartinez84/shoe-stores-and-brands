<?php

    class Brand
    {
        private $id;
        private $name;

        function __construct($id, $name)
        {
            $this->id = $id;
            $this->name = $name;
        }
        function getId()
        {
            return $this->id;
        }
        function getName()
        {
            return $this->name;
        }
        function setName($new_name)
        {
            $this->name = $new_name;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id={$this->getId()};");
        }
        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET name ='{$new_name}' WHERE id={$this->getId()};");
        }
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand)
            {
                $id = $brand['id'];
                $name = $brand['name'];
                $new_brand = new Brand($id, $name);
                array_push($brands, $new_brand);
            }
            return $brands;
        }
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }
        static function find($search_id)
        {
            $all_brands = Brand::getAll();
            foreach($all_brands as $brand){
                if($brand->getId() == $search_id){
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }
    }
?>
