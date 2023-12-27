<?php
    // Legacy WeatherService with an incompatible interface
    class LegacyWeatherService {
        public function getWeatherData($city) {
            // Simulating data retrieval from a third-party API
            return [
                'temperature' => 25,
                'condition' => 'sunny',
            ];
        }
    }

    // New interface that our application expects
    interface WeatherProvider {
        public function getCurrentTemperature();
        public function getCurrentCondition();
    }

    // Adapter class to make LegacyWeatherService compatible with WeatherProvider interface
    class WeatherServiceAdapter implements WeatherProvider {
        private $legacyWeatherService;

        public function __construct(LegacyWeatherService $legacyWeatherService) {
            $this->legacyWeatherService = $legacyWeatherService;
        }

        public function getCurrentTemperature() {
            // Adapt the method call to the legacy interface
            return $this->legacyWeatherService->getWeatherData('city')['temperature'];
        }

        public function getCurrentCondition() {
            // Adapt the method call to the legacy interface
            return $this->legacyWeatherService->getWeatherData('city')['condition'];
        }
    }

    // Client code using the new interface
    function displayWeather(WeatherProvider $weatherProvider) {
        $temperature = $weatherProvider->getCurrentTemperature();
        $condition = $weatherProvider->getCurrentCondition();
        
        echo "Current Temperature: $temperature °C, Condition: $condition";
    }

    // Usage
    $legacyWeatherService = new LegacyWeatherService();
    $weatherAdapter = new WeatherServiceAdapter($legacyWeatherService);

    // Now we can use the adapter seamlessly with the new interface
    displayWeather($weatherAdapter);
?>