<?php
    Class Store
    {
        private $id
        private $name;

        function __construct($id=null, $name)
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
            return $this->getName();
        }
        function setName($new_name)
        {
            $this->name = $new_name;
        }
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET name='{$new_name}' WHERE id={$this->getId()}");
        }
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id={$this->getId()};");
        }
        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores");
            $stores = array();
            foreach($returned_stores as $store){
                $id = $store['id'];
                $name = $store['name'];
                $new_store = new Store($id, $name);
                array_push($stores, $new_store);
            }
            return $stores;
        }
        static function deleteAll(){
            $GLOBALS['DB']->exec("DELETE FROM stores");
        }

        static function find($search_id)
        {
            $all_stores = Store::getAll();
            foreach($all_stores as $store){
                if($store->getId() == $search_id)
                {
                    $found_store = $store;
                }
            }
            return $found_store;
        }
    }

 ?>
