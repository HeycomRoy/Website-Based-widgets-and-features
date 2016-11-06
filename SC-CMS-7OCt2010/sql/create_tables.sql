CREATE TABLE IF NOT EXISTS cartproducts(
PID int( 6 ) NOT NULL AUTO_INCREMENT ,
PTitle varchar( 255 ) ,
PName varchar( 100 ) ,
PDesc longtext,
PImage varchar( 255 ) ,
PPrice float default '0.00',
PRIMARY KEY ( PID ) 
) TYPE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS orders (
OrderID INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
UserName VARCHAR( 105 ) NOT NULL ,
UserEmail VARCHAR( 105 ) NULL ,
UserPhone VARCHAR( 21 ) NULL ,
UserHnoSt VARCHAR( 255 ) NOT NULL ,
UserSuburb VARCHAR( 105 ) NULL ,
UserCity VARCHAR( 105 ) NOT NULL ,
UserCountry VARCHAR( 105 ) NOT NULL ,
UserShipHnoSt VARCHAR( 255 ) NULL ,
UserShipSuburb VARCHAR( 105 ) NULL ,
UserShipCity VARCHAR( 105 ) NULL ,
UserShipCountry VARCHAR( 105 ) NULL ,
ReceiptNumber VARCHAR( 40 ) NOT NULL ,
TotalValue FLOAT NOT NULL ,
OrderDate DATETIME NOT NULL ,
OrderStatus BINARY NOT NULL ,
OrderDispatchDate DATE NOT NULL 
) TYPE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS orderedproducts (
OrdProdID INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
OrderID INT NOT NULL ,
ProductID INT NOT NULL ,
ProductPrice FLOAT NOT NULL ,
Quantity INT NOT NULL 
) TYPE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;
