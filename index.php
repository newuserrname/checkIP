<!DOCTYPE html>
<html>
<title>Check IP Locations - DNMTECHS</title>
<header>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</header>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-10 col-md-12 col-md-12">
                <?php
                    sendJsontoServer();

                    //Lay IP cua User
                    function getUserIP() {
                        $ipaddress = '';
                        if (getenv('HTTP_CLIENT_IP')) {
                            $ipaddress = getenv('HTTP_CLIENT_IP');
                        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
                            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                        } else if (getenv('HTTP_X_FORWARDED')) {
                            $ipaddress = getenv('HTTP_X_FORWARDED');
                        } else if (getenv('HTTP_FORWARDED_FOR')) {
                            $ipaddress = getenv('HTTP_FORWARDED_FOR');
                        } else if (getenv('HTTP_FORWARDED')) {
                            $ipaddress = getenv('HTTP_FORWARDED');
                        } else if (getenv('REMOTE_ADDR')) {
                            $ipaddress = getenv('REMOTE_ADDR');
                        } else {
                            $ipaddress = 'UNKNOWN';
                        }
                        return $ipaddress;
                    }

                    //Lay chuoi Json tu server
                    function sendJsontoServer() {
                        $userIP = getUserIP();
                        //$userIP = "72.229.28.185";
                        $access_key = "?access_key=a445fc0239b44b1f4c9836d0b902f08f";
                        $array_json = "http://api.ipstack.com/" . $userIP . $access_key;

                        $json = file_get_contents($array_json);
                        $obj = json_decode($json);
                        ?>

                    <div class="box box-primary">
                        <div class="box-header align-content-center">
                            <h3 class="box-title">Your IP: <strong><?php echo $obj->ip ?></strong></h3>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Type</td>
                                        <td>
                                            <?php echo $obj->type ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Continent Code</td>
                                        <td>
                                            <?php echo $obj->continent_code ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Continent Name</td>
                                        <td>
                                            <?php echo $obj->continent_name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Country Code</td>
                                        <td>
                                            <?php echo $obj->country_code ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Country Name</td>
                                        <td>
                                            <?php echo $obj->country_name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Country Flag</td>
                                        <td>
                                            <div style="background: url(<?php echo $obj->location->country_flag ?>) no-repeat; background-size:auto 30px; height:30px;"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Capital</td>
                                        <td>
                                            <?php echo $obj->location->capital ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Region Code</td>
                                        <td>
                                            <?php echo $obj->region_code ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Region Name</td>
                                        <td>
                                            <?php echo $obj->region_name ?>,
                                            <?php echo $obj->city ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Zip</td>
                                        <td>
                                            <?php echo $obj->zip ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Geographic Coordinate</td>
                                        <td>
                                            <?php echo $obj->latitude ?>,
                                            <?php echo $obj->longitude ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Geoname ID</td>
                                        <td>
                                            <?php echo $obj->location->geoname_id ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Country Flag Emoji</td>
                                        <td>
                                            <?php echo $obj->location->country_flag_emoji ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Calling Code</td>
                                        <td>
                                            <?php echo $obj->location->calling_code ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Language Code</td>
                                        <td>
                                            <?php echo $obj->location->languages[0]->code ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Language Name</td>
                                        <td>
                                            <?php echo $obj->location->languages[0]->name ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%; font-weight: bold">Language Native</td>
                                        <td>
                                            <?php echo $obj->location->languages[0]->native ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php }
                    ?>
            </div>
        </div>
    </div>
</body>

</html>