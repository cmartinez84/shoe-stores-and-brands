# _Shoes and Brands

#### _An app to monitor the sale of brands at local shoe stores, September 30, 2016_

#### By _**Chris Martinez**_

## Description
_This app will allow the user to manage relationships between store brands and the shoes stores that carry them. The app will allow a user to create, read, update, and delete/destroy (CRUD) both shoes and brands and their relationships to each other. This app explores many to many relationships, as each store  carries many brands and each brand is sold at many stores._


## Specifications
| Behavior | Input Ex. | Output Ex. |
| --- | --- | --- |
|brand and shoe functionality is identical from their respective pages, and identical in action with regard to their relations to each other|
|Enter brand/store name|  nike | nike|
|Edit brand/store name| adidads |adidas |
|Delete brand/store name | delete adidas | adidas is deleted from database |
|Delete all brands/stores | delete all clicked | data for all brands and stores, respectively, will be deleted|
|An association between brands and stores can be added | Add Adidas to Famous Footwear, or Add Famous Footwear to Adidas |Adidas will be added to list of shoes carried by Famous Footwear, and Famous Footwear will be added to the list of stores that carries Adidas when this information is queried|
|These relationships can be deleted| delete relationship between Adidas and Famous Footwear|Neither Adidas nor Famous Footwear will return the other when associations are queried|

## Setup/Installation Requirements
* _Clone this repository to your desktop_
* _Run composer install from root_
* _Navigate to the web folder and begin your local server (php -S localhost:8000)_
* _Begin MAMP_
* _Initialize new Database by doing the following:_
* _Begin MySql Shell by running $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_
* _CREATE DATABASE shoes_
* _USE shoes
* _CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255))_
* _CREATE TABLE brands (id SERIAL PRIMARY KEY, name VARCHAR(255))_
* _CREATE TABLE brands_stores (id SERIAL PRIMARY KEY, store_id INT, brand_id INT))_

* _Alternatively, unzip the databases (both shoes and shoes_test) contained at the top level of this folder and import from phpmyadmin (http://localhost:8888/phpmyadmin/)_
* _in phpmyadmin, you may have also create another database for use with phpunit tests files by going to Operations> Copy Database To> and renaming database "shoes_brands" and choosing "structure only"_

* _Change localhost routing in app.php (and php documents in tests folder) to localhost enabled for mySQL. ex mysql:...host=localhost:8889;dbname=....in MAMP, you can find this by going to  MAMP > Preferences > Ports> MySql Port_
* _In terminal, navigate to web folder (shoes > web) and begin running local server _
* _Open Browser and navigate to http://localhost:8000_
## Link
https://github.com/cmartinez84/shoe-stores-and-brands

## Known Bugs
_This project does not contain redirect rules to prevent re-submitting post requests when refreshing page. Refreshing from delete route may cause an error, and refreshing after submitting new information may create duplicate entries_

## Support and contact details
_cardamomclouds@yahoo.com_

## Technologies Used
_HTML,
CSS,
Bootstrap,
JS,
jQuery
PHP,
TWIG,
Silex,
mySQL_

### License
The MIT License (MIT)

Copyright (c) 2016 **_Chris Martinez_**
