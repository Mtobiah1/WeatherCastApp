# WeatherCast

## Overview
WeatherCast is a user-friendly web application that provides accurate and real-time weather information. It connects to the Weatherbit API to retrieve current weather data and forecasts for up to 16 days, ensuring users stay informed about weather conditions in their area.

## Features
- **Real-Time Weather Updates**: Access current weather information based on your selected city and country code.
- **16-Day Weather Forecast**: Plan ahead with a comprehensive 16-day forecast.
- **User Accounts**: Login and registration features allow users to create personal accounts.
- **Search History**: Users can keep track of their previous searches for easy access to frequently checked locations.

## Technologies Used
- **Frontend**: HTML, CSS, JavaScript (Vue.js)
- **Backend**: PHP (Laravel)
- **Database**: MySQL (any other preferred database or MSSQL will work also)
- **API**: Weatherbit API for weather data

## Installation
1. Clone the repository:
   ```bash
   git clone git@github.com:Mtobiah1/WeatherCastApp.git
   cd weathercast
   2. Installation dependencies
    composer install
    npm install
3. Setup your .env file
    cp .env.example .env
    php artisan key:generate
4.Configure your database settings in the .env file.
5.Run the migrations:
    php artisan migrate
6. Start the development server:
    php artisan serve

Usage
    Register for a new account or log in to an existing account.
    Enter the country code and city of interest to retrieve the latest weather data.
    View the 16-day weather forecast and access your search history.

Acknowledgments

    Weatherbit API for providing reliable weather data.
    Laravel for a robust backend framework.
    Vue.js for an efficient frontend framework.

