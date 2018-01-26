use `treaty`;
START TRANSACTION;

DELETE FROM `treaty`.`customeroffer`;
DELETE FROM `treaty`.`businessoffer`;
DELETE FROM `treaty`.`businessdetail`;
DELETE FROM `treaty`.`userdetail`;
DELETE FROM `treaty`.`user`;

ALTER TABLE `treaty`.`user` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`userdetail` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`businessdetail` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`businessoffer` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`customeroffer` AUTO_INCREMENT = 1;

-- insert script for user
INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (1, 'test_1234@gmail.com','1234567890', 'Customer', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (2, 'poonam.6788@gmail.com','1234567890', 'Customer', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (3, 'koradepoona1008@students.itu.edu','1234567890', 'Customer', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (4, 'poojamahajan2092@gmail.com','1234567890', 'Owner', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (5, 'rajeshwaripatil09@gmail.com','1234567890', 'Owner', 'test1234', 1);

-- insert script for userdetail
INSERT INTO `treaty`.`userdetail` (id, userid, firstname, lastname, phonenumber, address1, city, state, country, zipcode, isactive)
    VALUES (1, 1, 'test1', 'test2', '1234567890', 'ITU1234', 'San Jose', 'CA', 'USA', '95134', 1);

INSERT INTO `treaty`.`userdetail` (id, userid, firstname, lastname, phonenumber, address1, city, state, country, zipcode, isactive)
    VALUES (2, 2, 'Poonam', 'Korade', '4242909770', '2711 N 1st St.', 'San Jose', 'CA', 'USA', '95134', 1);

INSERT INTO `treaty`.`userdetail` (id, userid, firstname, lastname, phonenumber, address1, city, state, country, zipcode, isactive)
    VALUES (3, 4, 'Pooja', 'Mahajan', '6072329877', '2565 N 1st St', 'San Jose', 'CA', 'USA', '95131', 1);

INSERT INTO `treaty`.`userdetail` (id, userid, firstname, lastname, phonenumber, address1, city, state, country, zipcode, isactive)
    VALUES (4, 5, 'Rajeshwari', 'Patil', '9096728817', '2077 N 1st St', 'San Jose', 'CA', 'USA', '95131', 1);

INSERT INTO `treaty`.`userdetail` (id, userid, firstname, lastname, phonenumber, address1, city, state, country, zipcode, isactive)
    VALUES (5, 3, 'Poonam', 'Mhaskar', '0987654321', 'ITU4321', 'San Jose', 'CA', 'USA', '95131', 1);

-- insert script for businessdetail
INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode, isactive)
    VALUES (1, 4, 'test1', 'test2', 'ITU1234', 'San Jose', 'CA', 'USA', '95134', 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode, isactive)
    VALUES (2, 4, 'Dennys', 'Restaurant', '2565 N 1st St', 'San Jose', 'CA', 'USA', '95131', 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode, isactive)
    VALUES (3, 5, 'Subway', 'Restaurant', '1095 E. Brokaw Road, Suite 60, Brokaw Commons', 'San Jose', 'CA', 'USA', '95131', 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode, isactive)
    VALUES (4, 5, 'Papaya', 'Retail', 'Great Mall, 447 Great Mall Dr', 'Milpitas', 'CA', 'USA', '95035', 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode, isactive)
    VALUES (5, 5, 'T-Mobile', 'Telecom', '1095 E Brokaw Rd 50', 'San Jose', 'CA', 'USA', '95131', 0);

-- insert script for businessoffer
INSERT INTO `treaty`.`businessoffer` (id, userid, businessid, offername, offerdescription, creditedpoints, startdate, expirationdate, isactive)
    VALUES (1, 5, 4, 'Papaya-WINTER', '5 points per $ spent', 100, '2018-01-22 23:00:30', '2018-01-30 24:58:00',1);

INSERT INTO `treaty`.`businessoffer` (id, userid, businessid, offername, offerdescription, creditedpoints, startdate, expirationdate, isactive)
    VALUES (2, 5, 3, 'Subway-EATFREE', '1 point per $ spent', 20, '2018-01-23 23:00:30', '2018-02-25 24:58:00',1);

INSERT INTO `treaty`.`businessoffer` (id, userid, businessid, offername, offerdescription, creditedpoints, startdate, expirationdate, isactive)
    VALUES (3, 4, 2, 'Dennys-JIYO', '50 points per $ spent', 200, '2018-01-25 23:00:30', '2018-04-30 24:58:00',1);

-- insert script for customeroffer
INSERT INTO `treaty`.`customeroffer` (id, userid, businessid, offerid, isactive)
    VALUES (1, 2, 4, 1, 0);

INSERT INTO `treaty`.`customeroffer` (id, userid, businessid, offerid, isactive)
    VALUES (2, 3, 3, 2, 1);

INSERT INTO `treaty`.`customeroffer` (id, userid, businessid, offerid, isactive)
    VALUES (3, 2, 2, 3, 1);

COMMIT;
