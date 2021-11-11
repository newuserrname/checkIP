<!DOCTYPE html>
<html>
    <title></title>
    <header>
        <link rel="stylesheet" href="https://dnmtechs.com/project/checkip/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
    </header>

    <body>
        <div class="container">
            <?php
                require_once("get_data.php");
                $access_key = "&appid=cd1d043a0e456e138b5860da18c72fa4";
                $ip_obj = sendJsontoServer();
                $country = $ip_obj->country_name;
                $region = $ip_obj->region_name;
                if(!$region){
                    $region = $ip_obj->location->capital;
                }
                $current_obj = getCurrentData($region, $country, $access_key);
                $city_id = $current_obj->id;
                $forcast_obj = getForcast($city_id, $access_key);
            ?>
            <div class="col-md-10 col-md-10 col-md-12 col-md-12">
                <div class="row">
                    <div class="col-md-5">Location: <?php echo $region.", ".$country ?></div>
                    <div class="col-md-5">Update Time: <?php echo date("d/m/Y H:i:s",$current_obj->dt); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-5 text-center">
                        <div style="height:50px; width:50px; margin-left:auto;margin-right:auto;
                             background: url('http://openweathermap.org/img/w/<?php echo $current_obj->weather[0]->icon ?>.png');background-size: cover;"></div>
                        <div><?php echo $current_obj->main->temp." &#8451;" ?> - <?php echo  $current_obj->weather[0]->main ?></div>
                        <div>Cloudiness: <?php echo $current_obj->clouds->all."%" ?></div>
                    </div>
                    <div class="col-md-5">
                        <div>Pressure: <?php echo $current_obj->main->pressure."hPa" ?></div>
                        <div>Humidity: <?php echo $current_obj->main->humidity."%" ?></div>
                        <div>Min Temp: <?php echo $current_obj->main->temp_min." &#8451;" ?></div>
                        <div>Max Temp: <?php echo $current_obj->main->temp_max." &#8451;" ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">Wind Speed: <?php echo $current_obj->wind->speed." meter/sec" ?></div>
                    <div class="col-md-5">Wind Direction: <?php echo $current_obj->wind->deg."&deg;" ?></div>
                </div>
                <div class="row">
                    <div class="col-md-5">Sunrise: <?php echo date("H:i:s",$current_obj->sys->sunrise); ?></div>
                    <div class="col-md-5">Sunset: <?php echo date("H:i:s",$current_obj->sys->sunset); ?></div>
                </div>
            </div>
            <div class="row">
                    <?php 
                        $forcast_list = $forcast_obj->list;
                        foreach($forcast_list as $temp){ 
                            ?>
                <div class="col-md-2 text-center" style="border: 1px solid;">
                    <div class="col-md-12"><b><?php echo date("d/m H:i",$temp->dt) ?></b></div>
                             <div class="col-md-12" style="height:50px; width:50px; margin-left:auto;margin-right:auto;
                             background: url('http://openweathermap.org/img/w/<?php echo $temp->weather[0]->icon ?>.png') no-repeat;"></div>
                             <div class="col-md-12"><?php echo $temp->main->temp." &#8451;" ?></div>
                             <div class="col-md-12"><?php echo $temp->main->humidity."%" ?></div>
                             <div class="col-md-12"><?php echo $temp->weather[0]->main ?></div>
                        </div>
                            <?php }
                    ?>
                </div>
        </div>
    </body>
</html>