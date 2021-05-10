## Práctico NRO 3 - Grupo 4

Ejemplo de petición JSON del práctico:

POST: http://localhost:8030/book-flight/e617f839-c8ee-4580-a0d3-6dceab0f3296

```json
{
   "buy-date": "2029-02-18 14:00:00",
   "number-seat": "5",
   "letter-seat": "E",
   "class-seat": "first",
   "value-price": "234",
   "currency-price": "$",
   "flight-id": "e617f839-c8ee-4580-a0d3-6dceab0f3295",
   "user-id": "e617f839-c8ee-4580-a0d3-6dceab0f3294",
   "luggage-type": "equipaje de mano",
   "luggage-weight-number": "21",
   "luggage-weight-unit": "kg"
}

Parte 1: Diseño de agregados y value objects.

	Book
	
	- Id: Uuid  (Value Object)
	- Buy date: Datetime
	- Seat: Seat (Value Object)
	- Price: Price (Value Object)
	- FlightId: flightId
	- UserId: userId
	- Luggage: Luggage


	Flight
	
	- Id: Uuid (Value Object)
	- Origin: String
	- Destination: String
	- Flight hours: Integer
	- Price: Integer     ]--> Price (Value Object)
	- Currency: String   ]
	- Departure Date: Datetime
	- Aircraft: String 
	- Airline: String
	- Gate: Gate (Value Object)

	
	User
	- Id: Uuid (Value Object)
	- Username: String
	- Name: String
	- Lastname: String
	- Password: String


	Luggage 
	- Id: Uuid  (Value Object)
	- Type: String 
	- Weight: Weight (Value Object)
	- BookId: bookId
