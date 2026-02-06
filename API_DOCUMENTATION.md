# Nile Cruise Booking System - API Documentation

## Base URL

```
https://your-domain.com/api
```

## Authentication

Most endpoints are public and don't require authentication. Protected endpoints require JWT authentication:

```
Authorization: Bearer {your-jwt-token}
```

---

## Trip Management

### 1. Get All Trips

Retrieve all available trips with translations.

**Endpoint:** `GET /trips`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "check_in": "2026-03-15",
            "check_out": "2026-03-20",
            "cabin_count": 30,
            "suite_count": 2,
            "cabin_available": 15,
            "suite_available": 1,
            "cabin_price": 500.00,
            "suite_price": 1200.00,
            "trip_category": {
                "id": 1,
                "name": "Luxor to Aswan",
                "description": "5-day cruise from Luxor to Aswan"
            }
        }
    ]
}
```

---

### 2. Get Trip Additionals

Retrieve additional services for a specific trip.

**Endpoint:** `GET /tripAdditionals/{tripId}`

**Parameters:**
- `tripId` (integer, required) - The trip ID

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Airport Transfer",
            "description": "Round-trip airport transfer",
            "price": 50.00
        },
        {
            "id": 2,
            "name": "Hot Air Balloon Ride",
            "description": "Sunrise hot air balloon ride over Luxor",
            "price": 150.00
        }
    ]
}
```

---

### 3. Get Cabin Availability

Check cabin availability for a specific trip with detailed breakdown.

**Endpoint:** `GET /getReserved/{tripId}`

**Parameters:**
- `tripId` (integer, required) - The trip ID

**Response:**
```json
{
    "success": true,
    "data": {
        "trip_id": 1,
        "total_cabins": 32,
        "reserved_cabins": 15,
        "available_cabins": 17,
        "cabin_breakdown": {
            "standard": {
                "total": 30,
                "available": 16,
                "reserved": 14,
                "price": 500.00
            },
            "suite": {
                "total": 2,
                "available": 1,
                "reserved": 1,
                "price": 1200.00
            }
        },
        "available_cabin_numbers": [101, 102, 103, 201, 202, 401],
        "reserved_cabin_numbers": [104, 105, 203, 204, 301, 302]
    }
}
```

---

### 4. Get All Additional Trips

Retrieve all trips that have additional services available.

