
# Service Booking API - Service Booking API is a Laravel-based RESTful application that allows customers to browse available services and make bookings, 
while enabling administrators to manage services and view all bookings. It features secure authentication using Laravel Sanctum, role-based access 
control, and clean API endpoints for easy integration with frontend applications.

# Setup Instructions

1. *Clone the repository*

git clone https://github.com/shifatAhmed/service-booking.git
cd service-booking


2. *Install dependencies*

composer install


3. **Copy and configure environment file**

php artisan key:generate

Edit .env with your database credentials.

4. **Run migrations and seeders**
php artisan migrate --seed



5. *Serve the application*

php artisan serve


## In Postman 


{{base_url}} = http://127.0.0.1:8000/api


## API Usage Examples

## Authentication

**Register (Customer)**

POST /api/register
Header Set:
Content-Type:application/json
Accept:application/json

Body raw (JSON):
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}


**Login (Admin/Customer)**

POST /api/login
Header Set:
Content-Type:application/json
Accept:application/json
Body (JSON):
{
  "email": "admin@example.com",
  "password": "admin123456"
}


---

## Services
**For All Authenticated url (Customer/Admin) Header Set:

Accept:application/json
Authorization:Bearer Your_access_token_here
Content-Type:application/json

**GET /api/services** - List active services (Customer/Admin)
**POST /api/services** - Create service (Admin only)
Body (JSON):
{
  "name": "TV Repair",
  "description": "Repairing of residential and commercial TV.",
  "price": 1500,
  "status": true
}

**PUT /api/services/{id}** - Update service (Admin only)
Body (JSON):
{
  "price": 1000,
  "status": true
}

 **DELETE /api/services/{id}** - Delete service (Admin only)

---

##Bookings

**POST /api/bookings** - Customer books a service

{
  "service_id": 1,
  "booking_date": "2025-08-03"
}


**GET /api/bookings** - Customer to views their bookings

**GET /api/admin/bookings** Admin to views all bookings

---

##  Admin Credentials (Seeded)

Email: admin@example.com
Password: admin123456

***Demo video link : https://drive.google.com/file/d/1bqAxwV25q_1KiJETIKk_5Bq_scRV5Zsm/view?usp=sharing

