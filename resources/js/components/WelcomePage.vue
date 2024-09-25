<template>
  <div class="welcome-container">
    <h2 class="title">Welcome to WeatherCast</h2>
    
    <div id="current-location" class="info-description">Fetching your current location...</div>

    <div class="info-section">
      <h3 class="info-title">What is WeatherCast?</h3>
      <p class="info-description">
        WeatherCast is your go-to platform for real-time weather information. Get the latest weather updates and forecasts to plan your day better.
      </p>
    </div>

    <div class="info-section">
      <h3 class="info-title">How to Use WeatherCast</h3>
      <p class="info-description">
        Simply enter the name of the city and country code after you are logged in to the platform to get the current weather details, including temperature, humidity, and conditions.
      </p>
      <p class="info-description">
        Additionally, view extended forecasts for the upcoming days to make informed decisions for your plans.
      </p>
    </div>

    <div class="info-section">
      <h3 class="info-title">Features</h3>
      <ul class="features-list">
        <li>Current weather updates for any city.</li>
        <li>16-day weather forecasts.</li>
        <li>View history to easily access previously searched locations.</li>
        <li>User-friendly interface for quick navigation.</li>
      </ul>
    </div>

    <div class="info-section">
      <h3 class="info-title">Get Started!</h3>
      <p class="info-description">
        Sign up or log in to save your favorite locations and access personalized weather updates tailored to you!
      </p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  mounted() {
    this.getCurrentLocation();
  },
  methods: {
    getCurrentLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;

          // Fetch city and country using a reverse geocoding API or use hardcoded values for demo
          this.fetchLocationData(latitude, longitude);
        }, (error) => {
          console.error('Geolocation error:', error);
          document.getElementById('current-location').innerText = "Unable to retrieve location.";
        });
      } else {
        console.log("Geolocation is not supported by this browser.");
        document.getElementById('current-location').innerText = "Geolocation is not supported.";
      }
    },
    fetchLocationData(latitude, longitude) {
      // Example API request to get location data from latitude and longitude
      fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=en`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('current-location').innerText = `Current Location: ${data.locality}, ${data.countryName}`;
        })
        .catch(error => {
          console.error('Error fetching location data:', error);
          document.getElementById('current-location').innerText = "Location data could not be retrieved.";
        });
    }
  }
};
</script>

<style scoped>
.welcome-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 30px;
  background-color: #e0f7fa; /* Light aqua background */
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.title {
  text-align: center;
  color: #00796b; /* Teal color for the title */
  margin-bottom: 20px;
  font-size: 2.2em; /* Larger font size */
  font-weight: bold;
}

.info-section {
  margin-top: 25px;
  padding: 20px;
  border: 1px solid #00796b; /* Teal border */
  border-radius: 10px;
  background-color: #ffffff; /* White background for sections */
  transition: transform 0.3s; /* Animation on hover */
}

.info-section:hover {
  transform: translateY(-5px); /* Lift effect on hover */
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.info-title {
  color: #00796b; /* Teal color for subtitles */
  margin-bottom: 10px;
  font-size: 1.5em; /* Increased font size */
  border-bottom: 2px solid #00796b; /* Underline effect */
  padding-bottom: 5px;
}

.info-description {
  color: #555;
  margin-bottom: 10px;
  line-height: 1.6; /* Improved line height for readability */
}

.features-list {
  list-style-type: disc;
  padding-left: 20px;
  color: #555;
  margin-top: 10px; /* Added margin for spacing */
}

/* Responsive Styles */
@media (max-width: 600px) {
  .welcome-container {
    padding: 20px; /* Reduced padding for small screens */
  }
  
  .title {
    font-size: 1.8em; /* Smaller title on small screens */
  }
  
  .info-title {
    font-size: 1.3em; /* Smaller subtitles on small screens */
  }
}
</style>