**Endpoint:** `GET /additionalTrips`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "check_in": "2026-03-15",
            "check_out": "2026-03-20",
            "has_additionals": true,
            "additional_count": 5
        }
    ]
}
```

---

## Reservations

### 5. Create Reservation

Create a new reservation (booking).

**Endpoint:** `POST /addReservation`

**Request Body:**
```json
{
    "trip_id": 1,
    "title": "Mr",
    "first_name": "John",
    "last_name": "Smith",
    "email": "john.smith@email.com",
    "mobile": "+201234567890",
    "country_id": 1,
    "cabin_type": "standard",
    "number_of_cabins": 2,
    "cabin_numbers": [101, 102],
    "additionals": [1, 2],
    "comment": "Early check-in requested",
    "ip_address": "192.168.1.1"
}
```

**Validation Rules:**
- `trip_id` (required, exists in trips table)
- `title` (required, string, max: 10)
- `first_name` (required, string, max: 191)
- `last_name` (required, string, max: 191)
- `email` (required, email, max: 191)
- `mobile` (required, string, max: 20)
- `country_id` (required, exists in countries table)
- `cabin_type` (required, in: standard, suite)
- `number_of_cabins` (required, integer, min: 1)
- `cabin_numbers` (required, array)
- `additionals` (nullable, array)
- `comment` (nullable, string, max: 1000)
- `ip_address` (required, ip)

**Response:**
```json
{
    "success": true,
    "message": "Reservation created successfully",
    "data": {
        "reservation_id": 123,
        "uuid": "RSV-2026-00123",
        "total_price": 1200.00,
        "status": "pending",
        "payment_url": "https://payment-gateway.com/pay/abc123"
    }
}
```

---

### 6. Get Checkout Details

Retrieve checkout details for a reservation.

**Endpoint:** `GET /getCheckout/{reservationId}`

**Parameters:**
- `reservationId` (integer, required) - The reservation ID

**Response:**
```json
{
    "success": true,
    "data": {
        "reservation": {
            "id": 123,
            "uuid": "RSV-2026-00123",
            "status": "pending",
            "price": 1200.00,
            "customer": {
                "name": "John Smith",
                "email": "john.smith@email.com",
                "mobile": "+201234567890"
            },
            "trip": {
                "check_in": "2026-03-15",
                "check_out": "2026-03-20",
                "category": "Luxor to Aswan"
            },
            "cabins": [
                {"number": 101, "type": "standard"},
                {"number": 102, "type": "standard"}
            ],
            "additionals": [
                {"name": "Airport Transfer", "price": 50.00}
            ]
        }
    }
}
```

---

### 7. Payment Response Webhook

Handle payment gateway response (callback endpoint).

**Endpoint:** `POST /paymentResponse`

**Request Body:**
```json
{
    "transaction_id": "TXN-123456",
    "reservation_uuid": "RSV-2026-00123",
    "status": "success",
    "amount": 1200.00,
    "payment_method": "credit_card",
    "gateway_response": {}
}
```

**Response:**
```json
{
    "success": true,
    "message": "Payment processed successfully",
    "data": {
        "reservation_status": "confirmed",
        "confirmation_email_sent": true
    }
}
```

---

## Content

### 8. Get Galleries

Retrieve all photo galleries with images.

**Endpoint:** `GET /gallery`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Luxury Cabins",
            "description": "Our premium cabin collection",
            "images": [
                {
                    "id": 1,
                    "url": "https://your-domain.com/storage/galleries/cabin1.jpg",
                    "alt": "Suite 401"
                }
            ]
        }
    ]
}
```

---

### 9. Get Facilities

Retrieve all cruise facilities.

**Endpoint:** `GET /facilities`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Swimming Pool",
            "description": "Outdoor pool on sun deck",
            "icon": "fa-swimming-pool",
            "image": "https://your-domain.com/storage/facilities/pool.jpg"
        },
        {
            "id": 2,
            "name": "Restaurant",
            "description": "Fine dining with panoramic views",
            "icon": "fa-utensils",
            "image": "https://your-domain.com/storage/facilities/restaurant.jpg"
        }
    ]
}
```

---

### 10. Get General Information

Retrieve general cruise information items.

**Endpoint:** `GET /infos`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Check-in Time",
            "content": "Check-in starts at 2:00 PM",
            "order": 1
        },
        {
            "id": 2,
            "title": "Dress Code",
            "content": "Smart casual attire for dinner",
            "order": 2
        }
    ]
}
```

---

### 11. Get Itineraries

Retrieve all trip itineraries.

**Endpoint:** `GET /itineraries`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "day": 1,
            "title": "Arrival in Luxor",
            "description": "Embarkation and welcome aboard. Visit Karnak Temple.",
            "activities": [
                "Karnak Temple Tour",
                "Welcome Dinner"
            ],
            "image": "https://your-domain.com/storage/itineraries/day1.jpg"
        }
    ]
}
```

---

### 12. Get Page by ID

Retrieve a specific content page.

**Endpoint:** `GET /pages/{id}`

**Parameters:**
- `id` (integer, required) - The page ID

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "About Us",
        "slug": "about-us",
        "content": "<p>Welcome to our luxury Nile cruise...</p>",
        "meta_title": "About Our Nile Cruise",
        "meta_description": "Learn about our luxury Nile cruise experience",
        "created_at": "2026-01-15T10:30:00.000000Z",
        "updated_at": "2026-02-01T14:20:00.000000Z"
    }
}
```

**Error Response (404):**
```json
{
    "success": false,
    "message": "Page not found"
}
```

