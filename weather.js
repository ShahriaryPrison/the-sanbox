fetch(
  "https://api.open-meteo.com/v1/forecast?latitude=35.7&longitude=51.4&current_weather=true",
)
  .then((res) => res.json())
  .then((data) => {
    console.log(data.current_weather.temperature);
    console.log(data.current_weather.windspeed);
    console.log(data.current_weather.weathercode);
    console.log(data.current_weather.time);
  });
