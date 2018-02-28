use `treaty`;
START TRANSACTION;

DELETE FROM `treaty`.`customerbusiness`;
DELETE FROM `treaty`.`businessoffer`;
DELETE FROM `treaty`.`businessdetail`;
DELETE FROM `treaty`.`userdetail`;
DELETE FROM `treaty`.`user`;

ALTER TABLE `treaty`.`user` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`userdetail` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`businessdetail` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`businessoffer` AUTO_INCREMENT = 1;
ALTER TABLE `treaty`.`customerbusiness` AUTO_INCREMENT = 1;

-- insert script for user
INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (1, 'test_1234@gmail.com','1234567890', 'Customer', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (2, 'poonam.6788@gmail.com','1234567890', 'Customer', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (3, 'koradepoona1008@students.itu.edu','1234567890', 'Customer', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (4, 'poojamahajan2092@gmail.com','1234567890', 'Business Owner', 'test1234', 1);

INSERT INTO `treaty`.`user` (id, email, phonenumber, role, encryptedpassword, isactive)
    VALUES (5, 'rajeshwaripatil09@gmail.com','1234567890', 'Business Owner', 'test1234', 1);

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

-- Inserts for Business Categories
INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (1, 'Restaurant');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (2, 'Cafe');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (3, 'Bar');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (4, 'Supermarket');    

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (5, 'Spa');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (6, 'Beauty Salon');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (7, 'Gym');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (8, 'Laundry');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (9, 'Cleaning Services');

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (10, 'Auto Repairs');
    
INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (11, 'Convenience & Gas');    

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (12, 'Florist');    

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (13, 'Pet Store');    

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (14, 'Tailoring Services');    

INSERT INTO `treaty`.`businesssector` (id, businesssector)
    VALUES (15, 'Clothing Retail');    


-- insert script for businessdetail

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (1, 4, 'Dennys', 1, '2565 N 1st St', 'San Jose', 'CA', 'USA', '95131',12345678901,37.384867,-121.927876, 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude,isactive)
    VALUES (2, 5, 'Subway', 1, '1095 E. Brokaw Road, Suite 60, Brokaw Commons', 'San Jose', 'CA', 'USA', '95131',12345678901,37.383142,-121.897038, 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (3, 5, 'Papaya', 15, 'Great Mall, 447 Great Mall Dr', 'Milpitas', 'CA', 'USA', '95035',12345678901,37.415738,-121.897412, 1);
    
INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (4, 5, 'Family Wash', 8, '1643 McKee Rd', 'San Jose', 'CA', 'USA', '95116',12345678901,37.357269,-121.863172, 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (5, 5, 'Pizza Hut', 1, '102 S Park Victoria Dr', 'Milpitas', 'CA', 'USA', '95035',12345678901,37.434039,-121.883343, 1);

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (6, 5, 'Omega', 1, '90 S Park Victoria Dr', 'Milpitas', 'CA', 'USA', '95035',12345678901,37.434313,-121.883432, 1);
    
INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (7, 5, 'Naan n Masala', 1, '94 Dempsey Rd', 'Milpitas', 'CA', 'USA', '95035',12345678901,37.433218,-121.885443, 1);  

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (8, 5, 'Hyderabad Dum Biryani', 1, '55 Dempsey Rd', 'Milpitas', 'CA', 'USA', '95035',12345678901,37.435230,-121.884775, 1);  

INSERT INTO `treaty`.`businessdetail` (id, userid, businessname, businesssector, address1, city, state, country, zipcode,phonenumber, latitude, longitude, isactive)
    VALUES (9, 5, 'Juanita''s Polynesian Delights', 1, '36601 Newark Blvd #87', 'Newark', 'CA', 'USA', '94560',12345678901,37.538941,-122.034422, 1);  



-- insert script for businessoffer
INSERT INTO `treaty`.`businessoffer` (id, userid, businessid, offername, offerdescription, creditedpoints, startdate, expirationdate, isactive)
    VALUES (1, 5, 4, 'Papaya-WINTER', '5 points per $ spent', 100, '2018-01-22', '2018-01-30',1);

INSERT INTO `treaty`.`businessoffer` (id, userid, businessid, offername, offerdescription, creditedpoints, startdate, expirationdate, isactive)
    VALUES (2, 5, 3, 'Subway-EATFREE', '1 point per $ spent', 20, '2018-01-23', '2018-02-25',1);

INSERT INTO `treaty`.`businessoffer` (id, userid, businessid, offername, offerdescription, creditedpoints, startdate, expirationdate, isactive)
    VALUES (3, 4, 2, 'Dennys-JIYO', '50 points per $ spent', 200, '2018-01-25', '2018-04-30',1);

-- insert script for customeroffer
INSERT INTO `treaty`.`customerbusiness` (id, userid, businessid, isactive)
    VALUES (1, 2, 4, 0);

INSERT INTO `treaty`.`customerbusiness` (id, userid, businessid, isactive)
    VALUES (2, 3, 3, 1);

INSERT INTO `treaty`.`customerbusiness` (id, userid, businessid, isactive)
    VALUES (3, 2, 2, 1);

INSERT INTO `treaty`.`customerbusiness` (id, userid, businessid, isactive)
    VALUES (4, 5, 4, 1);


COMMIT;
