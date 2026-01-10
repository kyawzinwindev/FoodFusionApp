-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 10, 2026 at 01:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FoodFusionApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `community_recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `community_recipe_id`, `user_id`, `comment`, `created_at`) VALUES
(2, 6, 2, 'Hello', '2026-01-10 04:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `community_cookbook`
--

CREATE TABLE `community_cookbook` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` enum('recipe','tip','experience') NOT NULL DEFAULT 'recipe',
  `ingredients` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_cookbook`
--

INSERT INTO `community_cookbook` (`id`, `title`, `description`, `category`, `ingredients`, `content`, `image`, `user_id`, `created_at`) VALUES
(5, 'Sustainable Cooking Trends', 'A comprehensive overview of Sustainable Cooking Trends, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'experience', '', 'This is a detailed description about Sustainable Cooking Trends. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    Sustainable Cooking Trends is a fascinating topic that involves many layers of complexity. When we explore Sustainable Cooking Trends, we discover nuances that were initially overlooked. For example, the history of Sustainable Cooking Trends dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Sustainable Cooking Trends requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, Sustainable Cooking Trends has evolved. With the advent of technology and global communication, we see new variations and interpretations of Sustainable Cooking Trends emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Sustainable Cooking Trends. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/community1.jpg', 2, '2026-01-09 11:20:11'),
(6, 'The Art of Fermentation', 'A comprehensive overview of The Art of Fermentation, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'experience', '', 'This is a detailed description about The Art of Fermentation. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    The Art of Fermentation is a fascinating topic that involves many layers of complexity. When we explore The Art of Fermentation, we discover nuances that were initially overlooked. For example, the history of The Art of Fermentation dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering The Art of Fermentation requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, The Art of Fermentation has evolved. With the advent of technology and global communication, we see new variations and interpretations of The Art of Fermentation emerging every day. Whether you are a beginner or an expert, there is always something new to learn about The Art of Fermentation. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/community2.jpg', 2, '2026-01-09 11:20:11'),
(8, 'Vegan Chocolate Cake', 'A comprehensive overview of Vegan Chocolate Cake, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'recipe', 'Flour, Cocoa Powder, Sugar, Oil, Vinegar, Strawberry', 'This is a detailed description about Vegan Chocolate Cake. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    Vegan Chocolate Cake is a fascinating topic that involves many layers of complexity. When we explore Vegan Chocolate Cake, we discover nuances that were initially overlooked. For example, the history of Vegan Chocolate Cake dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Vegan Chocolate Cake requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, Vegan Chocolate Cake has evolved. With the advent of technology and global communication, we see new variations and interpretations of Vegan Chocolate Cake emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Vegan Chocolate Cake. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/1768045950_download (2).jpeg', 2, '2026-01-10 11:29:44'),
(9, 'Kitchen Safety Tips', 'A comprehensive overview of Kitchen Safety Tips, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'tip', '', 'This is a detailed description about Kitchen Safety Tips. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    Kitchen Safety Tips is a fascinating topic that involves many layers of complexity. When we explore Kitchen Safety Tips, we discover nuances that were initially overlooked. For example, the history of Kitchen Safety Tips dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Kitchen Safety Tips requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, Kitchen Safety Tips has evolved. With the advent of technology and global communication, we see new variations and interpretations of Kitchen Safety Tips emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Kitchen Safety Tips. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/1768046056_download (3).jpeg', 1, '2026-01-10 11:29:44'),
(14, 'Morning Coffee Ritual', 'A comprehensive overview of Morning Coffee Ritual, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'tip', 'Coffee beans, Water', 'This is a detailed description about Morning Coffee Ritual. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Morning Coffee Ritual is a fascinating topic that involves many layers of complexity. When we explore Morning Coffee Ritual, we discover nuances that were initially overlooked. For example, the history of Morning Coffee Ritual dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Morning Coffee Ritual requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Morning Coffee Ritual has evolved. With the advent of technology and global communication, we see new variations and interpretations of Morning Coffee Ritual emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Morning Coffee Ritual. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/1768046640_download (7).jpeg', 1, '2026-01-10 11:56:33'),
(15, 'My first Macarons', 'A comprehensive overview of My first Macarons, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'experience', '', 'This is a detailed description about My first Macarons. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    My first Macarons is a fascinating topic that involves many layers of complexity. When we explore My first Macarons, we discover nuances that were initially overlooked. For example, the history of My first Macarons dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering My first Macarons requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, My first Macarons has evolved. With the advent of technology and global communication, we see new variations and interpretations of My first Macarons emerging every day. Whether you are a beginner or an expert, there is always something new to learn about My first Macarons. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/1768046609_download (6).jpeg', 1, '2026-01-10 11:56:33'),
(16, 'Leftover Vegetable Soup', 'A comprehensive overview of Leftover Vegetable Soup, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'recipe', 'Any leftover veggies, Broth, Salt', 'This is a detailed description about Leftover Vegetable Soup. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Leftover Vegetable Soup is a fascinating topic that involves many layers of complexity. When we explore Leftover Vegetable Soup, we discover nuances that were initially overlooked. For example, the history of Leftover Vegetable Soup dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Leftover Vegetable Soup requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Leftover Vegetable Soup has evolved. With the advent of technology and global communication, we see new variations and interpretations of Leftover Vegetable Soup emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Leftover Vegetable Soup. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/1768046490_download (5).jpeg', 2, '2026-01-10 11:57:16'),
(17, 'Visiting Tokyo Fish Market', 'A comprehensive overview of Visiting Tokyo Fish Market, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'experience', '', 'This is a detailed description about Visiting Tokyo Fish Market. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Visiting Tokyo Fish Market is a fascinating topic that involves many layers of complexity. When we explore Visiting Tokyo Fish Market, we discover nuances that were initially overlooked. For example, the history of Visiting Tokyo Fish Market dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Visiting Tokyo Fish Market requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Visiting Tokyo Fish Market has evolved. With the advent of technology and global communication, we see new variations and interpretations of Visiting Tokyo Fish Market emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Visiting Tokyo Fish Market. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/community/1768046459_download (4).jpeg', 2, '2026-01-10 11:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT 'General Inquiry',
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `user_id`) VALUES
(1, 'Kyaw Gyi', 'kyawgyi@gmail.com', 'Subjecty', 'Message', '2026-01-06 19:45:18', NULL),
(2, 'JohnDoe', 'johndoe@gmail.com', 'Subject', 'Message', '2026-01-06 19:46:34', NULL),
(3, 'Kyaw Zin Win', 'kyaw@gmail.com', 'Testing the feedback function', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', '2026-01-08 16:20:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ingredients` text NOT NULL,
  `cuisine_type` varchar(100) NOT NULL,
  `dietary_preference` varchar(100) NOT NULL,
  `difficulty` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `ingredients`, `cuisine_type`, `dietary_preference`, `difficulty`, `image`, `user_id`, `created_at`) VALUES
