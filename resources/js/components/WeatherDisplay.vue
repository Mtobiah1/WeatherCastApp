<template>
    <div class="weather-container">
      <h2 class="title">Weather Information</h2>
  
      <!-- Input for City and Country Code -->
      <form @submit.prevent="fetchWeather" class="weather-form">
        <input 
          type="text" 
          v-model="city" 
          placeholder="City" 
          required 
          class="input" 
        />
        <input 
          type="text" 
          v-model="country" 
          placeholder="Country Code" 
          required 
          class="input" 
        />
        <button type="submit" class="submit-button" :disabled="loading">
          <span v-if="loading">
            <div class="spinner"></div>
          </span>
          <span v-else>Get Weather</span>
        </button>
      </form>
  
      <!-- Current Weather Display -->
      <div v-if="currentWeather" class="current-weather">
        <h3 class="weather-title">Current Weather for {{ city }}, {{ country }}</h3>
        <p>Temperature: <span class="temp">{{ currentWeather.temp }}°C</span></p>
        <p>Feels like: {{ currentWeather.app_temp }}°C</p>
        <p>Description: {{ currentWeather.weather.description }}</p>
        <p>Wind Speed: {{ currentWeather.wind_spd }} m/s</p>
        <p>Humidity: {{ currentWeather.rh }}%</p>
        <p>Air Quality Index: {{ currentWeather.aqi }}</p>
        <p>Timestamp: {{ currentWeather.ob_time }}</p>
      </div>
  
      <!-- 16-day Weather Forecast -->
      <div v-if="forecast" class="forecast">
        <h3 class="forecast-title">16-day Forecast</h3>
        <ul>
          <li v-for="day in forecast" :key="day.datetime" class="forecast-item">
            <strong>{{ day.datetime }}</strong>: 
            Max Temp: <span class="temp">{{ day.max_temp }}°C</span>, 
            Min Temp: <span class="temp">{{ day.min_temp }}°C</span>, 
            Weather: {{ day.weather.description }}, 
            Precipitation: {{ day.precip }}mm, 
            UV Index: {{ day.uv }},
            Wind: {{ day.wind_cdir_full }} ({{ day.wind_spd }} m/s)
          </li>
        </ul>
      </div>
  
      <!-- Search History -->
      <div v-if="searchHistory.length" class="search-history">
        <h3 class="history-title">Recent Searches</h3>
        <ul>
          <li v-for="history in searchHistory" :key="history.id">
            {{ history.city_name }}, {{ history.country_code }}
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        city: '',
        country: '',
        currentWeather: null,
        forecast: null,
        searchHistory: [],
        loading: false // Add loading state
      };
    },
    mounted() {
      this.getSearchHistory();
    },
    methods: {
      fetchWeather() {
        this.loading = true; // Set loading to true when the request starts
        axios.post('/weather/current', { city: this.city, country: this.country })
          .then(response => {
            this.currentWeather = response.data.data[0];
            this.fetchForecast();
            this.getSearchHistory(); // Refresh search history after search
          })
          .catch(error => console.error(error))
          .finally(() => {
            this.loading = false; // Set loading to false when request completes
          });
      },
      fetchForecast() {
        axios.post('/weather/forecast', { city: this.city, country: this.country })
          .then(response => {
            this.forecast = response.data.data;
          })
          .catch(error => console.error(error));
      },
      getSearchHistory() {
        axios.get('/weather/history')
          .then(response => {
            this.searchHistory = response.data;
          })
          .catch(error => console.error(error));
      }
    }
  };
  </script>
  
  <style scoped>
  .weather-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f7f9fc;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .title {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
  }
  
  .weather-form {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  
  .input {
    flex: 1;
    padding: 8px;
    margin: 0 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    min-width: 100px; /* Minimum width to prevent too small */
    max-width: 150px; /* Maximum width to control size */
  }
  
  .submit-button {
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }
  
  .submit-button:hover {
    background-color: #0056b3;
  }
  
  .current-weather,
  .forecast,
  .search-history {
    margin-top: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
  }
  
  .weather-title,
  .forecast-title,
  .history-title {
    color: #007bff;
    margin-bottom: 10px;
  }
  
  .forecast-item {
    margin-bottom: 10px;
  }
  
  .temp {
    font-weight: bold;
    color: #e74c3c;
  }
  
  /* Spinner CSS */
  .spinner {
    border: 2px solid #f3f3f3; /* Light grey */
    border-top: 2px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 20px;
    height: 20px;
    animation: spin 2s linear infinite;
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  
  /* Responsive Styles */
  @media (max-width: 600px) {
    .weather-form {
      flex-direction: column; /* Stack input fields on smaller screens */
    }
    
    .input {
      margin-bottom: 10px; /* Add space between stacked inputs */
    }
  }
  </style>
  