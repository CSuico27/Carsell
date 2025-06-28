<p align="center">
  <img src="public/assets/logo.png" width="150" alt="AutoCaller Logo">
</p>

<h1 align="center">AutoCaller</h1>

<p align="center">
  A modern Laravel-based platform where users can post cars for sale and receive direct calls from potential buyers.
</p>

<p align="center">
  <a href="https://github.com/CJcode6754/CarShop"><img src="https://img.shields.io/github/license/CJcode6754/CarShop" alt="License"></a>
  <a href="https://github.com/CJcode6754/CarShop"><img src="https://img.shields.io/github/stars/CJcode6754/CarShop" alt="GitHub Stars"></a>
  <a href="https://github.com/CJcode6754/CarShop/issues"><img src="https://img.shields.io/github/issues/CJcode6754/CarShop" alt="Issues"></a>
</p>

---

## 🚗 About AutoCaller

**AutoCaller** is a user-friendly web application built with Laravel that enables individuals and dealerships to:

- 📤 List vehicles for sale with full details and photos  
- 📞 Be contacted directly by potential buyers via phone  
- 🔍 Search listings by make, model, year, price, and more  
- 🖼️ Browse clean and responsive car listing interfaces  

Whether you're a personal seller or a car dealer, AutoCaller helps you connect with the right buyers easily.

---

## 🛠 Tech Stack

- **Backend:** Laravel (PHP)
- **Frontend:** Blade, Tailwind CSS, AlpineJS, JavaScript
- **Database:** MySQL
- **Dev Tools:** Laravel Artisan, Composer, NPM

---

## ⚙️ Installation Guide

Follow these steps to set up the project locally:

```bash
# Clone the repository
git clone https://github.com/CJcode6754/AutoCaller.git
cd autocaller


# Install PHP dependencies
composer install


# Install Node.js dependencies
npm install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Configure .env database settings, then run:
php artisan migrate

# (Optional) Seed the database with dummy data
php artisan db:seed

# Start the development server
php artisan serve

# In a new terminal, compile frontend assets
npm run dev
