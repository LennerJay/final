-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD

-- Generation Time: May 25, 2023 at 01:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

-- Generation Time: May 24, 2023 at 07:24 AM
=======
-- Generation Time: May 26, 2023 at 10:22 AM
>>>>>>> a5e9e7f63822c4e7c26f433c3f5c15f52a805db2
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_commerce`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_accountChecker` (IN `sp_email` TEXT, IN `sp_password` TEXT)   BEGIN

	SELECT * FROM tbl_user 
	WHERE email = sp_email AND password = sp_password;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addToCart` (IN `p_user_id` INT, IN `p_product_id` INT, IN `p_status` INT)   BEGIN
	INSERT INTO `tbl_cart`(userid,product_id,status,date_added) VALUES(p_user_id,p_product_id,p_status,now());

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addUpdateProduct` (IN `sp_product_brand` TEXT, IN `sp_product_name` TEXT, IN `sp_product_description` TEXT, IN `sp_product_spec` TEXT, IN `sp_product_price` DECIMAL(11,2), IN `sp_product_newPrice` DECIMAL, IN `sp_product_stock` INT, IN `sp_product_category` TEXT, IN `sp_product_image` TEXT, IN `sp_product_id` INT)   BEGIN

	DECLARE oldPrice int;


	if sp_product_id = 0 THEN
    	INSERT INTO tbl_products(product_brand,
                            product_name,
                            product_description,
                            product_specification,

                            product_newPrice,

                            product_oldPrice,

                            product_stock,
                            product_img,
                            product_category,
                            date_created)
                            VALUES(sp_product_brand,
                                  sp_product_name,
                                  sp_product_description,
                                  sp_product_spec,
                                  sp_product_price,
                                  sp_product_stock,
                                  sp_product_image,
                                  sp_product_category,
                                  now());

                                  
     else 
			set oldPrice = (SELECT product_newPrice FROM tbl_products WHERE product_id = sp_product_id);
            if sp_product_image != '' THEN
                UPDATE tbl_products SET
                         product_brand = sp_product_brand,
                         product_name = sp_product_name,
                         product_description = sp_product_description,
                         product_specification = sp_product_spec,
                         product_newPrice =sp_product_newPrice,
                         product_oldPrice = oldPrice,
                         product_stock = sp_product_stock,
                         product_img = sp_product_image,
                         product_category = sp_product_category
                         WHERE product_id = sp_product_id;
            else
            	UPDATE tbl_products SET
                         product_brand = sp_product_brand,
                         product_name = sp_product_name,
                         product_description = sp_product_description,
                         product_specification = sp_product_spec,
                         product_newPrice =sp_product_newPrice,
                         product_oldPrice = oldPrice,
                         product_stock = sp_product_stock,
                         product_category = sp_product_category
                         WHERE product_id = sp_product_id;
            
            end if;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addUpdateVariant` (IN `p_product_id` INT, IN `p_product_variant` TEXT, IN `p_product_stock` INT, IN `p_product_img` TEXT)   BEGIN
	if p_product_id = 0 THEN
    	INSERT INTO tbl_variant(product_variant,product_stock,product_img,date_created)
        VALUES(p_product_variant,p_product_stock,p_product_img,now());
    
   	else
    	UPDATE tbl_variant SET
        	product_variant = p_product_variant,
            product_stock = p_product_stock,
            product_img = p_product_img 
         	WHERE product_id = p_product_id;
    end if;


     VALUES(sp_product_id,sp_product_image);
     else 
     	if sp_product_image != "" THEN
     		update tbl_products SET 
        		product_brand = sp_product_brand,
            	product_name = sp_product_name,
            	product_description = sp_product_description,
            	product_specification = sp_product_spec,
            	product_newPrice = sp_product_newPrice,
            	product_stock = sp_product_stock,
            	product_img = sp_product_image,
            	product_category = sp_product_category WHERE product_id = sp_product_id;
         else 
         	update tbl_products SET
            	product_brand = sp_product_brand,
            	product_name = sp_product_name,
            	product_description = sp_product_description,
            	product_specification = sp_product_spec,
            	product_newPrice = sp_product_newPrice,
            	product_stock = sp_product_stock,
            	product_category = sp_product_category WHERE product_id = sp_product_id;
         end if;
      end if;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_addVariant` (IN `sp_pid` INT, IN `sp_variant` TEXT, IN `sp_vstock` INT, IN `sp_img` TEXT)   BEGIN
INSERT INTO tbl_variant(product_id,product_variant,product_quantity,product_img,date_created) 
VALUES(sp_pid,sp_variant,sp_vstock,sp_img,now());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_checkUser` (IN `sp_email` TEXT, IN `sp_password` TEXT)   BEGIN
	DECLARE ret int;
    DECLARE attempts int;
    IF EXISTS(SELECT * FROM tbl_user WHERE email = sp_email AND `password` = sp_password) THEN
        set attempts = (select log_attempts from tbl_user where email = sp_email and `password` = sp_password);
    	if attempts < 3 THEN
				set ret = 1;
    			select *,ret from tbl_user where email = sp_email AND `password` = sp_password;
        ELSE
        	set ret = 3;
            SELECT ret;
        end if;
    ELSEIF EXISTS(SELECT * FROM tbl_user WHERE email = sp_email) THEN
    	UPDATE tbl_user set log_attempts = log_attempts + 1, date_disable = now() WHERE email = sp_email;
    	set ret = 2;
        SELECT ret;
    ELSE
    	set ret = 0;
        SELECT ret;
    end if;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteBlockUser` (IN `sp_id` INT)   BEGIN
 DELETE FROM tbl_user WHERE userid = sp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteItem` (IN `sp_productid` INT)   BEGIN
	if sp_productid = 0 THEN
    SELECT * FROM tbl_products;
    else 
    	DELETE FROM tbl_products WHERE product_id = sp_productid;
        DELETE FROM tbl_variant WHERE product_id = sp_productid;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_deleteProducts` (IN `sp_cartId` INT)   BEGIN

	DELETE FROM tbl_cart
	WHERE cart_id = sp_cartId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_existChecker` (IN `sp_email` TEXT)   BEGIN

	SELECT email FROM tbl_user
	WHERE email = sp_email;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCart` (IN `p_user_id` INT)   BEGIN
	 select * from tbl_cart where userid = p_user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCustomer` (IN `sp_id` INT)   BEGIN
	if sp_id = 0 THEN
    SELECT DISTINCT tu.userid,concat(tu.firstname, ' ', tu.lastname) as Costumer_Name, 
    concat(tu.street, ',', tu.city, ',', tu.state) as Address, tu.zipcode, tu.gender, tu.email, tp.status
    FROM tbl_purchase as tp left join tbl_user tu on tp.userid = tu.userid WHERE tp.status = 'Pending';
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCustomerPurchased` (IN `sp_id` INT)   BEGIN
	if sp_id = 0 THEN
    SELECT * FROM tbl_purchase as tp left join tbl_user tu on tp.userid = tu.userid left join tbl_products as tpr on tp.product_id = tpr.product_id WHERE tp.status = 'Pending';
    else 
    SELECT  tpr.product_id,
    		tpr.product_brand,
            tpr.product_name,
            tpr.product_description,
            tpr.product_specification,
            tpr.product_oldPrice,
            tpr.product_newPrice,
            tpr.product_category,
            tpr.product_img,
            tp.quantity,
            tpr.product_stock,
            tp.status,
            tp.userid
            
    FROM tbl_purchase as tp left JOIN tbl_products as tpr on tp.product_id = tpr.product_id WHERE tp.userid = sp_id AND tp.status = 'Pending';
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getDisableUser` (IN `sp_id` INT)   BEGIN
	if sp_id = 0 THEN
    SELECT DISTINCT tu.userid,tu.username,concat(tu.firstname, ' ', tu.lastname) as Fullname,
    concat(tu.street, ',', tu.city, ',', tu.state) as Address, tu.gender, tu.email, tu.log_attempts as attempt, tu.date_disable
    FROM tbl_user as tu WHERE tu.log_attempts > 3;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getProduct` (IN `p_product_id` INT)   BEGIN

if p_product_id = 0 then
   select * from tbl_products;
else
   select * from tbl_products where product_id = p_product_id;

