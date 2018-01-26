select * from user;

select * from userdetail;

select * from businessdetail;

select * from businessoffer;

select * from customeroffer;

desc userdetail;

INSERT INTO `treaty`.`user` (id, email, role, encryptedpassword, isactive)
    VALUES (6, 'ituguest@gmail.com', 'Customer', ENCODE('test1234', 'secret'), 1);
    
select  DECODE(`encryptedpassword`, 'secret') as encryptedpassword from user;

-- SELECT role FROM user where email="test_1234@gmail.com" and encrypted_password="test1234";

-- INSERT INTO user (email,role,encrypted_password) VALUES ("test_12345@gmail.com","Customer","test12345") ;

-- UPDATE user SET encrypted_password="CqxPWJi5" WHERE email="test_1234@gmail.com";

INSERT INTO user (email,role,encryptedpassword) VALUES ("test_123@gmail.com","Customer","test_123");
INSERT INTO userdetail(userid, firstname, lastname, phonenumber, address1, address2, city, state, country, zipcode, modified, created) VALUES ("1","Tushar","Mhaskar","1234567890","1433 Cedarmeadow Ct","#1433" ,"San Jose","California","United States","95131", sysdate(), sysdate());