---

### 13. Get Deck Information

Retrieve all deck layouts and information.

**Endpoint:** `GET /decks`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Sun Deck",
            "deck_number": 4,
            "description": "Top deck with pool and bar",
            "facilities": ["Pool", "Bar", "Lounge"],
            "cabin_count": 26,
            "suite_count": 2,
            "layout_image": "https://your-domain.com/storage/decks/deck4.jpg"
        },
        {
            "id": 2,
            "name": "Middle Deck",
            "deck_number": 3,
            "description": "Standard cabins with river views",
            "facilities": ["Reception", "Restaurant"],
            "cabin_count": 26,
            "suite_count": 0,
            "layout_image": "https://your-domain.com/storage/decks/deck3.jpg"
        }
    ]
}
```

---

### 14. Get Homepage Content

Retrieve all homepage content sections.

**Endpoint:** `GET /homePage`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": {
        "hero": {
            "title": "Experience Luxury on the Nile",
            "subtitle": "5-Star Cruise Between Luxor & Aswan",
            "background_image": "https://your-domain.com/storage/hero.jpg",
            "cta_text": "Book Now",
            "cta_link": "/trips"
        },
        "featured_trips": [
            {
                "id": 1,
                "title": "Luxor to Aswan - 5 Days",
                "price_from": 500.00,
                "image": "https://your-domain.com/storage/trips/trip1.jpg"
            }
        ],
        "testimonials": [
            {
                "id": 1,
                "customer_name": "Sarah Johnson",
                "rating": 5,
                "comment": "Amazing experience! Highly recommended.",
                "date": "2026-01-20"
            }
        ],
        "stats": {
            "years_experience": 25,
            "happy_customers": 15000,
            "destinations": 12,
            "awards": 8
        }
    }
}
```

---

## Contact & Newsletter

### 15. Submit Contact Form

Submit a contact form message.

**Endpoint:** `POST /contactus`

**Request Body:**
```json
{
    "name": "John Smith",
    "email": "john.smith@email.com",
    "mobile": "+201234567890",
    "subject": "Inquiry about group booking",
    "message": "I would like to inquire about booking for a group of 20 people."
}
```

**Validation Rules:**
- `name` (required, string, max: 191)
- `email` (required, email, max: 191)
- `mobile` (required, string, max: 20)
- `subject` (required, string, max: 191)
- `message` (required, string, max: 5000)

**Response:**
```json
{
    "success": true,
    "message": "Thank you for contacting us. We will respond within 24 hours."
}
```

---

### 16. Newsletter Subscription

Subscribe to the newsletter.

**Endpoint:** `POST /newsletter`

**Request Body:**
```json
{
    "email": "john.smith@email.com",
    "name": "John Smith"
}
```

**Validation Rules:**
- `email` (required, email, max: 191, unique in subscribers table)
- `name` (nullable, string, max: 191)

**Response:**
```json
{
    "success": true,
    "message": "Successfully subscribed to our newsletter!"
}
```

**Error Response (Already Subscribed):**
```json
{
    "success": false,
    "message": "This email is already subscribed to our newsletter."
}
```

---

## Utility

### 17. Get All Countries

Retrieve list of all countries for selection.

**Endpoint:** `GET /countries`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "United States",
            "code": "US",
            "phone_code": "+1"
        },
        {
            "id": 2,
            "name": "United Kingdom",
            "code": "GB",
            "phone_code": "+44"
        },
        {
            "id": 3,
            "name": "Egypt",
            "code": "EG",
            "phone_code": "+20"
        }
    ]
}
```

---

### 18. Get Meta Tags

Retrieve SEO meta tags for all pages.

**Endpoint:** `GET /metas`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "home",
            "title": "Luxury Nile Cruise | 5-Star Experience",
            "description": "Experience the ultimate luxury Nile cruise between Luxor and Aswan",
            "keywords": "nile cruise, luxury cruise, egypt travel, luxor, aswan"
        },
        {
            "id": 2,
            "name": "trips",
            "title": "Available Trips | Nile Cruise",
            "description": "Browse our available luxury Nile cruise trips",
            "keywords": "cruise trips, egypt cruises, nile tours"
        }
    ]
}
```