end if;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getPurchasedProducts` (IN `sp_cartId` INT)   BEGIN

	SELECT * FROM tbl_cart
	WHERE cart_id = sp_cartId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getShoppingCart` (IN `p_user_id` INT)   BEGIN
  select * from tbl_cart where userid = p_user_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getTotalSales` (IN `sp_id` INT)   BEGIN
	if sp_id = 0 THEN
		SELECT SUM(total_sales) as total_sales FROM tbl_products;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUser` (IN `sp_userid` INT)   BEGIN
	if sp_userid = 0 THEN
    SELECT * FROM tbl_user where log_attempts = 1;
    else
    SELECT * FROM tbl_user where userid = sp_userid;
     end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_saveProducts` (IN `sp_userId` INT, IN `sp_productId` INT, IN `sp_quantity` INT, IN `sp_status` TEXT)   BEGIN

	INSERT INTO tbl_purchase(userid, product_id, quantity, status, date_purchased)
	VALUES(sp_userId, sp_productId, sp_quantity, sp_status, now());

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_savePurchase` (IN `p_user_id` INT, IN `p_product_id` INT, IN `p_quantity` INT, IN `p_status` TEXT)   BEGIN
	INSERT INTO `tbl_purchase`(userid,product_id,quantity,status,date_purchased) 
    VALUES(p_user_id,p_product_id,p_quantity,p_status,now());

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_saveUser` (IN `sp_username` TEXT, IN `sp_firstname` TEXT, IN `sp_lastname` TEXT, IN `sp_street` TEXT, IN `sp_city` TEXT, IN `sp_state` TEXT, IN `sp_zipcode` INT, IN `sp_age` INT, IN `sp_gender` TEXT, IN `sp_email` TEXT, IN `sp_password` TEXT, IN `sp_profile_picture` TEXT, IN `sp_userid` INT)   BEGIN
	if sp_userid = 0 THEN
    INSERT INTO tbl_user(username,firstname,lastname,street,city,state,zipcode,age,gender,email,`password`,images,date_created,role,`status`,log_attempts) 
    VALUES(sp_username,sp_firstname,sp_lastname,sp_street,sp_city,sp_state,sp_zipcode,sp_age,sp_gender,sp_email,sp_password,sp_profile_picture,now(),1,1,0);
  end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateBlockUser` (IN `sp_id` INT)   BEGIN
    UPDATE tbl_user SET 
    log_attempts = 1 WHERE userid = sp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateSales` (IN `sp_id` INT, IN `sp_pid` INT, IN `sp_quantity` INT, IN `sp_price` INT, IN `sp_status` TEXT)   BEGIN
	if sp_id = 0 THEN
        SELECT * FROM tbl_purchase as tp left join tbl_user tu on tp.userid = tu.userid left join tbl_products as tpr on tp.product_id = tpr.product_id;
    else
    	UPDATE tbl_purchase set
        		`status` = sp_status WHERE userid = sp_id AND product_id = sp_pid;
        UPDATE tbl_products set
        		product_stock = product_stock - sp_quantity,
                total_sales = total_sales + sp_price,
                product_sold = product_sold + sp_quantity WHERE product_id = sp_pid;
     end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateUser` (IN `sp_username` TEXT, IN `sp_email` TEXT, IN `sp_firstname` TEXT, IN `sp_lastname` TEXT, IN `sp_street` TEXT, IN `sp_city` TEXT, IN `sp_state` TEXT, IN `sp_zipcode` INT, IN `sp_gender` TEXT, IN `sp_roles` INT, IN `sp_status` INT, IN `sp_userid` INT)   BEGIN
	update tbl_user set 
    	username = sp_username,
        email = sp_email,
        firstname = sp_firstname,
        lastname = sp_lastname,
        street = sp_street,
        city = sp_city,
        state = sp_state,
        zipcode = sp_zipcode,
        gender = sp_gender,
        role = sp_roles,
        `status` = sp_status WHERE userid = sp_userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateUserEmail` (IN `sp_email` TEXT, IN `sp_userId` TEXT)   BEGIN

	UPDATE tbl_user
	SET email = sp_email WHERE userid = sp_userId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateUserInformation` (IN `sp_username` TEXT, IN `sp_firstname` TEXT, IN `sp_lastname` TEXT, IN `sp_street` TEXT, IN `sp_city` TEXT, IN `sp_state` TEXT, IN `sp_zipCode` INT, IN `sp_age` INT, IN `sp_userid` INT)   BEGIN

	UPDATE tbl_user
	SET username = sp_username, firstname = sp_firstname, lastname = sp_lastname, street = sp_street,
	city = sp_city, state = sp_state, zipcode = sp_zipCode, age = sp_age 
    WHERE userid = sp_userid;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateUserPassword` (IN `sp_password` TEXT, IN `sp_userId` INT)   BEGIN

	UPDATE tbl_user SET password = sp_password
	WHERE userid = sp_userId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_userPurchased` (IN `sp_uid` INT)   BEGIN
	SELECT 
                    tpr.product_name,
                    tpr.product_brand,
                    tpr.product_oldPrice,
                    tpr.product_description,
                    tpr.product_specification,
                    tpr.product_img,  
                    tpr.product_category 
                    
                    FROM tbl_purchase as tp
                    LEFT JOIN tbl_products tpr ON tpr.product_id = tp.product_id
                    WHERE tp.userid = sp_uid AND tp.status = 'Approve';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `userid`, `product_id`, `status`, `date_added`) VALUES
(158, 18, 50, 0, '2023-05-26 15:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `product_id` int(11) NOT NULL,
  `product_brand` text NOT NULL,
  `product_name` text NOT NULL,
  `product_description` text NOT NULL,
  `product_specification` text NOT NULL,
  `product_oldPrice` decimal(11,2) NOT NULL,
  `product_newPrice` decimal(11,2) NOT NULL,
  `total_sales` decimal(11,2) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_sold` int(11) NOT NULL,
  `product_img` text NOT NULL,
  `product_category` text NOT NULL,
  `isDeleted` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_brand`, `product_name`, `product_description`, `product_specification`, `product_oldPrice`, `product_newPrice`, `total_sales`, `product_stock`, `product_sold`, `product_img`, `product_category`, `isDeleted`, `date_created`) VALUES

