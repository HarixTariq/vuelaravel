<template>
    <div class="container">

        <div class="row" id="weatherApp">
            <div class="col-md-12">
                <main>
                    <div class="search-box">
                        <input type="text" class="search-bar" placeholder="Search by place" v-model="query" @keypress="fetchWeather"/>

                    </div>
                    <div class="weather-wrap" v-if="typeof weather.main != 'undefined'">
                        <div class="location-box">
                            <div class="location">{{ weather.name }} , {{ weather.sys.country }} </div>
                            <!-- <div class="date">{{ dateBuilder() }}</div> -->
                            <div class="date">{{ toDateTime(weather.dt) }}</div>
                        </div>
                        <div class="weather-box">
                            <div class="temp">{{Math.round(weather.main.temp)}}</div>
                            <div class="weather">{{ weather.weather[0].main }}</div>
                            <div class="description">{{ weather.weather[0].description }}</div>
                        </div>
                    </div>
                    <div class="weather-wrap" v-if=" weather.cod == '404'">
                        <div class="location-box">
                            <div class="location">Error {{ weather.cod }} : {{ weather.message }} </div>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>

</template>



<script>
    export default{
        name : 'weatherApp',
        data() {
            return {
                api_key : 'e9e98dcb448be31a86a0baaafd0f72c3',
                url_base: 'https://api.openweathermap.org/data/2.5/',
                query: '',
                weather:{}
            }
        },
        methods:{
            fetchWeather(e){
                if(e.key == "Enter"){
                    fetch(`${this.url_base}weather?q=${this.query}&units=metric&APPID=${this.api_key}`)
                    .then(response => {
                        console.log(response);
                        return response.json();
                    }).then(this.setResults);
                }
            },
            setResults(results){
                this.weather = results;
                console.log(this.weather);
            },
            dateBuilder(){
                let today = new Date();
                var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                return `${date} ${time}`;
            },
            toDateTime(secs) {
                var t = new Date(1970, 0, 1); // Epoch
                t.setSeconds(secs);
                return `${t}`;
            }
        }
    }
</script>

<style media="screen">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        font-family:'montserrat', sans-serif;
    }
    #weatherApp{
        background-image: url('../../images/weather.jpeg');
        /* background-image: ; */
        background-size: cover;
        background-position: bottom;
        transition: 0.4s;
    }
    main{
        min-height: 100vh;
        padding: 25px;
        background-image: linear-gradient(to bottom, rgba(0,0,0,0.25), rgba(0,0,0,0.75));
    }
    .search-box{
        width: 100%;
        margin-bottom: 30px;
    }
    .search-box .search-bar {
        display: block;
        width: 100%;
        padding: 15px;
        color: #313131;
        font-size: 20px;
        appearance: none;
        border:none;
        outline:none;
        background:none;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius:0px 16px 0px 16px;
        transition: 0.4s;
        /* margin-bottom: 30px; */
    }
    .search-box .search-bar:focus {
        box-shadow:  0px 0px 16px rgba(0,0,0,0.25);
        background-color: rgba(255, 255, 255, 0.75);
        border-radius:16px 0px 16px 0px;

    }
    .location-box .location {
  color: #FFF;
  font-size: 32px;
  font-weight: 500;
  text-align: center;
  text-shadow: 1px 3px rgba(0, 0, 0, 0.25);
}
.location-box .date {
  color: #FFF;
  font-size: 20px;
  font-weight: 300;
  font-style: italic;
  text-align: center;
}
.weather-box {
  text-align: center;
}
.weather-box .temp {
  display: inline-block;
  padding: 10px 25px;
  color: #FFF;
  font-size: 102px;
  font-weight: 900;
  text-shadow: 3px 6px rgba(0, 0, 0, 0.25);
  background-color:rgba(255, 255, 255, 0.25);
  border-radius: 16px;
  margin: 30px 0px;
  box-shadow: 3px 6px rgba(0, 0, 0, 0.25);
}
.weather-box .weather {
  color: #FFF;
  font-size: 48px;
  font-weight: 700;
  font-style: italic;
  text-shadow: 3px 6px rgba(0, 0, 0, 0.25);
}

.weather-box .description{
  color: #FFF;
  font-size: 24px;
  font-weight: 700;
  font-style: italic;
  text-shadow: 3px 6px rgba(0, 0, 0, 0.25);
}

</style>
