jQuery(document).ready(function($){



let apiKey = data_passed.apiKey;
let weatherZip = data_passed.weatherZip;
let weatherMapUrl = "http://api.openweathermap.org/data/2.5/weather?zip=" + weatherZip + ",us" + "&appid=" + apiKey + "&units=imperial";
let city_name;
let icode;
let temp;
let country_name;
let weather_description;
let id;
let icon;
let forecast_link = "https://openweathermap.org/city/";


      // API call and load date to variables
        $.getJSON(weatherMapUrl, function(data) {
        city_name = data["name"];
        country_name = data["sys"]["country"];
        icode = data["weather"][0]["icon"];
        weather_description = data["weather"][0]["description"];
        temp = Math.round(data["main"]["temp"]);
        id = data["id"];
        icon = "http://openweathermap.org/img/w/" + icode + ".png";



      // Mount data to DOM via div IDs defined in PHP Weather_Will_Porter class

        $("#weather-widget-title").html("Current Weather");
        $("#cityname").html(city_name);
        $("#temp").html(temp + "&#8457;");
        $("#weather-description").html(weather_description + ' <img src="' + icon + '">');
        $("#forecast").html("<a href=" + forecast_link + id + " target=\"_blank\">Click for the full forecast</a>");



        });


});