(20, 'tesla', 'computer', 'asdada', 'sdad', 200.00, 11999.99, 0.00, 20, 0, 'computer.jpg', 'computer', 0, '2023-05-01 15:20:52'),
(21, 'Propermac', 'Work PC Bundle ', 'Refurbished Pc with the upgraded drive to  Solid State Drive – up to 10 times quicker than with a standard HDD, the system will start in seconds. Cleaned and resprayed if needed.', 'Intel i7 Quad Core 3.4 GHz i7-4770,  Integrated with CPU Intel HD 4600, 960GB SSD, 16GB RAM DDR3,\r\n2×24″ Full HD Monitor (brand and model depending on the stock – pictures for illustration purposes only),\r\nDVD RW, WiFi, Power cable, keyboard and mouse,Genuine Windows digitally activated,Windows 10 Home 64 bit', 25981.57, 22999.85, 0.00, 10, 0, 'computer-set2.webp', 'computer', 0, '2023-05-01 15:32:56'),
(22, 'Lenovo', 'Lenovo ThinkPad P16s G1 21BT001PUS 16', 'Touchscreen · Windows OS · Quad Core · With Backlit Keyboard · USB-C · HDMI · Ethernet · 3.5-mm Jack · 1920 x 1200 · Intel CPU', 'Intel Core i7 3.40 GHz processor provides lightning fast speed and peak performance for the toughest of tasks and games,\r\nWith 16 GB of memory, runs as many programs as you want without losing the execution,\r\n16\" display with 1920 x 1200 resolution showcases movies, games and photos with impressive clarity,\r\n512 GB SSD is enough to store your essential documents and files, favorite songs, movies and pictures,\r\nNVIDIA QN20-M1-R 6 GB discrete graphic card provides excellent ability in a variety of multimedia applications and user experiences', 110870.21, 100870.21, 0.00, 20, 250, 'laptop.webp', 'computer', 0, '2023-05-01 16:14:03'),
(23, 'Collinx Computer Technology', 'System Unit Intel I7 10th Gen Processor', 'Collinx Computer Technology offers high-tech, brand-new, and complete computer products at an affordable price. It also specializes in the repair and customized cool computer builds.', ' Processor:  Intel i7 10700 (10th Gen)\r\nIntel Core i7 10700 Core i7 10700 - desktop processor produced by Intel for socket BGA-1200 that has 8 cores and 16 threads, Motherboard: Msi / Asus / Gigabyte/ Colorful H410M (LGA1200), LGA1150 socket for Intel® 4th Generation Core™i7/ Core™i5/Core™i3 Processors, Dual-Channel DDR3 1333 / 1600 support, SATA 3Gb/s, GPU: Intel HD Graphics 630, RAM: 8GB DDR4 RAM, SSD: 240GB 2.5\" SATA SSD (10x Faster than Hard Disk), Case: Darkflash dk150  ATX, Fans: 4  FANS,PSU: 650w True rated 80+ PSU, gtx1050ti galax df ', 45160.00, 41160.00, 270960.00, -6, 117, 'systemUnit.jpg', 'computer', 0, '2023-05-01 16:24:36'),
(24, '‎HP', 'HP ZBook Fury G9 16\" Mobile Workstation ', 'Tackle your most intense workflows with the ZBook Fury-now offering a desktop CPU in a laptop. With integrated or discrete graphics, a stunning display and collaboration features you can edit 8K videos, render in 3D or train machine learning models. Experience extreme pro performance-all on the move.\r\n\r\n', 'With 64 GB DDR5 SDRAM of memory, users can run many programs without losing execution, 16\" display with 1920 x 1200 resolution showcases movies, games and photos with impressive clarity, 1 TB SSD for spacious storage with much faster data transfer speed than standard hard drives, NVIDIA RTX A5000 16 GB discrete graphic card provides excellent ability in a variety of multimedia applications and user experiences', 233078.31, 213078.31, 233078.00, 24, 116, 'laptop1.webp', 'computer', 0, '2023-05-01 16:28:02'),
(25, 'Asus', 'Asus Ga503qmbs94q ROG Zephyrus G15 15.6\" QHD Laptop - AMD Ryzen 9 -', 'Power meets portability in the versatile ROG Zephyrus G15, which puts premium gaming in an ultra-slim 1.9kg chassis. Performance is fast and smooth with a powerful CPU and advanced GPU. The WQHD gaming panel balances speed with rich detail to draw you deep into the action.', 'ROG Zephyrus G15 , Game & create & and beyond, Blaze through gaming.', 88696.06, 85696.06, 0.00, 5, 0, 'laptop2.webp', 'computer', 0, '2023-05-01 16:31:42'),
(26, 'MSI', 'MSI All-in-One Computer PRO', 'MSI All-in-One Computer PRO 22XT 10M-459US Intel Core i3 10th Gen 10100 (3.60GHz) 8GB DDR4 256 GB M.2 NVMe SSD 21.5\" Touchscreen Windows 11 Home 64-bit', 'Intel Core i3 10th Gen 10100 (3.60GHz), 8GB DDR4 256 GB M.2 NVMe SSD, 21.5\" Touchscreen 1920 x 1080, Windows 11 Home 64-bit, Intel UHD Graphics 630', 52986.87, 50.00, 0.00, 2, 0, 'computer.jpg', 'computer', 0, '2023-05-01 16:36:13'),
(27, 'Intel Core', 'Intel Core i3 i3-4160 Dual-Core (2 Core) 3.60 GHz Processor', 'The Intel Core i3 processor is the perfect entry point for a fast, responsive PC experience. Do not let too many open applications slow you and your PC down. Get smart performance now.\r\n\r\n', 'Intel Core i3-4160 CPU/Processor 3,60GHz Dual Core, your 1st choice for 2nd generation hardware', 699.45, 499.45, 0.00, 100, 0, 'corei3.webp', 'computer', 0, '2023-05-01 16:39:42'),
(28, 'Tecware', 'Tecware Pulse Elite Wireless Gaming Mouse', 'Tecware Pulse Elite Wireless Gaming Mouse', '2.4GHz Wireless with Dongle, 5 Fully Programmable Buttons, PixArt 3370 Sensor, Up to 19000DPI Resolution, 400 / 800 / 1600 / 3200 / 6400 / 19000 DPI, 2x Huano Switch,2x Kailh Switch,Macro Support via Software, 400mAh, Up to 50 hours Battery Life,1.6m Paracord USB-C to USB2.0 Cable Included, 125 x 63.5 x 40mm / 70g ', 2500.00, 2195.35, 0.00, 300, 0, 'mouse.jpg', 'computer', 0, '2023-05-01 17:01:20'),
(29, 'Logitech', 'Logitech G102 Gaming Mouse Black', 'Logitech G102 Gaming Mouse Black', 'LIGHTSYNC RGB lighting, 6 programmable buttons, Resolution: 200 – 8,000 DPI, Height: 116.6 mm, Width: 62.15 mm, Depth: 38.2 mm, Weight: 85 g, (mouse only), Cable Length: 2.1 m', 1495.00, 945.00, 0.00, 50, 0, 'mouse1.webp', 'computer', 0, '2023-05-01 17:04:26'),
(30, 'Samsung', 'Samsung Galaxy S22 ', 'Samsung Galaxy S22 cellphone sale 12GB + 512GB original phone mobile phone 5G smartphone COD', 'Model No.Galaxy S22 Ultra+, Platform MTK6889, Standby Dual sim dual standby(Dual SIM+Dedicated micro SD Card Slot), Screen 6.8 HD+ Full Display 1440*3200, Speaker 1511 Box Speaker, FrequencyGSM85090018001900MHz,3GWCDMA85019002100MHz，4G LTE 5G\r\n,Vibration Support, Memory 12/16GB RAM + /256GB/512GB ROM\r\n,Multi Media MP3 MP4 3GPFM RadioBluetooth, Camera 24MP+58MP, 11.Battery 6800 mAh Lithium-ion battery', 3399.00, 2999.00, 16995.00, 25, 5, 'cp.jpg', 'mobile', 0, '2023-05-01 17:10:53'),
(31, 'Asus', 'Asus ROG Phone 7 Ultimate', 'Asus ROG Phone 7 Ultimate mobile was launched on 13th April 2023. The phone comes with a 165 Hz refresh rate 6.78-inch touchscreen display offering a resolution of 2448x1080 pixels (FHD+) at a pixel density of 395 pixels per inch (ppi).', 'Display: 6.78-inch (2448x1080), Processor: Snapdragon 8 Gen 2, Front Camera: 32MP, Rear Camera :50MP + 13MP + 8MP, RAM: 16GB, Storage: 512GB, Battery Capacity: 6000mAh, \r\nOS: Android 13', 63450.00, 60999.00, 0.00, 50, 0, 'asus.avif', 'mobile', 0, '2023-05-01 17:15:30'),
(32, 'Apple ', 'Apple iPhone 14 Pro Max ', 'The iPhone 14 Pro Max redefines what a smartphone can be. The gorgeous 6.7 inches 460ppi Super Retina always-on display is fitted with the new Dynamic Island Notch.', 'Capture incredible detail with a 48MP Main camera, Experience iPhone in a whole new way with Dynamic Island and Always-On display, 6.7 inches Super Retina XDR display: featuring Always-On and ProMotion,Dynamic Island: a magical new way to interact with iPhone,48MP Main camera: for up to 4x greater resolution,Cinematic mode: now in 4K Dolby Vision up to 30 fps,\r\nAction mode: for smooth, steady, hand-held videos, A vital safety feature: Crash Detection, System: iOS 16,Processor: A16 Bionic chip & 6-core CPU with 2 performance and 4 efficiency cores, 5-core GPU, 16-core Neural Engine\r\nMemory: Internal: 128GB / 256GB / 512GB / 1TB (See Version Above)', 115890.00, 110890.00, 115890.00, 45, 5, 'iphone14.jpg', 'mobile', 0, '2023-05-01 17:26:31'),
(33, 'LG ', 'LG G6 - Ice Platinum', 'FullVision display with narrow bezel in premium metal and glass body elevates LG G6 into the next generation of smartphone design.', 'Full Vision Display, Dual Wide Angle Camera, Square Camera ,IP68 Water & Dust Resistant, Qualcomm Snapdragon,Display: FullVision 5.7” Quad HD+ (1440x2880), 18:9 ratio, screen to body ratio: 80.7%, HDR10 & Dolby Vision™, Size: 148.9 x 71.9 x 7.9 mm, Memory	4GB RAM / 64GB eMMC / micro SD slot (up to 2TB), Battery: 3,300mAh (embedded) / Qualcomm® Quick Charge 3.0', 13036.00, 11036.00, 0.00, 50, 0, 'lg.avif', 'mobile', 0, '2023-05-01 17:37:43'),
(34, 'Samsung', 'Olixar Tempered Glass Screen Protector - For Samsung Galaxy A14', 'This ultra-thin tempered glass screen protector for the Samsung Galaxy A14 4G and 5G from Olixar offers toughness, high visibility, & sensitivity all in one package. Keep your device well-protected from drops, bumps, & scratches with Olixar!', 'High-tension 9H tempered glass for enhanced shock protection, Ultra clear protector with a 95% light penetration ratio, 0.26mm thickness, Compatible with the Samsung Galaxy A14\'s in-screen fingerprint reader, Easy installation with no risk of bubbles, Compatible with both Samsung Galaxy A14 4G and 5G variants', 500.00, 450.00, 0.00, 100, 0, 'tempered.jpg', 'mobile', 0, '2023-05-01 17:42:08'),
(35, 'Android HTC ', 'Android HTC Desire 820', 'Android HTC Desire 820 5.5\" Touchscreen 4G LTE 2gb Ram 16gb Rom 13.0mp Cellphone. Phone need google bypass. I dont have the time to fix it. Good buy if you can fix it. Uses usb type b charger which doesnt come with phone. Crack on screen, only visible when phone is off. ', 'Condition: Used, Memory Card Type: MicroSD, Storage Capacity: 16GB, Camera Resolution: 13.0MP, RAM: 2GB, Features: Bluetooth Enabled / GPS /  Touch Screen / Wi-Fi Capable / 3G Data Capable / 4G Data Capable', 2999.00, 1999.00, 0.00, 5, 0, '1233.jpg', 'mobile', 0, '2023-05-01 17:47:55'),
(36, 'Nokia ', 'Nokia C12 Pro', 'Nokia C12 Pro mobile was launched on 21st March 2023. The phone comes with a 60 Hz refresh rate 6.30-inch touchscreen display (HD+).', 'Display:6.30-inch, Processor: Unisoc SC9863A, Front Camera: 5MP, Rear Camera: 8MP, RAM: 2GB, Storage: 64GB, OS: Android 12 (Go Edition)', 2500.00, 1999.00, 0.00, 40, 0, '32131.avif', 'mobile', 0, '2023-05-01 17:59:31'),
(37, 'Samsung', '50\" Crystal UHD 4K AU7002 Smart TV', 'Real 4K Resolution: 4x higher than Full HD · Upscale FHD content to 4K Picture Quality · Cinematic surround sound experience with Q-Symphony', 'Get your new Samsung product delivered to your door with our free delivery in selected areas nationwide, Real 4K Resolution: 4x Higher than Full HD, Upscale FHD Content to 4K Picture Quality, Cinematic surround sound experience with Q-Symphony\r\n3-side Bezel Less Design', 45999.00, 39999.00, 0.00, 200, 0, 'tv.avif', 'television', 0, '2023-05-01 18:06:21'),
(38, 'ACE', 'ACE 32\" SMART LED TV DN2', 'ACE 32\" SMART LED TV DN2 - 808 HD Glass Frameless Flat screen Yotube Television Slim Wifi Screen Mirroring Cast', 'Display Size :32 inches, TV ResolutionHD : 720p, TV Features: Netflix / Wireless Connectivity / Web Browser / Mobile Screen Mirroring / Youtube, Model: LED-808 Glass-DN2', 5599.00, 5000.00, 5599.00, 49, 1, 'tv1.webp', 'television', 0, '2023-05-01 18:12:39'),
(39, 'JMS ', 'JMS 22 Inch Full HD LED TV+', 'JMS 22 Inch Full HD LED TV+ Smart tv box & Free Wall Bracket LED-2468S', 'Brand: JMS, Warranty Duration: 12 Months,Warranty Type:Supplier Warranty, TV Screen Size: 33 Inches, TV Screen Type: LCD/ LED, TV Type: Digital TV/  Smart TV, Smart TV: Yes, Smart TV OS: Android OS\r\n', 4599.45, 3903.45, 0.00, 100, 100, 'tv312.jpg', 'television', 0, '2023-05-01 18:20:34'),
(40, 'GELL', 'GELL smart tv 55', 'GELL smart tv 55 inches/43inches/50inches/32inches on sale tv flat screen tv plus remote android tv', 'TV INCH: 32 inch,Screen ratio: 16:9, Screen resolution: 1366(H)×768(V), Viewing angle: 178°\r\nBrightness: 250cd/m2, Contrast ratio: 1900/3/23 8:01:00, Response time: 4ms, Network cable port (RJ45): one set, Composite video (CVBS) port: one set, Computer video input (VGA) port: one set, Computer audio input (PC　AUDIO) port: one set, High-definition video input (HDMI) port: one set, Analog signal input (RF) port: one set, Audio output (EARPHONE OUT) port: one set, Multimedia (USB.2.0) port: one set, Speaker power: 10W×2, Input voltage: AC: 100～240V 50/60Hz, Backlight parameters: 85V / 360ma*2, Operating environment: Relative humidity ≤80% /  Storage humidity -10～60℃ /  Operating humidity 0～40℃', 6999.00, 5199.00, 13998.00, 58, 2, 'tv23.webp', 'television', 0, '2023-05-01 18:26:09'),
(41, 'Xiaomi Mi', 'Xiaomi Mi TV ', 'Xiaomi Mi TV P1 32\" 32iches Pseries Android TV with Built in chromecast|60Hz W/ FREE CHARGING CABLE', 'Warranty Duration: 12 Months,  Warranty Type: Manufacturer Warranty, TV Screen Size: < 33 Inches, TV Screen Type: Others, Smart TV: Yes, Smart TV OS: Android OS, Resolution: 1,366 x 768', 8999.00, 7999.00, 0.00, 70, 0, 'tv131.jpg', 'television', 0, '2023-05-01 18:29:33'),
(42, 'ACE', 'Grip-Rite 0.02 in. D Black Annealed Steel 16 Ga. Tie Wire', 'Grip-Rite is preferred by professionals nationwide and is the brand you turn to when you need to get a job done right. Whether that job is residential or commercial, spanning days or months, we know reputations are built on quality, value and trust.', 'Brand Name: Grip-Rite, Product Type: Tie Wire, Brand Name: Grip-Rite, Coated: Yes, Diameter: 0.02 inch, Finish: Black Annealed, Gauge: 16 Gauge, Material: Steel, Stranded or Solid: Solid', 680.00, 599.00, 0.00, 600, 0, 'q.jpg', 'hardware', 0, '2023-05-01 18:33:33'),
(43, 'ACE', 'Master Lock Python ', 'Master Lock Python 5/16 in. D X 72 in. L Vinyl Coated Steel Adjustable Locking Cable', 'Brand Name: Master Lock, Sub Brand: Python, Product Type: Adjustable Locking Cable, Brand Name: Master Lock, Color: GRAY, Diameter: 5/16 inch, Length: 72 inch, Loop Size: 5/16 inch\r\nMaterial: Steel, Sub Brand: Python, Vinyl Coated: Yes', 2599.00, 1999.00, 0.00, 100, 0, 'ewq.jpg', 'hardware', 0, '2023-05-01 18:36:19'),
(44, 'Racor', 'Racor 7.87 in. L Rubber Coated', 'Racor 7.87 in. L Rubber Coated Black/Orange Steel Ladder Hook 30 lb. cap. 1 pk', 'Product Type: Hook, Brand Name: Racor, Color: Black/Orange, Finish: Rubber Coated, Hardware included: Yes, Installation Type: Screw-In, Length: 7.87 inch, Material: Steel, Number in Package: 1 pack, Packaging Type: Pack, Projection: 7-1/4 inch, Self Adhesive: No', 1299.00, 999.00, 0.00, 500, 0, 'eewq.jpg', 'hardware', 0, '2023-05-01 18:39:48'),
(45, 'STANLEY', 'Stanley 2000W Heat Gun STEL670', 'For over 170 years, STANLEY® has developed and delivered hand tools that have helped to build this great nation of ours. ', '2 speed heat gun with variable heat control giving maximum control in all heat gun applications, Both hands can be free for soldering or bending operations, Ergonomic handle design for comfortable use even over extended periods of time, Lock-on switch for continuous use applications, Standing facility allows using both hands for soldering or bending operations, Variable heat setting for material appropriate working and a large variety of applications', 4599.00, 3999.00, 0.00, 60, 0, 'www.webp', 'hardware', 0, '2023-05-01 18:43:02'),
(47, 'Tactix Digital', 'Tactix Digital Multimeter ME403001', 'Tactix Digital Multimeter ME403001', 'Continuity tester with buzzer,Measures characteristics of electric signal,Diode test DC voltage: 200mV / 2V / 20V / 200V / 600V', 1099.80, 879.80, 0.00, 200, 0, 'ewqq.webp', 'hardware', 0, '2023-05-01 18:46:24'),
(48, 'Arduino Uno', 'Arduino Uno - R3', 'The Arduino Uno is a microcontroller board based on the Atmel\'s ATmega328 ', 'A Mini MP3 Player Speaker, DFPlayer module support to to 3WSD card, 2GB ~ 32GB formatted with FAT or FAT32MP3 / WAV', 884.82, 599.88, 0.00, 100, 0, 'arduino1.webp', 'electronic', 0, '2023-05-01 18:58:27'),
(49, '	 Panasonic', 'SERVOMOTOR 3000 RPM 200VAC', 'SERVOMOTOR 3000 RPM 200VAC', 'Manufacturer: Panasonic, Lead / RoHS Status: Lead free / RoHS Compliant,Weight: 6.8 lbs (3.1kg), Voltage - Rated: 200VAC, Type: AC Motor,Torque - Rated (oz-in / mNm): 339.87 / 2400, Termination Style: Connector, Size / Dimension, Square – 3.150\" x 3.150\" (80.00mm x 80.00mm), Series: MINAS A5,RPM: 3000 RPM, Power - Rated	: 750W, Operating Temperature: 0°C ~ 40°C, Mounting Hole Spacing: 3.543\" (90.00mm)\r\n\r\n', 1299.00, 999.00, 1299.00, 5547, 1, 'qeew.jpg', 'electronic', 0, '2023-05-01 19:03:49'),
(50, 'No Brand', 'JAVA (for beginners guide)', 'Introduction to Java Programming l Pomperada l 2018', '\r\nClassification: Computer, Language: English, Type of Copy: Physical Copy, Preferences: Local, Category: Textbook, Subject: Computer, Level: College', 699.00, 499.00, 0.00, 100, 0, 'img1.jpg', 'software', 0, '2023-05-01 19:07:46'),
(51, 'No Brand', 'C Programming Language', 'Fundamentals in Programming Using C Language l College l 2011 l Niguidila', 'The authors present the complete guide to ANSI standard C language programming. Written by the developers of C, this new version helps readers keep up with the finalized ANSI standard for C while showing how to take advantage of C\'s rich set of operators,', 1999.00, 999.00, 0.00, 200, 0, 'img2.jpg', 'software', 0, '2023-05-01 19:10:11'),
(52, 'No Brand', 'C# Programming Language', 'Understanding Programming for Beginners Using C#', 'The book in your hands is a different kind of programming book. Like an entertaining video game, programming is an often challenging but always rewarding experience. ', 1299.00, 999.00, 0.00, 300, 0, 'img3.jpg', 'software', 0, '2023-05-01 19:11:52'),
(53, 'No Brand', 'Javascript Programming Language', 'Understanding Programming for Beginners Using Javascript', 'This book is written for beginners to JavaScript, but also very useful for experienced developers who want to sharpen their skills. It has all the core fundamentals of JavaScript and some advanced concepts such as constructors and prototypes.', 500.00, 399.00, 0.00, 150, 0, 'img4.jpg', 'software', 0, '2023-05-01 19:13:13'),
(54, 'No Brand', 'Python (for beginners guide)', 'Understanding Programming for Beginners Using Python', 'The book is designed to be a practical and straightforward tutorial of essential Python Programming concepts and techniques that will transform self-learners from beginners to experts. It provides useful and practical examples of the programming concepts presented and makes learning an enjoyable and interesting experience. ', 799.00, 699.00, 0.00, 160, 0, 'img5.jpg', 'software', 0, '2023-05-01 19:15:00'),
(58, 'tesla', 'ssd', 'jjbhbjhbhj', ' hgvv', 500.00, 1100.00, 0.00, 10, 0, 'ssd.jpg', 'hardware', 0, '2023-05-15 02:05:29'),
(59, 'tesla', 'resistor', 'dasdasd', 'asdadas', 600.00, 1200.00, 0.00, 141, 0, 'resistor.jpg', 'electronic', 0, '2023-05-15 02:29:30'),
(60, 'tesla', 'hard disk', 'asdasd', 'asdasd', 500.00, 0.00, 0.00, 100, 0, 'hard.jpg', 'hardware', 0, '2023-05-23 02:12:37'),
(61, 'test', 'test', 'asadasdasdasd', 'asdasds', 2001111.00, 99.00, 0.00, 20, 0, 'phone123.png', 'mobile', 0, '2023-05-24 21:50:56'),
(64, 'test2', 'test2', 'asdasdasd', 'asdasda', 100.00, 99.00, 0.00, 20, 0, 'test2.avif', 'mobile', 0, '2023-05-24 23:03:23');
=======
(20, 'tesla', 'computer', 'asdada', 'sdad', '200.00', '11999.99', '0.00', 20, 0, 'computer.jpg', 'computer', 0, '2023-05-01 15:20:52'),
(21, 'Propermac', 'Work PC Bundle ', 'Refurbished Pc with the upgraded drive to  Solid State Drive – up to 10 times quicker than with a standard HDD, the system will start in seconds. Cleaned and resprayed if needed.', 'Intel i7 Quad Core 3.4 GHz i7-4770,  Integrated with CPU Intel HD 4600, 960GB SSD, 16GB RAM DDR3,\r\n2×24″ Full HD Monitor (brand and model depending on the stock – pictures for illustration purposes only),\r\nDVD RW, WiFi, Power cable, keyboard and mouse,Genuine Windows digitally activated,Windows 10 Home 64 bit', '25981.57', '22999.85', '0.00', 10, 0, 'computer-set2.webp', 'computer', 0, '2023-05-01 15:32:56'),
(22, 'Lenovo', 'Lenovo ThinkPad P16s G1 21BT001PUS 16', 'Touchscreen · Windows OS · Quad Core · With Backlit Keyboard · USB-C · HDMI · Ethernet · 3.5-mm Jack · 1920 x 1200 · Intel CPU', 'Intel Core i7 3.40 GHz processor provides lightning fast speed and peak performance for the toughest of tasks and games,\r\nWith 16 GB of memory, runs as many programs as you want without losing the execution,\r\n16\" display with 1920 x 1200 resolution showcases movies, games and photos with impressive clarity,\r\n512 GB SSD is enough to store your essential documents and files, favorite songs, movies and pictures,\r\nNVIDIA QN20-M1-R 6 GB discrete graphic card provides excellent ability in a variety of multimedia applications and user experiences', '110870.21', '100870.21', '110870.00', 19, 251, 'laptop.webp', 'computer', 0, '2023-05-01 16:14:03'),
(23, 'Collinx Computer Technology', 'System Unit Intel I7 10th Gen Processor', 'Collinx Computer Technology offers high-tech, brand-new, and complete computer products at an affordable price. It also specializes in the repair and customized cool computer builds.', ' Processor:  Intel i7 10700 (10th Gen)\r\nIntel Core i7 10700 Core i7 10700 - desktop processor produced by Intel for socket BGA-1200 that has 8 cores and 16 threads, Motherboard: Msi / Asus / Gigabyte/ Colorful H410M (LGA1200), LGA1150 socket for Intel® 4th Generation Core™i7/ Core™i5/Core™i3 Processors, Dual-Channel DDR3 1333 / 1600 support, SATA 3Gb/s, GPU: Intel HD Graphics 630, RAM: 8GB DDR4 RAM, SSD: 240GB 2.5\" SATA SSD (10x Faster than Hard Disk), Case: Darkflash dk150  ATX, Fans: 4  FANS,PSU: 650w True rated 80+ PSU, gtx1050ti galax df ', '45160.00', '41160.00', '270960.00', -6, 117, 'systemUnit.jpg', 'computer', 0, '2023-05-01 16:24:36'),
(24, '‎HP', 'HP ZBook Fury G9 16\" Mobile Workstation ', 'Tackle your most intense workflows with the ZBook Fury-now offering a desktop CPU in a laptop. With integrated or discrete graphics, a stunning display and collaboration features you can edit 8K videos, render in 3D or train machine learning models. Experience extreme pro performance-all on the move.\r\n\r\n', 'With 64 GB DDR5 SDRAM of memory, users can run many programs without losing execution, 16\" display with 1920 x 1200 resolution showcases movies, games and photos with impressive clarity, 1 TB SSD for spacious storage with much faster data transfer speed than standard hard drives, NVIDIA RTX A5000 16 GB discrete graphic card provides excellent ability in a variety of multimedia applications and user experiences', '233078.31', '213078.31', '233078.00', 24, 116, 'laptop1.webp', 'computer', 0, '2023-05-01 16:28:02'),
(25, 'Asus', 'Asus Ga503qmbs94q ROG Zephyrus G15 15.6\" QHD Laptop - AMD Ryzen 9 -', 'Power meets portability in the versatile ROG Zephyrus G15, which puts premium gaming in an ultra-slim 1.9kg chassis. Performance is fast and smooth with a powerful CPU and advanced GPU. The WQHD gaming panel balances speed with rich detail to draw you deep into the action.', 'ROG Zephyrus G15 , Game & create & and beyond, Blaze through gaming.', '88696.06', '85696.06', '0.00', 5, 0, 'laptop2.webp', 'computer', 0, '2023-05-01 16:31:42'),
(26, 'MSI', 'MSI All-in-One Computer PRO', 'MSI All-in-One Computer PRO 22XT 10M-459US Intel Core i3 10th Gen 10100 (3.60GHz) 8GB DDR4 256 GB M.2 NVMe SSD 21.5\" Touchscreen Windows 11 Home 64-bit', 'Intel Core i3 10th Gen 10100 (3.60GHz), 8GB DDR4 256 GB M.2 NVMe SSD, 21.5\" Touchscreen 1920 x 1080, Windows 11 Home 64-bit, Intel UHD Graphics 630', '52986.87', '50.00', '0.00', 2, 0, 'computer.jpg', 'computer', 0, '2023-05-01 16:36:13'),
(27, 'Intel Core', 'Intel Core i3 i3-4160 Dual-Core (2 Core) 3.60 GHz Processor', 'The Intel Core i3 processor is the perfect entry point for a fast, responsive PC experience. Do not let too many open applications slow you and your PC down. Get smart performance now.\r\n\r\n', 'Intel Core i3-4160 CPU/Processor 3,60GHz Dual Core, your 1st choice for 2nd generation hardware', '699.45', '499.45', '0.00', 100, 0, 'corei3.webp', 'computer', 0, '2023-05-01 16:39:42'),
(28, 'Tecware', 'Tecware Pulse Elite Wireless Gaming Mouse', 'Tecware Pulse Elite Wireless Gaming Mouse', '2.4GHz Wireless with Dongle, 5 Fully Programmable Buttons, PixArt 3370 Sensor, Up to 19000DPI Resolution, 400 / 800 / 1600 / 3200 / 6400 / 19000 DPI, 2x Huano Switch,2x Kailh Switch,Macro Support via Software, 400mAh, Up to 50 hours Battery Life,1.6m Paracord USB-C to USB2.0 Cable Included, 125 x 63.5 x 40mm / 70g ', '2500.00', '2195.35', '0.00', 300, 0, 'mouse.jpg', 'computer', 0, '2023-05-01 17:01:20'),
(29, 'Logitech', 'Logitech G102 Gaming Mouse Black', 'Logitech G102 Gaming Mouse Black', 'LIGHTSYNC RGB lighting, 6 programmable buttons, Resolution: 200 – 8,000 DPI, Height: 116.6 mm, Width: 62.15 mm, Depth: 38.2 mm, Weight: 85 g, (mouse only), Cable Length: 2.1 m', '1495.00', '945.00', '0.00', 50, 0, 'mouse1.webp', 'computer', 0, '2023-05-01 17:04:26'),
(30, 'Samsung', 'Samsung Galaxy S22 ', 'Samsung Galaxy S22 cellphone sale 12GB + 512GB original phone mobile phone 5G smartphone COD', 'Model No.Galaxy S22 Ultra+, Platform MTK6889, Standby Dual sim dual standby(Dual SIM+Dedicated micro SD Card Slot), Screen 6.8 HD+ Full Display 1440*3200, Speaker 1511 Box Speaker, FrequencyGSM85090018001900MHz,3GWCDMA85019002100MHz，4G LTE 5G\r\n,Vibration Support, Memory 12/16GB RAM + /256GB/512GB ROM\r\n,Multi Media MP3 MP4 3GPFM RadioBluetooth, Camera 24MP+58MP, 11.Battery 6800 mAh Lithium-ion battery', '3399.00', '2999.00', '16995.00', 25, 5, 'cp.jpg', 'mobile', 0, '2023-05-01 17:10:53'),
(31, 'Asus', 'Asus ROG Phone 7 Ultimate', 'Asus ROG Phone 7 Ultimate mobile was launched on 13th April 2023. The phone comes with a 165 Hz refresh rate 6.78-inch touchscreen display offering a resolution of 2448x1080 pixels (FHD+) at a pixel density of 395 pixels per inch (ppi).', 'Display: 6.78-inch (2448x1080), Processor: Snapdragon 8 Gen 2, Front Camera: 32MP, Rear Camera :50MP + 13MP + 8MP, RAM: 16GB, Storage: 512GB, Battery Capacity: 6000mAh, \r\nOS: Android 13', '63450.00', '60999.00', '0.00', 50, 0, 'asus.avif', 'mobile', 0, '2023-05-01 17:15:30'),
(32, 'Apple ', 'Apple iPhone 14 Pro Max ', 'The iPhone 14 Pro Max redefines what a smartphone can be. The gorgeous 6.7 inches 460ppi Super Retina always-on display is fitted with the new Dynamic Island Notch.', 'Capture incredible detail with a 48MP Main camera, Experience iPhone in a whole new way with Dynamic Island and Always-On display, 6.7 inches Super Retina XDR display: featuring Always-On and ProMotion,Dynamic Island: a magical new way to interact with iPhone,48MP Main camera: for up to 4x greater resolution,Cinematic mode: now in 4K Dolby Vision up to 30 fps,\r\nAction mode: for smooth, steady, hand-held videos, A vital safety feature: Crash Detection, System: iOS 16,Processor: A16 Bionic chip & 6-core CPU with 2 performance and 4 efficiency cores, 5-core GPU, 16-core Neural Engine\r\nMemory: Internal: 128GB / 256GB / 512GB / 1TB (See Version Above)', '115890.00', '110890.00', '115890.00', 45, 5, 'iphone14.jpg', 'mobile', 0, '2023-05-01 17:26:31'),
(33, 'LG ', 'LG G6 - Ice Platinum', 'FullVision display with narrow bezel in premium metal and glass body elevates LG G6 into the next generation of smartphone design.', 'Full Vision Display, Dual Wide Angle Camera, Square Camera ,IP68 Water & Dust Resistant, Qualcomm Snapdragon,Display: FullVision 5.7” Quad HD+ (1440x2880), 18:9 ratio, screen to body ratio: 80.7%, HDR10 & Dolby Vision™, Size: 148.9 x 71.9 x 7.9 mm, Memory	4GB RAM / 64GB eMMC / micro SD slot (up to 2TB), Battery: 3,300mAh (embedded) / Qualcomm® Quick Charge 3.0', '13036.00', '11036.00', '0.00', 50, 0, 'lg.avif', 'mobile', 0, '2023-05-01 17:37:43'),
(34, 'Samsung', 'Olixar Tempered Glass Screen Protector - For Samsung Galaxy A14', 'This ultra-thin tempered glass screen protector for the Samsung Galaxy A14 4G and 5G from Olixar offers toughness, high visibility, & sensitivity all in one package. Keep your device well-protected from drops, bumps, & scratches with Olixar!', 'High-tension 9H tempered glass for enhanced shock protection, Ultra clear protector with a 95% light penetration ratio, 0.26mm thickness, Compatible with the Samsung Galaxy A14\'s in-screen fingerprint reader, Easy installation with no risk of bubbles, Compatible with both Samsung Galaxy A14 4G and 5G variants', '500.00', '450.00', '0.00', 100, 0, 'tempered.jpg', 'mobile', 0, '2023-05-01 17:42:08'),
(35, 'Android HTC ', 'Android HTC Desire 820', 'Android HTC Desire 820 5.5\" Touchscreen 4G LTE 2gb Ram 16gb Rom 13.0mp Cellphone. Phone need google bypass. I dont have the time to fix it. Good buy if you can fix it. Uses usb type b charger which doesnt come with phone. Crack on screen, only visible when phone is off. ', 'Condition: Used, Memory Card Type: MicroSD, Storage Capacity: 16GB, Camera Resolution: 13.0MP, RAM: 2GB, Features: Bluetooth Enabled / GPS /  Touch Screen / Wi-Fi Capable / 3G Data Capable / 4G Data Capable', '2999.00', '1999.00', '0.00', 5, 0, '1233.jpg', 'mobile', 0, '2023-05-01 17:47:55'),
(36, 'Nokia ', 'Nokia C12 Pro', 'Nokia C12 Pro mobile was launched on 21st March 2023. The phone comes with a 60 Hz refresh rate 6.30-inch touchscreen display (HD+).', 'Display:6.30-inch, Processor: Unisoc SC9863A, Front Camera: 5MP, Rear Camera: 8MP, RAM: 2GB, Storage: 64GB, OS: Android 12 (Go Edition)', '2500.00', '1999.00', '0.00', 40, 0, '32131.avif', 'mobile', 0, '2023-05-01 17:59:31'),
(37, 'Samsung', '50\" Crystal UHD 4K AU7002 Smart TV', 'Real 4K Resolution: 4x higher than Full HD · Upscale FHD content to 4K Picture Quality · Cinematic surround sound experience with Q-Symphony', 'Get your new Samsung product delivered to your door with our free delivery in selected areas nationwide, Real 4K Resolution: 4x Higher than Full HD, Upscale FHD Content to 4K Picture Quality, Cinematic surround sound experience with Q-Symphony\r\n3-side Bezel Less Design', '45999.00', '39999.00', '0.00', 200, 0, 'tv.avif', 'television', 0, '2023-05-01 18:06:21'),
(38, 'ACE', 'ACE 32\" SMART LED TV DN2', 'ACE 32\" SMART LED TV DN2 - 808 HD Glass Frameless Flat screen Yotube Television Slim Wifi Screen Mirroring Cast', 'Display Size :32 inches, TV ResolutionHD : 720p, TV Features: Netflix / Wireless Connectivity / Web Browser / Mobile Screen Mirroring / Youtube, Model: LED-808 Glass-DN2', '5599.00', '5000.00', '5599.00', 49, 1, 'tv1.webp', 'television', 0, '2023-05-01 18:12:39'),
(39, 'JMS ', 'JMS 22 Inch Full HD LED TV+', 'JMS 22 Inch Full HD LED TV+ Smart tv box & Free Wall Bracket LED-2468S', 'Brand: JMS, Warranty Duration: 12 Months,Warranty Type:Supplier Warranty, TV Screen Size: 33 Inches, TV Screen Type: LCD/ LED, TV Type: Digital TV/  Smart TV, Smart TV: Yes, Smart TV OS: Android OS\r\n', '4599.45', '3903.45', '4599.00', 98, 102, 'tv312.jpg', 'television', 0, '2023-05-01 18:20:34'),
(40, 'GELL', 'GELL smart tv 55', 'GELL smart tv 55 inches/43inches/50inches/32inches on sale tv flat screen tv plus remote android tv', 'TV INCH: 32 inch,Screen ratio: 16:9, Screen resolution: 1366(H)×768(V), Viewing angle: 178°\r\nBrightness: 250cd/m2, Contrast ratio: 1900/3/23 8:01:00, Response time: 4ms, Network cable port (RJ45): one set, Composite video (CVBS) port: one set, Computer video input (VGA) port: one set, Computer audio input (PC　AUDIO) port: one set, High-definition video input (HDMI) port: one set, Analog signal input (RF) port: one set, Audio output (EARPHONE OUT) port: one set, Multimedia (USB.2.0) port: one set, Speaker power: 10W×2, Input voltage: AC: 100～240V 50/60Hz, Backlight parameters: 85V / 360ma*2, Operating environment: Relative humidity ≤80% /  Storage humidity -10～60℃ /  Operating humidity 0～40℃', '6999.00', '5199.00', '13998.00', 58, 2, 'tv23.webp', 'television', 0, '2023-05-01 18:26:09'),
(41, 'Xiaomi Mi', 'Xiaomi Mi TV ', 'Xiaomi Mi TV P1 32\" 32iches Pseries Android TV with Built in chromecast|60Hz W/ FREE CHARGING CABLE', 'Warranty Duration: 12 Months,  Warranty Type: Manufacturer Warranty, TV Screen Size: < 33 Inches, TV Screen Type: Others, Smart TV: Yes, Smart TV OS: Android OS, Resolution: 1,366 x 768', '8999.00', '7999.00', '0.00', 70, 0, 'tv131.jpg', 'television', 0, '2023-05-01 18:29:33'),
(42, 'ACE', 'Grip-Rite 0.02 in. D Black Annealed Steel 16 Ga. Tie Wire', 'Grip-Rite is preferred by professionals nationwide and is the brand you turn to when you need to get a job done right. Whether that job is residential or commercial, spanning days or months, we know reputations are built on quality, value and trust.', 'Brand Name: Grip-Rite, Product Type: Tie Wire, Brand Name: Grip-Rite, Coated: Yes, Diameter: 0.02 inch, Finish: Black Annealed, Gauge: 16 Gauge, Material: Steel, Stranded or Solid: Solid', '680.00', '599.00', '0.00', 600, 0, 'q.jpg', 'hardware', 0, '2023-05-01 18:33:33'),
(43, 'ACE', 'Master Lock Python ', 'Master Lock Python 5/16 in. D X 72 in. L Vinyl Coated Steel Adjustable Locking Cable', 'Brand Name: Master Lock, Sub Brand: Python, Product Type: Adjustable Locking Cable, Brand Name: Master Lock, Color: GRAY, Diameter: 5/16 inch, Length: 72 inch, Loop Size: 5/16 inch\r\nMaterial: Steel, Sub Brand: Python, Vinyl Coated: Yes', '2599.00', '1999.00', '0.00', 100, 0, 'ewq.jpg', 'hardware', 0, '2023-05-01 18:36:19'),
(44, 'Racor', 'Racor 7.87 in. L Rubber Coated', 'Racor 7.87 in. L Rubber Coated Black/Orange Steel Ladder Hook 30 lb. cap. 1 pk', 'Product Type: Hook, Brand Name: Racor, Color: Black/Orange, Finish: Rubber Coated, Hardware included: Yes, Installation Type: Screw-In, Length: 7.87 inch, Material: Steel, Number in Package: 1 pack, Packaging Type: Pack, Projection: 7-1/4 inch, Self Adhesive: No', '1299.00', '999.00', '0.00', 500, 0, 'eewq.jpg', 'hardware', 0, '2023-05-01 18:39:48'),
(45, 'STANLEY', 'Stanley 2000W Heat Gun STEL670', 'For over 170 years, STANLEY® has developed and delivered hand tools that have helped to build this great nation of ours. ', '2 speed heat gun with variable heat control giving maximum control in all heat gun applications, Both hands can be free for soldering or bending operations, Ergonomic handle design for comfortable use even over extended periods of time, Lock-on switch for continuous use applications, Standing facility allows using both hands for soldering or bending operations, Variable heat setting for material appropriate working and a large variety of applications', '4599.00', '3999.00', '0.00', 60, 0, 'www.webp', 'hardware', 0, '2023-05-01 18:43:02'),
(47, 'Tactix Digital', 'Tactix Digital Multimeter ME403001', 'Tactix Digital Multimeter ME403001', 'Continuity tester with buzzer,Measures characteristics of electric signal,Diode test DC voltage: 200mV / 2V / 20V / 200V / 600V', '1099.80', '879.80', '0.00', 200, 0, 'ewqq.webp', 'hardware', 0, '2023-05-01 18:46:24'),
(48, 'Arduino Uno', 'Arduino Uno - R3', 'The Arduino Uno is a microcontroller board based on the Atmel\'s ATmega328 ', 'A Mini MP3 Player Speaker, DFPlayer module support to to 3WSD card, 2GB ~ 32GB formatted with FAT or FAT32MP3 / WAV', '884.82', '599.88', '0.00', 100, 0, 'arduino1.webp', 'electronic', 0, '2023-05-01 18:58:27'),
(49, '	 Panasonic', 'SERVOMOTOR 3000 RPM 200VAC', 'SERVOMOTOR 3000 RPM 200VAC', 'Manufacturer: Panasonic, Lead / RoHS Status: Lead free / RoHS Compliant,Weight: 6.8 lbs (3.1kg), Voltage - Rated: 200VAC, Type: AC Motor,Torque - Rated (oz-in / mNm): 339.87 / 2400, Termination Style: Connector, Size / Dimension, Square – 3.150\" x 3.150\" (80.00mm x 80.00mm), Series: MINAS A5,RPM: 3000 RPM, Power - Rated	: 750W, Operating Temperature: 0°C ~ 40°C, Mounting Hole Spacing: 3.543\" (90.00mm)\r\n\r\n', '1299.00', '999.00', '1299.00', 5547, 1, 'qeew.jpg', 'electronic', 0, '2023-05-01 19:03:49'),
(50, 'No Brand', 'JAVA (for beginners guide)', 'Introduction to Java Programming l Pomperada l 2018', '\r\nClassification: Computer, Language: English, Type of Copy: Physical Copy, Preferences: Local, Category: Textbook, Subject: Computer, Level: College', '699.00', '499.00', '0.00', 100, 0, 'img1.jpg', 'software', 0, '2023-05-01 19:07:46'),
(51, 'No Brand', 'C Programming Language', 'Fundamentals in Programming Using C Language l College l 2011 l Niguidila', 'The authors present the complete guide to ANSI standard C language programming. Written by the developers of C, this new version helps readers keep up with the finalized ANSI standard for C while showing how to take advantage of C\'s rich set of operators,', '1999.00', '999.00', '0.00', 200, 0, 'img2.jpg', 'software', 0, '2023-05-01 19:10:11'),
(52, 'No Brand', 'C# Programming Language', 'Understanding Programming for Beginners Using C#', 'The book in your hands is a different kind of programming book. Like an entertaining video game, programming is an often challenging but always rewarding experience. ', '1299.00', '999.00', '0.00', 300, 0, 'img3.jpg', 'software', 0, '2023-05-01 19:11:52'),
(53, 'No Brand', 'Javascript Programming Language', 'Understanding Programming for Beginners Using Javascript', 'This book is written for beginners to JavaScript, but also very useful for experienced developers who want to sharpen their skills. It has all the core fundamentals of JavaScript and some advanced concepts such as constructors and prototypes.', '500.00', '399.00', '0.00', 150, 0, 'img4.jpg', 'software', 0, '2023-05-01 19:13:13'),
(54, 'No Brand', 'Python (for beginners guide)', 'Understanding Programming for Beginners Using Python', 'The book is designed to be a practical and straightforward tutorial of essential Python Programming concepts and techniques that will transform self-learners from beginners to experts. It provides useful and practical examples of the programming concepts presented and makes learning an enjoyable and interesting experience. ', '799.00', '699.00', '0.00', 160, 0, 'img5.jpg', 'software', 0, '2023-05-01 19:15:00'),
(58, 'tesla', 'ssd', 'jjbhbjhbhj', ' hgvv', '500.00', '1100.00', '0.00', 10, 0, 'ssd.jpg', 'hardware', 0, '2023-05-15 02:05:29'),
(60, 'tesla', 'hard disk', 'asdasd', 'asdasd', '500.00', '0.00', '0.00', 100, 0, 'hard.jpg', 'hardware', 0, '2023-05-23 02:12:37');


