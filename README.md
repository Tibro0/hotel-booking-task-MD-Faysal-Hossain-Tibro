# Hotel Booking System

A comprehensive hotel booking system built with Laravel framework featuring room management, dynamic pricing, availability tracking, and booking management.

## 🚀 Features

- **Room Management**: Three room categories with different base prices
- **Dynamic Pricing**: Automatic weekend surcharge (20% on Friday & Saturday)
- **Smart Discounts**: 10% discount for 3 or more consecutive nights
- **Availability Tracking**: Real-time room availability checking
- **Booking Management**: Complete booking flow with confirmation
- **Validation**: Comprehensive form validation including Bangladeshi phone numbers
- **Responsive Design**: Bootstrap 5 powered responsive interface

## 📋 Room Categories & Pricing

| Category | Base Price | Rooms Available |
|----------|------------|-----------------|
| Premium Deluxe | 12,000 BDT | 3 rooms |
| Super Deluxe | 10,000 BDT | 3 rooms |
| Standard Deluxe | 8,000 BDT | 3 rooms |

## 💰 Pricing Rules

- **Weekend Surcharge**: +20% on Friday and Saturday
- **Long Stay Discount**: 10% discount for 3 or more consecutive nights
- **Price Calculation**: Daily pricing with proper weekend rules application

## 🛠️ Technologies Used

- **Backend**: Laravel 10.x
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL
- **Date Picker**: Flatpickr
- **Validation**: Laravel Form Requests

## 📦 Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js (for frontend dependencies)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/hotel-booking-task-your-name.git
   cd hotel-booking-task-your-name
