# wifiweather
Looks up current weather conditions and creates 7 wifi access points with the data.

This was built to run on an [Onion Omega](https://onion.io) running OpenWRT in the United States.

Lookup the XML feed for your area here: http://w1.weather.gov/xml/current_obs/

Add a line to crontab to run the script automatically.

`*/15 * * * * /root/ssidjumble >/dev/null 2>&1`

Example Output:
        
```
SSID: >> KMYF Weather: Light Rain Fog
SSID: >> Temp: 58.0 F (14.4 C)
SSID: >> Dewpoint: 55.9 F (13.3 C)
SSID: >> Wind: South at 8.1 MPH
SSID: >> Wind Direction: South
SSID: >> Visibility: 2.00 MI
SSID: >> Relative Humidity: 93%
```
        
