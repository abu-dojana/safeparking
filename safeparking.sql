SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@mail.com', 'admin');
CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `garageId` varchar(50) NOT NULL,
  `hours` int(11) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `bookings` (`id`, `garageId`, `hours`, `totalPrice`) VALUES
(1, 'sf1238', 3, 9.00),
(2, 'sf1235', 3, 9.00),
(3, 'sf1235', 33, 1089.00);
CREATE TABLE `garage_owners` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `building_no` varchar(50) DEFAULT NULL,
  `street_no` varchar(50) DEFAULT NULL,
  `area_name` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `nid_no` varchar(50) DEFAULT NULL,
  `nid_photo_front` varchar(255) DEFAULT NULL,
  `nid_photo_back` varchar(255) DEFAULT NULL,
  `parking_space_photos` text DEFAULT NULL,
  `num_parking_spaces` int(11) DEFAULT NULL,
  `expected_rent` int(11) DEFAULT NULL,
  `security_features` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `constraints` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `garageId` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `garage_owners` (`id`, `name`, `dob`, `gender`, `email`, `phone`, `mobile`, `address`, `building_no`, `street_no`, `area_name`, `district`, `latitude`, `longitude`, `nid_no`, `nid_photo_front`, `nid_photo_back`, `parking_space_photos`, `num_parking_spaces`, `expected_rent`, `security_features`, `description`, `constraints`, `password`, `reg_date`, `garageId`) VALUES
(1, 'meow', '2024-09-03', '', 'nova@gmail.com', '57629560582752', '4534635635', '', '44', '55', 'df', 'dsg', 0, 0, '54354645', '', 'uploads/dog.jpg', 'uploads/cat.png', 4, 100, 'saggdg', 'fgdafh', 'dhshsdfh', '$2y$10$wgW2omwLBFPhWpymAw963egJSYs3XJig71qoR27qliWjsly7kLUcW', '2024-09-20 21:55:45', NULL),
(2, 'abid', '2024-09-17', 'male', 'shaikfarhan@gmail.com', '01945160268', '01945160268', '', 'eee', 'dfjf', 'fjfjf', 'fjgj', 23.7547955, 90.423732, '', '', '', '[]', 233, 333, '333', 'jnjrj', 'rkjn4rnj', '$2y$10$.SfPxPHXWIl43Etm6/qMSOV44WklMsSBY21HG4zvQbIt5szV4Df.G', '2024-09-21 12:21:48', NULL),
(3, 'abid', '2024-09-17', 'male', 'shaikfarhan@gmail.com', '01945160268', '01945160268', '', 'eee', 'dfjf', 'fjfjf', 'fjgj', 0, 0, '', '', '', '[]', 233, 333, '333', 'jnjrj', 'rkjn4rnj', '$2y$10$tmIr1BSdR9a36CrzNF2yWOqR.buL/B1rAPPaeP018FsGOcG3ZdWvK', '2024-09-21 12:22:58', NULL);
CREATE TABLE `vehicle_owners` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `licence_no` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `nid_no` varchar(50) DEFAULT NULL,
  `nid_photo_front` varchar(255) DEFAULT NULL,
  `nid_photo_back` varchar(255) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  `vehicle_model` varchar(50) DEFAULT NULL,
  `vehicle_registration` varchar(50) DEFAULT NULL,
  `vehicle_plate` varchar(50) DEFAULT NULL,
  `vehicle_chassis` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `vehicle_owners` (`id`, `name`, `dob`, `gender`, `licence_no`, `email`, `phone`, `mobile`, `address`, `nid_no`, `nid_photo_front`, `nid_photo_back`, `vehicle_type`, `vehicle_model`, `vehicle_registration`, `vehicle_plate`, `vehicle_chassis`, `description`, `password`, `reg_date`) VALUES
(1, 'Nova', '2024-09-10', 'female', '123456', 'nova@gmail.com', '567890', '4534635635', 'gga', '4647586997', 'uploads/cat.png', 'uploads/dog.jpg', 'Car', 'Honda Vezel', '34', 'dhk-23', '67', 'reey', '$2y$10$M3jvRg.qsoYbsK9O3LhvUu.9IxxOB7uQaaxj7jYJdniob9CM4A2Uu', '2024-09-20 22:08:13'),
(2, 'shaik', '2024-09-18', 'male', '12345678', 'shaikfarhanofficial@gmail.com', '01945160268', '3333', 'Taltola,Dhaka-1219.', '111', 'uploads/Untitled design.png', 'uploads/Untitled design.png', '111', '111', '111', '111', '111', '111', '$2y$10$1AHJncJul.ZcHlYFRhcpxOVS.mpggKISg52U.B5cPAwSjKNV8nNa.', '2024-09-21 15:16:17');
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `garage_owners`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `vehicle_owners`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
ALTER TABLE `garage_owners`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `vehicle_owners`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
