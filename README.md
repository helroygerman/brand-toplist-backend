# Brand Toplist Backend

This project provides a comprehensive backend API for the Brand Toplist application - a CRUD application to manage a top list of brands with mobile-friendly design and geolocation-based list configuration.

## Features

- **Complete CRUD Operations** - Create, read, update, and delete brand records
- **Geolocation Support** - Location-based brand list configuration
- **Mobile-Responsive Design** - Optimized for mobile devices
- **RESTful API** - Clean and intuitive API endpoints
- **Interactive API Documentation** - Swagger/OpenAPI documentation available at `/api/documentation`
- **Docker Support** - Easy deployment with Docker containerization

## API Documentation

The application includes comprehensive API documentation powered by Swagger/OpenAPI. After running the application, you can access the interactive documentation at:

```
http://localhost:8000/api/documentation
```

The documentation provides:
- Complete API endpoint reference
- Request/response examples
- Interactive testing interface
- Authentication details
- Parameter specifications

## Deployment with Docker

### Prerequisites
- [Docker](https://www.docker.com/get-started) installed on your machine

### Steps

1. **Clone the repository:**
    ```bash
    git clone https://github.com/helroygerman/brand-toplist-backend.git
    cd brand-toplist-backend
    ```

2. **Build the Docker image:**
    ```bash
    docker build -t brand-toplist-backend .
    ```

3. **Run the Docker container:**
    ```bash
    docker run -d -p 8000:80 --name brand-toplist-backend brand-toplist-backend
    ```
    - The backend will be accessible at `http://localhost:8000`
    - API documentation will be available at `http://localhost:8000/api/documentation`

### Environment Variables

If your application requires environment variables, create a `.env` file in the project root and add the necessary variables. You can pass them to Docker using:

```bash
docker run --env-file .env -d -p 8000:80 --name brand-toplist-backend brand-toplist-backend
```

## API Endpoints

The application provides the following main endpoints:

- `GET /api/brands` - Retrieve all brands
- `POST /api/brands` - Create a new brand
- `GET /api/brands/{id}` - Retrieve a specific brand
- `PUT /api/brands/{id}` - Update a specific brand
- `DELETE /api/brands/{id}` - Delete a specific brand

For complete endpoint documentation with parameters, request/response formats, and examples, visit the Swagger documentation at `/api/documentation`.

## Technology Stack

- **Backend Framework:** Laravel (PHP)
- **Database:** SQLite (configurable)
- **Documentation:** Swagger/OpenAPI
- **Containerization:** Docker
- **Web Server:** Apache

## Development

### Local Development Setup

1. Install PHP dependencies:
    ```bash
    composer install
    ```

2. Set up environment variables:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. Run database migrations:
    ```bash
    php artisan migrate
    ```

4. Start the development server:
    ```bash
    php artisan serve
    ```

### Stopping the Container

```bash
docker stop brand-toplist-backend
docker rm brand-toplist-backend
```

## Screenshots

![API Documentation](screenshots/screenshot1.png)
*Swagger API Documentation Interface*

![Brand Management](screenshots/screenshot2.png)
*Brand CRUD Operations*

## Project Structure

```
brand-toplist-backend/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   ├── api.php
│   └── web.php
├── storage/
├── public/
├── Dockerfile
├── docker-compose.yml (optional)
└── README.md
```

## Testing

Run the test suite with:

```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Submit a pull request

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

**Developer:** German SONKOUE  
For questions or feedback, please contact [yimhelgerman@gmail.com](mailto:yimhelgerman@gmail.com)

---

*Built with ❤️ for efficient brand management*