# FoodFusion Web Application

FoodFusion is a dynamic web application built using Pure PHP (Native PHP) and MySQL. It offers users a seamless platform to explore various culinary recipes, step-by-step cooking instructions, ingredient lists, and meal ideas.

---

## Features

### For Users
- **Vast Recipe Collection:** Explore a wide variety of recipes organized by categories.
- **Search & Filter:** Easily search for recipes by name, ingredients, or food type.
- **Detailed Cooking Instructions:** Clear step-by-step guides with ingredient measurements.
- **User Authentication:** Secure user registration and login system.
- **Saved Recipes:** Allows logged-in users to bookmark their favorite recipes.

### For Administrators
- **Admin Dashboard:** Full CRUD functionality to manage recipes, categories, and registered users.

---

## Tech Stack

- **Backend:** Pure PHP (Native PHP)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Server Environment:** XAMPP / WAMP / Apache / Local PHP Server

---

## System Requirements

- **PHP:** >= 7.4 or 8.x
- **Database:** MySQL 5.7+ or MariaDB
- **Web Server:** Apache (via XAMPP or WAMP)

---

## Installation & Setup

Follow these steps to set up and run the project locally on your machine.

### 1. Repository Setup
Clone the repository and move the project folder to your local server directory (e.g., XAMPP `htdocs` folder):

git clone https://github.com/kyawzinwindev/FoodFusionApp.git
cd FoodFusionApp

### 2. Move to Local Server Directory
If you cloned the repository elsewhere, copy the project directory to your server path:

# Example for XAMPP on Windows
C:/xampp/htdocs/FoodFusionApp

### 3. Database Setup
1. Open XAMPP Control Panel and start **Apache** and **MySQL**.
2. Open your web browser and navigate to: http://localhost/phpmyadmin
3. Create a new database named `foodfusion_db`.
4. Select the database and import the `database.sql` file located in the project root directory.

### 4. Database Connection Configuration
Open your database configuration file (e.g., `config/db.php` or `connection.php`) and update your local database credentials:

$host = "localhost";
$user = "root";
$password = "";
$dbname = "foodfusion_db";

### 5. Run the Application
Open your browser and navigate to:

http://localhost/FoodFusionApp

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the Project
2. Create your Feature Branch: git checkout -b feature/AmazingFeature
3. Commit your Changes: git commit -m 'Add some AmazingFeature'
4. Push to the Branch: git push origin feature/AmazingFeature
5. Open a Pull Request

---

## Author

**Kyaw Zin Win**
- GitHub: [@kyawzinwindev](https://github.com/kyawzinwindev)

---

## License

This project is open-sourced software licensed under the [MIT License](LICENSE).