-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase`
--

CREATE TABLE `tbl_purchase` (
  `purchase_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` text NOT NULL,
  `date_purchased` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_purchase`
--

INSERT INTO `tbl_purchase` (`purchase_id`, `userid`, `product_id`, `quantity`, `status`, `date_purchased`) VALUES
(36, 12, 23, 1, '0', '2023-05-26 15:51:18'),
(37, 12, 24, 1, '0', '2023-05-26 15:51:30'),
(38, 12, 39, 1, 'Approve', '2023-05-26 15:51:57'),
(39, 12, 22, 1, 'Approve', '2023-05-26 15:56:18'),
(40, 12, 39, 2, 'Approve', '2023-05-26 15:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zipcode` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `images` text NOT NULL,
  `date_created` datetime NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `log_attempts` int(11) NOT NULL,
  `date_disable` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `firstname`, `lastname`, `street`, `city`, `state`, `zipcode`, `age`, `gender`, `email`, `password`, `images`, `date_created`, `role`, `status`, `log_attempts`, `date_disable`) VALUES
(7, 'admin', 'ranel', 'soliano', 'atabay', 'lapu lapu city', 'philippines', 6016, 23, 'Male', 'admin@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'test.jpg', '2023-05-04 14:13:02', 2, 1, 1, '2023-05-26 10:46:56'),
(9, 'soulyaknow', 'Ranel', 'Soliano', 'Lapu Lapu', 'Cebu', 'phil', 6016, 24, '0', 'ranel.soliano@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cpc.jpg', '2023-05-12 15:50:46', 1, 1, 1, '0000-00-00 00:00:00'),
(10, 'sweetie', 'Ranel', 'Soliano', 'Lapu Lapu', 'Cebu', 'phil', 6016, 23, '0', 'rere@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cpc.jpg', '2023-05-12 15:52:12', 1, 1, 1, '0000-00-00 00:00:00'),
(11, 'saranghae', 'Ranel', 'Soliano', 'Lapu Lapu', 'Cebu', 'phil', 6016, 23, '0', 'jenc@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cpc.jpg', '2023-05-12 15:58:38', 1, 1, 1, '0000-00-00 00:00:00'),
(12, 'ran', 'Ranel', 'Soliano', 'Lapu Lapu', 'Cebu', 'phil', 6016, 25, 'Male', 'ranel.soliano1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cpc.jpg', '2023-05-14 18:47:40', 1, 1, 1, '0000-00-00 00:00:00'),
(13, 'jenny', 'jenny', 'fier', 'test', 'canada', 'america', 1234, 28, 'Female', 'jenc5@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cpc.jpg', '2023-05-14 19:27:19', 1, 1, 5, '2023-05-23 16:42:41'),
(14, 'jenny', 'jenny', 'fier', 'test', 'canada', 'america', 0, 28, 'Female', 'jenc51@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'cpc.jpg', '2023-05-14 19:28:24', 1, 1, 1, '0000-00-00 00:00:00'),
(16, 'soulyaknow', 'lenar', 'onailos', 'atabay', 'lapu lapu', 'philippines', 6016, 25, 'Female', 'lenar123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '331106143_1364428367646657_658814879832039531_n.jpg', '2023-05-17 20:27:28', 1, 1, 1, '0000-00-00 00:00:00'),
<<<<<<< HEAD
(18, 'test', 'test', 'test', 'test', 'test', 'test', 123, 123, 'Female', 'test@123', '202cb962ac59075b964b07152d234b70', '', '2023-05-24 20:58:34', 2, 1, 0, '0000-00-00 00:00:00');
=======
(18, 'fide championship', 'f', 'f', 'f', 'f', 'f', 3, 3, 'Male', 'f@gmail.com', '2510c39011c5be704182423e3a695e91', '', '2023-05-26 10:59:48', 1, 1, 3, '2023-05-26 15:37:40'),
(19, 'd', 'd', 'd', 'd', 'd', 'd', 3, 3, 'Male', 'd@gmail.com', '8277e0910d750195b448797616e091ad', '', '2023-05-26 14:40:18', 1, 1, 0, '0000-00-00 00:00:00');
>>>>>>> a5e9e7f63822c4e7c26f433c3f5c15f52a805db2

-- --------------------------------------------------------

--
-- Table structure for table `tbl_variant`
--

CREATE TABLE `tbl_variant` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_variant` text NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_img` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

-- Dumping data for table `tbl_variant`
--

INSERT INTO `tbl_variant` (`id`, `product_id`, `product_variant`, `product_stock`, `product_img`, `date_created`) VALUES
(1, 0, 'green', 0, 'hard.jpg', '2023-05-23 02:12:38');

--

-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `tbl_variant`
--
ALTER TABLE `tbl_variant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tbl_purchase`
--
ALTER TABLE `tbl_purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
<<<<<<< HEAD
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
=======
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
>>>>>>> a5e9e7f63822c4e7c26f433c3f5c15f52a805db2

--
-- AUTO_INCREMENT for table `tbl_variant`
--
ALTER TABLE `tbl_variant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