(8, 'Spaghetti Carbonara', 'A classic Italian pasta dish made with eggs, cheese, pork, and black pepper.', 'Spaghetti, Eggs, Pecorino Romano, Guanciale, Black Pepper', 'Italian', 'Non-Vegetarian', 'Medium', 'uploads/recipes/recipe1.jpg', 2, '2026-01-09 11:14:06'),
(9, 'Chicken Tikka Masala', 'Chunks of roasted marinated chicken (chicken tikka) in a spiced curry sauce.', 'Chicken, Yogurt, Spices, Tomato Sauce, Cream', 'Indian', 'Non-Vegetarian', 'Hard', 'uploads/recipes/recipe2.jpg', 2, '2026-01-09 11:14:06'),
(10, 'Vegetable Stir Fry', 'A quick and healthy stir fry with fresh vegetables and a savory sauce.', 'Broccoli, Carrots, Bell Peppers, Soy Sauce, Ginger, Garlic', 'Chinese', 'Vegetarian', 'Easy', 'uploads/recipes/recipe3.jpg', 2, '2026-01-09 11:14:06'),
(15, 'Beef Tacos', 'Mexican street style tacos.', 'Beef, Corn Tortillas, Onion, Cilantro, Lime', 'Mexican', 'Gluten-Free', 'Medium', 'uploads/recipes/1768045848_download (1).jpeg', 2, '2026-01-10 11:23:11'),
(22, 'Classic Beef Stew', 'Hearty beef stew with carrots and potatoes.', 'Beef chuck, Carrots, Potatoes, Beef Broth, Thyme', 'American', 'Gluten-Free', 'Medium', 'uploads/1768046756_download (11).jpeg', 1, '2026-01-10 11:56:33'),
(23, 'Spicy Tuna Roll', 'Fresh tuna with spicy mayo wrapped in rice.', 'Sushi rice, Tuna, Nori, Mayo, Sriracha', 'Italian', 'None', 'Hard', 'uploads/1768046726_download (10).jpeg', 1, '2026-01-10 11:56:33'),
(24, 'Vegetable Stir Fry', 'Quick and easy veggie stir fry.', 'Broccoli, Bell Peppers, Soy Sauce, Garlic, Tofu', 'Italian', 'Vegan', 'Easy', 'uploads/recipes/1768046696_download (9).jpeg', 2, '2026-01-10 11:56:33'),
(25, 'Chicken Tikka Masala', 'Creamy tomato curry with tender chicken.', 'Chicken, Yogurt, Tomato Sauce, Indian Spices, Cream', 'Italian', 'None', 'Medium', 'uploads/recipes/1768046671_download (8).jpeg', 2, '2026-01-10 11:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `resource_type` varchar(255) NOT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `description`, `content`, `file_url`, `resource_type`, `file_type`, `user_id`, `created_at`) VALUES
(6, 'Sustainable Cooking', 'A comprehensive overview of Sustainable Cooking, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Sustainable Cooking. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    Sustainable Cooking is a fascinating topic that involves many layers of complexity. When we explore Sustainable Cooking, we discover nuances that were initially overlooked. For example, the history of Sustainable Cooking dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Sustainable Cooking requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, Sustainable Cooking has evolved. With the advent of technology and global communication, we see new variations and interpretations of Sustainable Cooking emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Sustainable Cooking. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/culinary1.jpg', 'culinary', 'image', 1, '2025-12-28 05:37:49'),
(7, 'The Art of Plating', 'A comprehensive overview of The Art of Plating, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about The Art of Plating. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    The Art of Plating is a fascinating topic that involves many layers of complexity. When we explore The Art of Plating, we discover nuances that were initially overlooked. For example, the history of The Art of Plating dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering The Art of Plating requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, The Art of Plating has evolved. With the advent of technology and global communication, we see new variations and interpretations of The Art of Plating emerging every day. Whether you are a beginner or an expert, there is always something new to learn about The Art of Plating. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1767709108_Quick Tricks to The Art of Plating Purée.mp4', 'culinary', 'video', 1, '2025-12-28 05:37:49'),
(9, 'The Science of Baking', 'A comprehensive overview of The Science of Baking, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about The Science of Baking. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    The Science of Baking is a fascinating topic that involves many layers of complexity. When we explore The Science of Baking, we discover nuances that were initially overlooked. For example, the history of The Science of Baking dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering The Science of Baking requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, The Science of Baking has evolved. With the advent of technology and global communication, we see new variations and interpretations of The Science of Baking emerging every day. Whether you are a beginner or an expert, there is always something new to learn about The Science of Baking. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/edu1.jpg', 'educational', 'image', 1, '2025-12-28 05:37:49'),
(10, 'History of Street Food', 'A comprehensive overview of History of Street Food, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about History of Street Food. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \n\n    History of Street Food is a fascinating topic that involves many layers of complexity. When we explore History of Street Food, we discover nuances that were initially overlooked. For example, the history of History of Street Food dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering History of Street Food requires patience, dedication, and a keen eye for detail.\n    \n    Furthermore, in modern times, History of Street Food has evolved. With the advent of technology and global communication, we see new variations and interpretations of History of Street Food emerging every day. Whether you are a beginner or an expert, there is always something new to learn about History of Street Food. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/edu2.jpg', 'educational', 'image', 1, '2025-12-28 05:37:49'),
(18, 'Mastering the French Omelette', 'A comprehensive overview of Mastering the French Omelette, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Mastering the French Omelette. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Mastering the French Omelette is a fascinating topic that involves many layers of complexity. When we explore Mastering the French Omelette, we discover nuances that were initially overlooked. For example, the history of Mastering the French Omelette dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Mastering the French Omelette requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Mastering the French Omelette has evolved. With the advent of technology and global communication, we see new variations and interpretations of Mastering the French Omelette emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Mastering the French Omelette. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047662_download (19).jpeg', 'culinary', 'image', 1, '2026-01-10 11:29:44'),
(19, 'Types of Chef Knives', 'A comprehensive overview of Types of Chef Knives, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Types of Chef Knives. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Types of Chef Knives is a fascinating topic that involves many layers of complexity. When we explore Types of Chef Knives, we discover nuances that were initially overlooked. For example, the history of Types of Chef Knives dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Types of Chef Knives requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Types of Chef Knives has evolved. With the advent of technology and global communication, we see new variations and interpretations of Types of Chef Knives emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Types of Chef Knives. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047617_download (18).jpeg', 'culinary', 'image', 1, '2026-01-10 11:29:44'),
(20, 'Essential Herbs Guide', 'A comprehensive overview of Essential Herbs Guide, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Essential Herbs Guide. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Essential Herbs Guide is a fascinating topic that involves many layers of complexity. When we explore Essential Herbs Guide, we discover nuances that were initially overlooked. For example, the history of Essential Herbs Guide dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Essential Herbs Guide requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Essential Herbs Guide has evolved. With the advent of technology and global communication, we see new variations and interpretations of Essential Herbs Guide emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Essential Herbs Guide. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768046852_download (12).jpeg', 'culinary', 'image', 1, '2026-01-10 11:29:44'),
(21, 'How to Debone a Chicken', 'A comprehensive overview of How to Debone a Chicken, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about How to Debone a Chicken. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    How to Debone a Chicken is a fascinating topic that involves many layers of complexity. When we explore How to Debone a Chicken, we discover nuances that were initially overlooked. For example, the history of How to Debone a Chicken dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering How to Debone a Chicken requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, How to Debone a Chicken has evolved. With the advent of technology and global communication, we see new variations and interpretations of How to Debone a Chicken emerging every day. Whether you are a beginner or an expert, there is always something new to learn about How to Debone a Chicken. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047484_download (16).jpeg', 'culinary', 'image', 1, '2026-01-10 11:29:44'),
(22, 'Baking Substitutions Chart', 'A comprehensive overview of Baking Substitutions Chart, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Baking Substitutions Chart. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Baking Substitutions Chart is a fascinating topic that involves many layers of complexity. When we explore Baking Substitutions Chart, we discover nuances that were initially overlooked. For example, the history of Baking Substitutions Chart dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Baking Substitutions Chart requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Baking Substitutions Chart has evolved. With the advent of technology and global communication, we see new variations and interpretations of Baking Substitutions Chart emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Baking Substitutions Chart. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047582_download (17).jpeg', 'culinary', 'image', 1, '2026-01-10 11:29:44'),
(23, 'The Science of Gluten', 'A comprehensive overview of The Science of Gluten, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about The Science of Gluten. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    The Science of Gluten is a fascinating topic that involves many layers of complexity. When we explore The Science of Gluten, we discover nuances that were initially overlooked. For example, the history of The Science of Gluten dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering The Science of Gluten requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, The Science of Gluten has evolved. With the advent of technology and global communication, we see new variations and interpretations of The Science of Gluten emerging every day. Whether you are a beginner or an expert, there is always something new to learn about The Science of Gluten. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047810_download (21).jpeg', 'educational', 'image', 1, '2026-01-10 11:29:44'),
(24, 'Mediterranean Diet Pyramid', 'A comprehensive overview of Mediterranean Diet Pyramid, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Mediterranean Diet Pyramid. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Mediterranean Diet Pyramid is a fascinating topic that involves many layers of complexity. When we explore Mediterranean Diet Pyramid, we discover nuances that were initially overlooked. For example, the history of Mediterranean Diet Pyramid dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Mediterranean Diet Pyramid requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Mediterranean Diet Pyramid has evolved. With the advent of technology and global communication, we see new variations and interpretations of Mediterranean Diet Pyramid emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Mediterranean Diet Pyramid. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047045_download (14).jpeg', 'educational', 'image', 1, '2026-01-10 11:29:44'),
(25, 'Global Spice Map', 'A comprehensive overview of Global Spice Map, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Global Spice Map. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Global Spice Map is a fascinating topic that involves many layers of complexity. When we explore Global Spice Map, we discover nuances that were initially overlooked. For example, the history of Global Spice Map dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Global Spice Map requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Global Spice Map has evolved. With the advent of technology and global communication, we see new variations and interpretations of Global Spice Map emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Global Spice Map. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047877_download (22).jpeg', 'educational', 'image', 1, '2026-01-10 11:29:44'),
(26, 'Farm to Table Journey', 'A comprehensive overview of Farm to Table Journey, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Farm to Table Journey. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Farm to Table Journey is a fascinating topic that involves many layers of complexity. When we explore Farm to Table Journey, we discover nuances that were initially overlooked. For example, the history of Farm to Table Journey dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Farm to Table Journey requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Farm to Table Journey has evolved. With the advent of technology and global communication, we see new variations and interpretations of Farm to Table Journey emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Farm to Table Journey. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047741_download (20).jpeg', 'educational', 'image', 1, '2026-01-10 11:29:44'),
(27, 'Vitamins and Minerals', 'A comprehensive overview of Vitamins and Minerals, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Vitamins and Minerals. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Vitamins and Minerals is a fascinating topic that involves many layers of complexity. When we explore Vitamins and Minerals, we discover nuances that were initially overlooked. For example, the history of Vitamins and Minerals dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Vitamins and Minerals requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Vitamins and Minerals has evolved. With the advent of technology and global communication, we see new variations and interpretations of Vitamins and Minerals emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Vitamins and Minerals. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047012_download (13).jpeg', 'educational', 'image', 1, '2026-01-10 11:29:44'),
(28, 'Wok Cooking Fundamentals', 'A comprehensive overview of Wok Cooking Fundamentals, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Wok Cooking Fundamentals. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Wok Cooking Fundamentals is a fascinating topic that involves many layers of complexity. When we explore Wok Cooking Fundamentals, we discover nuances that were initially overlooked. For example, the history of Wok Cooking Fundamentals dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Wok Cooking Fundamentals requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Wok Cooking Fundamentals has evolved. With the advent of technology and global communication, we see new variations and interpretations of Wok Cooking Fundamentals emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Wok Cooking Fundamentals. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047446_download (15).jpeg', 'culinary', 'image', 1, '2026-01-10 11:31:51'),
(29, 'Sugar vs. Natural Sweeteners', 'A comprehensive overview of Sugar vs. Natural Sweeteners, covering its history, modern applications, and essential tips for success. Read more to dive deep into this topic.', 'This is a detailed description about Sugar vs. Natural Sweeteners. It contains significantly more information than the previous version to ensure that the user interface can handle substantial amounts of text. \r\n\r\n    Sugar vs. Natural Sweeteners is a fascinating topic that involves many layers of complexity. When we explore Sugar vs. Natural Sweeteners, we discover nuances that were initially overlooked. For example, the history of Sugar vs. Natural Sweeteners dates back centuries, influencing cultures and traditions across the globe. Experts agree that mastering Sugar vs. Natural Sweeteners requires patience, dedication, and a keen eye for detail.\r\n    \r\n    Furthermore, in modern times, Sugar vs. Natural Sweeteners has evolved. With the advent of technology and global communication, we see new variations and interpretations of Sugar vs. Natural Sweeteners emerging every day. Whether you are a beginner or an expert, there is always something new to learn about Sugar vs. Natural Sweeteners. We hope this extended content provides the depth of knowledge you were looking for and enhances your overall experience.', 'uploads/resources/1768047992_Sugar_vs_Natural_Sweeteners.pdf', 'educational', 'pdf', 1, '2026-01-10 11:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `type` varchar(100) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `type`, `created_at`) VALUES
(1, 'Super', 'Admin', 'admin@gmail.com', '$2y$12$8vifaT7HEY0ZSXje8P6La.1HqeRce2WecxYgKFkesGFKWCW5PKCt.', 'admin', '2025-12-28 05:28:51'),
(2, 'John', 'Doe', 'johndoe@gmail.com', '$2y$10$/fFaM8HSKd1CZB7qdWttkOgcJnxSnDEo4i4VBYxG3s8fSqfMCcU/.', 'user', '2026-01-09 11:05:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `community_recipe_id` (`community_recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `community_cookbook`
--
ALTER TABLE `community_cookbook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_contact_user` (`user_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `community_cookbook`
--
ALTER TABLE `community_cookbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`community_recipe_id`) REFERENCES `community_cookbook` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `community_cookbook`
--
ALTER TABLE `community_cookbook`
  ADD CONSTRAINT `community_cookbook_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `fk_contact_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
