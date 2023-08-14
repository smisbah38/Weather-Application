<!DOCTYPE html>
<html>
<head>
    <title>Weather App</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Weather App</h1>
        <form method="GET">
            <label for="city">Select City:</label>
            <select name="city" id="city">
                <option value="New York">New York</option>
                <option value="Los Angeles">Los Angeles</option>
                <option value="London">London</option>
                <option value="Paris">Paris</option>
                <option value="Tokyo">Tokyo</option>
            </select>
            <button type="submit">Get Weather</button>
        </form>

        <?php
        $apiKey = 'b1d665bdbeee212c5fc9e99b52bfdd94'; // Replace with your API key
        
        if (isset($_GET['city'])) {
            $city = urlencode($_GET['city']);
            $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=b1d665bdbeee212c5fc9e99b52bfdd94&units=metric";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data && $data['cod'] == 200) {
                $weatherDescription = $data['weather'][0]['description'];
                $temperature = $data['main']['temp'];
                $humidity = $data['main']['humidity'];
                $windSpeed = $data['wind']['speed'];

                echo "<div class='weather-info'>";
                echo "<h2>Weather in $city</h2>";
                echo "<p><strong>Description:</strong> $weatherDescription</p>";
                echo "<p><strong>Temperature:</strong> $temperature °C</p>";
                echo "<p><strong>Humidity:</strong> $humidity%</p>";
                echo "<p><strong>Wind Speed:</strong> $windSpeed m/s</p>";
                echo "</div>";
            } else {
                echo "<p class='error'>City not found. Please try again.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
