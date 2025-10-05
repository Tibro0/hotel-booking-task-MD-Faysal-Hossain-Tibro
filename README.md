# Hotel Booking System

A comprehensive hotel booking system built with Laravel framework featuring room management, dynamic pricing, availability tracking, and booking management.

## 🚀 Features

-   **Room Management**: Three room categories with different base prices
-   **Dynamic Pricing**: Automatic weekend surcharge (20% on Friday & Saturday)
-   **Smart Discounts**: 10% discount for 3 or more consecutive nights
-   **Availability Tracking**: Real-time room availability checking
-   **Booking Management**: Complete booking flow with confirmation
-   **Validation**: Comprehensive form validation including Bangladeshi phone numbers
-   **Responsive Design**: Bootstrap 5 powered responsive interface

## 📋 Room Categories & Pricing

| Category        | Base Price | Rooms Available |
| --------------- | ---------- | --------------- |
| Premium Deluxe  | 12,000 BDT | 3 rooms         |
| Super Deluxe    | 10,000 BDT | 3 rooms         |
| Standard Deluxe | 8,000 BDT  | 3 rooms         |

## 💰 Pricing Rules

-   **Weekend Surcharge**: +20% on Friday and Saturday
-   **Long Stay Discount**: 10% discount for 3 or more consecutive nights
-   **Price Calculation**: Daily pricing with proper weekend rules application

## 🛠️ Technologies Used

-   **Backend**: Laravel 12.x
-   **Frontend**: Bootstrap 5, Blade Templates
-   **Database**: MySQL
-   **Date Picker**: Flatpickr
-   **Validation**: Laravel Form Requests

## 📦 Installation

### Prerequisites

-   PHP 8.2 or higher
-   Composer
-   MySQL 5.7 or higher
-   Node.js (For Frontend Dependencies)

### Step-by-Step Installation

1. **Clone the repository**
    ```bash
    git clone https://github.com/Tibro0/hotel-booking-task-MD-Faysal-Hossain-Tibro.git hotel-booking-task
    cd hotel-booking-task
    composer install
    cp .env.example .env
    php artisan key:generate
    ```
2. **Edit .env file with your database credentials**

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel-booking-task
DB_USERNAME=root
DB_PASSWORD=
```

3. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

4. **Start development server**
```bash
php artisan serve
```
5. **Access the application**
Open your browser and visit: http://127.0.0.1:8000
