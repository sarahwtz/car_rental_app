#  Car Rental App (Work in Progress)

## About
Web application for managing vehicles, customers, rentals, and authentication flows.  
Currently under active development (WIP).

---

##  Features

### Implemented

####  Authentication
- Web authentication (session-based)
- API authentication with **JWT**
- CSRF token integration with Vue login component
- Login flow built using Vue
- Protected API routes

####  Vehicle Management
- Full REST API for:
  - Brand
  - Car Model (with PNG image uploads + cleanup of old files)
  - Car
- Dynamic API filters
- Field selection in API responses
- Eager Loading for optimized queries
- Repository Pattern (Brand, CarModel)

####  Customer Management
- Full REST API for Client
- Validation handled through **FormRequest**

####  Rental Management
- Full REST API for Rental resource
- Validation handled through **FormRequest**

####  Backend Architecture
- Models: Brand, CarModel, Car, Client, Rental
- Database schema with migrations 
- AbstractRepository as base for repositories
- Dependency Injection in controllers

---

## Technologies
- **PHP 8.2.29**
- **Laravel 10**
- **Vue** 
- **Blade**, **Bootstrap**
- **MySQL**
- **Eloquent ORM**, **Migrations**

---

## Development Tools
- Composer  
- Laravel Artisan CLI  
- MySQL Workbench  
- Postman (for API testing)

---

## Roadmap
- Implement rental workflow UI
- Add pricing calculation logic for rentals
- Build admin dashboard
- Expand Vue frontend (login + Home already implemented, remaining CRUDs pending)
- Implement user roles & permissions 
- Add automated tests 
- Improve API documentation 
- Add pagination & caching for API endpoints


---