---

### 19. Get Closed Dates

Retrieve dates when the cruise is not operating.

**Endpoint:** `GET /closedDates`

**Parameters:**
- None

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "date_from": "2026-07-01",
            "date_to": "2026-07-31",
            "reason": "Annual maintenance",
            "type": "maintenance"
        },
        {
            "id": 2,
            "date_from": "2026-12-24",
            "date_to": "2026-12-26",
            "reason": "Holiday closure",
            "type": "holiday"
        }
    ]
}
```

---

### 20. Apply Coupon Code

Validate and apply a coupon code to a trip booking.

**Endpoint:** `GET /apply-coupon/{coupon}/{trip_id}/{user_mobile}`

**Parameters:**
- `coupon` (string, required) - The coupon code
- `trip_id` (integer, required) - The trip ID
- `user_mobile` (string, required) - User's mobile number

**Example:**
```
GET /apply-coupon/SUMMER2026/1/+201234567890
```

**Response (Valid Coupon):**
```json
{
    "success": true,
    "data": {
        "coupon": {
            "id": 5,
            "code": "SUMMER2026",
            "discount_percentage": 15,
            "discount_amount": null,
            "valid_from": "2026-06-01",
            "valid_to": "2026-08-31",
            "number_of_users": 100,
            "used_count": 23,
            "remaining_uses": 77
        },
        "discount": 15
    }
}
```

**Error Response (Invalid Coupon):**
```json
{
    "success": false,
    "message": "Invalid coupon code or trip."
}
```

**Error Response (Already Used):**
```json
{
    "success": false,
    "message": "Coupon already used by this user."
}
```

**Error Response (Limit Reached):**
```json
{
    "success": false,
    "message": "Coupon usage limit reached."
}
```

---

## Error Responses

All endpoints follow a consistent error response format:

### Validation Error (422)
```json
{
    "success": false,
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "mobile": ["The mobile format is invalid."]
    }
}
```

### Not Found (404)
```json
{
    "success": false,
    "message": "Resource not found"
}
```

### Server Error (500)
```json
{
    "success": false,
    "message": "An error occurred while processing your request."
}
```

### Unauthorized (401)
```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

---

## Rate Limiting

API requests are limited to:
- **60 requests per minute** for unauthenticated requests
- **100 requests per minute** for authenticated requests

When rate limit is exceeded:
```json
{
    "success": false,
    "message": "Too many requests. Please try again later.",
    "retry_after": 60
}
```

---

## Pagination

Endpoints that return lists support pagination:

**Query Parameters:**
- `page` (integer, default: 1) - Page number
- `per_page` (integer, default: 15, max: 100) - Items per page

**Example:**
```
GET /v1/trips?page=2&per_page=20
```

**Paginated Response:**
```json
{
    "success": true,
    "data": [...],
    "pagination": {
        "current_page": 2,
        "per_page": 20,
        "total": 156,
        "last_page": 8,
        "from": 21,
        "to": 40,
        "next_page_url": "https://your-domain.com/api/v1/trips?page=3",
        "prev_page_url": "https://your-domain.com/api/v1/trips?page=1"
    }
}
```

---

## Localization

The API supports multiple languages. Send language preference in the `Accept-Language` header:

**Supported Languages:**
- `en` - English (default)
- `es` - Spanish
- `pt` - Portuguese

**Example:**
```
Accept-Language: es
```

All translatable content (trip categories, facilities, pages, etc.) will be returned in the requested language.

---

## Support

For API support, please contact:
- **Email:** api-support@your-domain.com
- **Documentation:** https://your-domain.com/api/docs
- **Status Page:** https://status.your-domain.com

---

**Last Updated:** February 7, 2026
**API Version:** 1.0.0
