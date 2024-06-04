<?php require_once('includes/dbconnection.php');
session_start(); ?>

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <?php


    require_once('includes/dbconnection.php');


    $id = $_GET['id'];

    $_SESSION['school_id'] = $id;



    $query = "SELECT * FROM school WHERE id='$id'";


    $result = mysqli_query($conn, $query);


    $row = mysqli_fetch_assoc($result);


    ?>
    <div class="container">

        <div class="card mt-4" id="form-body">

            <div class="card-header">

                Update Data

            </div>
            <div class="card-body">

                <form method="POST" action="update_school.php">

                    <div class="form-group">
                        <div class="row align-items-center justify-content-between ">
                            <div class="mb-3">
                                <label for="schoolName">School Name</label>
                                <input type="text" id="schoolName" name="school_name" maxlength="50"
                                    placeholder="School Name" class="form-control"
                                    value="<?php echo isset($row['school_name']) ? htmlspecialchars($row['school_name']) : ''; ?>"
                                    required>
                                <span class="error mt-2" id="schoolName_err"></span>
                            </div>

                            <div class="mb-3">
                                <label for="cnty">County</label>
                                <select id="cnty" class="form-control" name="county">
                                    <option selected disabled>County</option>
                                    <option id="30" value="Baringo" <?php if (isset($row['county']) && $row['county'] === 'Baringo')
                                        echo 'selected'; ?>>Baringo</option>
                                    <option id="36" value="Bomet" <?php if (isset($row['county']) && $row['county'] === 'Bomet')
                                        echo 'selected'; ?>>Bomet</option>
                                    <option id="39" value="Bungoma" <?php if (isset($row['county']) && $row['county'] === 'Bungoma')
                                        echo 'selected'; ?>>Bungoma</option>
                                    <option id="40" value="Busia" <?php if (isset($row['county']) && $row['county'] === 'Busia')
                                        echo 'selected'; ?>>Busia</option>
                                    <option id="28" value="Elgeyo-Marakwet" <?php if (isset($row['county']) && $row['county'] === 'Elgeyo-Marakwet')
                                        echo 'selected'; ?>>Elgeyo-Marakwet</option>
                                    <option id="14" value="Embu" <?php if (isset($row['county']) && $row['county'] === 'Embu')
                                        echo 'selected'; ?>>Embu</option>
                                    <option id="7" value="Garissa" <?php if (isset($row['county']) && $row['county'] === 'Garissa')
                                        echo 'selected'; ?>>Garissa</option>
                                    <option id="43" value="Homa Bay" <?php if (isset($row['county']) && $row['county'] === 'Homa Bay')
                                        echo 'selected'; ?>>Homa Bay</option>
                                    <option id="11" value="Isiolo" <?php if (isset($row['county']) && $row['county'] === 'Isiolo')
                                        echo 'selected'; ?>>Isiolo</option>
                                    <option id="34" value="Kajiado" <?php if (isset($row['county']) && $row['county'] === 'Kajiado')
                                        echo 'selected'; ?>>Kajiado</option>
                                    <option id="37" value="Kakamega" <?php if (isset($row['county']) && $row['county'] === 'Kakamega')
                                        echo 'selected'; ?>>Kakamega</option>
                                    <option id="35" value="Kericho" <?php if (isset($row['county']) && $row['county'] === 'Kericho')
                                        echo 'selected'; ?>>Kericho</option>
                                    <option id="22" value="Kiambu" <?php if (isset($row['county']) && $row['county'] === 'Kiambu')
                                        echo 'selected'; ?>>Kiambu</option>
                                    <option id="3" value="Kilifi" <?php if (isset($row['county']) && $row['county'] === 'Kilifi')
                                        echo 'selected'; ?>>Kilifi</option>
                                    <option id="20" value="Kirinyaga" <?php if (isset($row['county']) && $row['county'] === 'Kirinyaga')
                                        echo 'selected'; ?>>Kirinyaga</option>
                                    <option id="45" value="Kisii" <?php if (isset($row['county']) && $row['county'] === 'Kisii')
                                        echo 'selected'; ?>>Kisii</option>
                                    <option id="42" value="Kisumu" <?php if (isset($row['county']) && $row['county'] === 'Kisumu')
                                        echo 'selected'; ?>>Kisumu</option>
                                    <option id="15" value="Kitui" <?php if (isset($row['county']) && $row['county'] === 'Kitui')
                                        echo 'selected'; ?>>Kitui</option>
                                    <option id="2" value="Kwale" <?php if (isset($row['county']) && $row['county'] === 'Kwale')
                                        echo 'selected'; ?>>Kwale</option>
                                    <option id="31" value="Laikipia" <?php if (isset($row['county']) && $row['county'] === 'Laikipia')
                                        echo 'selected'; ?>>Laikipia</option>
                                    <option id="5" value="Lamu" <?php if (isset($row['county']) && $row['county'] === 'Lamu')
                                        echo 'selected'; ?>>Lamu</option>
                                    <option id="16" value="Machakos" <?php if (isset($row['county']) && $row['county'] === 'Machakos')
                                        echo 'selected'; ?>>Machakos</option>
                                    <option id="17" value="Makueni" <?php if (isset($row['county']) && $row['county'] === 'Makueni')
                                        echo 'selected'; ?>>Makueni</option>
                                    <option id="9" value="Mandera" <?php if (isset($row['county']) && $row['county'] === 'Mandera')
                                        echo 'selected'; ?>>Mandera</option>
                                    <option id="10" value="Marsabit" <?php if (isset($row['county']) && $row['county'] === 'Marsabit')
                                        echo 'selected'; ?>>Marsabit</option>
                                    <option id="12" value="Meru" <?php if (isset($row['county']) && $row['county'] === 'Meru')
                                        echo 'selected'; ?>>Meru</option>
                                    <option id="44" value="Migori" <?php if (isset($row['county']) && $row['county'] === 'Migori')
                                        echo 'selected'; ?>>Migori</option>
                                    <option id="1" value="Mombasa" <?php if (isset($row['county']) && $row['county'] === 'Mombasa')
                                        echo 'selected'; ?>>Mombasa</option>
                                    <option id="21" value="Murang'a" <?php if (isset($row['county']) && $row['county'] === "Murang'a")
                                        echo 'selected'; ?>>Murang'a</option>
                                    <option id="47" value="Nairobi City" <?php if (isset($row['county']) && $row['county'] === 'Nairobi City')
                                        echo 'selected'; ?>>Nairobi City</option>
                                    <option id="32" value="Nakuru" <?php if (isset($row['county']) && $row['county'] === 'Nakuru')
                                        echo 'selected'; ?>>Nakuru</option>
                                    <option id="29" value="Nandi" <?php if (isset($row['county']) && $row['county'] === 'Nandi')
                                        echo 'selected'; ?>>Nandi</option>
                                    <option id="33" value="Narok" <?php if (isset($row['county']) && $row['county'] === 'Narok')
                                        echo 'selected'; ?>>Narok</option>
                                    <option id="46" value="Nyamira" <?php if (isset($row['county']) && $row['county'] === 'Nyamira')
                                        echo 'selected'; ?>>Nyamira</option>
                                    <option id="18" value="Nyandarua" <?php if (isset($row['county']) && $row['county'] === 'Nyandarua')
                                        echo 'selected'; ?>>Nyandarua</option>
                                    <option id="19" value="Nyeri" <?php if (isset($row['county']) && $row['county'] === 'Nyeri')
                                        echo 'selected'; ?>>Nyeri</option>
                                    <option id="25" value="Samburu" <?php if (isset($row['county']) && $row['county'] === 'Samburu')
                                        echo 'selected'; ?>>Samburu</option>
                                    <option id="41" value="Siaya" <?php if (isset($row['county']) && $row['county'] === 'Siaya')
                                        echo 'selected'; ?>>Siaya</option>
                                    <option id="6" value="Taita-Taveta" <?php if (isset($row['county']) && $row['county'] === 'Taita-Taveta')
                                        echo 'selected'; ?>>Taita-Taveta</option>
                                    <option id="4" value="Tana River" <?php if (isset($row['county']) && $row['county'] === 'Tana River')
                                        echo 'selected'; ?>>Tana River</option>
                                    <option id="13" value="Tharaka-Nithi" <?php if (isset($row['county']) && $row['county'] === 'Tharaka-Nithi')
                                        echo 'selected'; ?>>Tharaka-Nithi</option>
                                    <option id="26" value="Trans Nzoia" <?php if (isset($row['county']) && $row['county'] === 'Trans Nzoia')
                                        echo 'selected'; ?>>Trans Nzoia</option>
                                    <option id="23" value="Turkana" <?php if (isset($row['county']) && $row['county'] === 'Turkana')
                                        echo 'selected'; ?>>Turkana</option>
                                    <option id="27" value="Uasin Gishu" <?php if (isset($row['county']) && $row['county'] === 'Uasin Gishu')
                                        echo 'selected'; ?>>Uasin Gishu</option>
                                    <option id="38" value="Vihiga" <?php if (isset($row['county']) && $row['county'] === 'Vihiga')
                                        echo 'selected'; ?>>Vihiga</option>
                                    <option id="24" value="West Pokot" <?php if (isset($row['county']) && $row['county'] === 'West Pokot')
                                        echo 'selected'; ?>>West Pokot</option>
                                    <option id="8" value="Wajir" <?php if (isset($row['county']) && $row['county'] === 'Wajir')
                                        echo 'selected'; ?>>Wajir</option>
                                </select>

                                <span class="error" id="countyName_err"></span>
                            </div>
                            <div class="mb-3">
                                <label for="sub_cnty">Sub County</label>

                                <select id="sub_cnty" class="form-control sub_county" name="sub_county">
                                    <?php
                                    // Array of counties and their corresponding values
                                    $sub_counties = array(
                                        'Changamwe',
                                        'Jomvu',
                                        'Kisauni',
                                        'Nyali',
                                        'Likoni',
                                        'Mvita',
                                        'Msambweni',
                                        'Lunga Lunga',
                                        'Kwale',
                                        'Kinango',
                                        'Bahari(Kilifi)',
                                        'Kilifi South',
                                        'Kaloleni',
                                        'Rabai',
                                        'Ganze',
                                        'Malindi',
                                        'Magarini',
                                        'Tana Delta',
                                        'Tana River',
                                        'Bura(Tana North)',
                                        'Lamu East',
                                        'Lamu West',
                                        'Taveta',
                                        'Wundanyi(Taita)',
                                        'Mwatate',
                                        'Voi',
                                        'Hulugho',
                                        'Liara',
                                        'Balambala',
                                        'Lagdera',
                                        'Dadaab',
                                        'Fafi',
                                        'Ijara',
                                        'Wajir North',
                                        'Wajir East',
                                        'Buna',
                                        'Habaswein',
                                        'Tarbaj',
                                        'Wajir West',
                                        'Eldas',
                                        'Wajir South',
                                        'Mandera West',
                                        'Banisa',
                                        'Mandera North',
                                        'Mandera Central',
                                        'Mandera East',
                                        'Lafey',
                                        'Moyale',
                                        'Marsabit',
                                        'Horr North',
                                        'Loiyangalani',
                                        'Chalbi',
                                        'Sololo',
                                        'Marsabit South(Laisamis)',
                                        'Garbatula',
                                        'Isiolo',
                                        'Merti',
                                        'Igembe South',
                                        'Igembe Central',
                                        'Igembe North',
                                        'Imenti South',
                                        'Imenti North',
                                        'Meru Central',
                                        'Tigania Central',
                                        'Tigania East',
                                        'Tigania West',
                                        'Buuri',
                                        'Meru South',
                                        'Maara',
                                        'Tharaka South',
                                        'Tharaka North',
                                        'Embu East',
                                        'Embu North',
                                        'Embu West',
                                        'Mbeere North',
                                        'Mbeere South',
                                        'Mwingi Central',
                                        'Mwingi West',
                                        'Mwingi East',
                                        'Kitui West',
                                        'Kitui Central',
                                        'Nzambani',
                                        'Mutomo',
                                        'Ikutha',
                                        'Katulani',
                                        'Kisasi',
                                        'Kyuso',
                                        'Lower Yatta',
                                        'Matinyani',
                                        'Mumoni',
                                        'Mutito',
                                        'Masinga',
                                        'Yatta',
                                        'Kangundo',
                                        'Matungulu',
                                        'Kathiani',
                                        'Athi River',
                                        'Machakos Town',
                                        'Mwala',
                                        'Kibwezi',
                                        'Kilungu',
                                        'Makindu',
                                        'Makueni',
                                        'Mbooni West',
                                        'Mbooni East',
                                        'Kathonzweni',
                                        'Mukaa',
                                        'Nzaui',
                                        'Kinangop',
                                        'Kipipiri',
                                        'Mirangine',
                                        'Nyandarua Central',
                                        'Nyandarua North',
                                        'Nyandarua South',
                                        'Nyandarua West',
                                        'Tetu',
                                        'Kieni East',
                                        'Kieni West',
                                        'Mathira East',
                                        'Mathira West',
                                        'Mukurwe-ini',
                                        'Nyeri Central',
                                        'Nyeri South',
                                        'Kirinyaga Central',
                                        'Kirinyaga East',
                                        'Kiinyaga West',
                                        'Mwea East',
                                        'Mwea West',
                                        'Kangema',
                                        'Mathioya',
                                        'Kahuro',
                                        'Kigumo',
                                        'Murang\'a East',
                                        'Kandara',
                                        'Gatanga',
                                        'Murang\'a south',
                                        'Gatundu South',
                                        'Gatundu North',
                                        'Juja',
                                        'Ruiru',
                                        'Githunguri',
                                        'Kiambu',
                                        'Kiambaa',
                                        'Kabete',
                                        'Kikuyu',
                                        'Limuru',
                                        'Lari',
                                        'Thika East',
                                        'Thika West',
                                        'Turkana North',
                                        'Turkana West',
                                        'Turkana Central',
                                        'Loima',
                                        'Turkana South',
                                        'Turkana East',
                                        'Kibish',
                                        'Kipkomo',
                                        'Pokot Central',
                                        'Pokot North',
                                        'Pokot South',
                                        'West Pokot',
                                        'Samburu Central',
                                        'Samburu North',
                                        'Samburu East',
                                        'Kwanza',
                                        'Endebes',
                                        'Transzoia East',
                                        'Kiminini',
                                        'Transzoia West',
                                        'Soy',
                                        'Wareng',
                                        'Moiben',
                                        'Eldoret West',
                                        'Eldoret East',
                                        'Kesses',
                                        'Marakwet East',
                                        'Marakwet West',
                                        'Keiyo',
                                        'Keiyo South',
                                        'Tinderet',
                                        'Nandi Central',
                                        'Nandi East',
                                        'Chesumei',
                                        'Nandi North',
                                        'Nandi South',
                                        'East Pokot',
                                        'Baringo North',
                                        'Baringo Central',
                                        'Koibatek',
                                        'Marigat',
                                        'Mogotio',
                                        'Laikipia West',
                                        'Laikipia East',
                                        'Laikipia North',
                                        'Laikipia Central',
                                        'Nyahururu',
                                        'Molo',
                                        'Njoro',
                                        'Naivasha',
                                        'Gilgil',
                                        'Kuresoi',
                                        'Kuresoi North',
                                        'Subukia',
                                        'Rongai',
                                        'Nakuru',
                                        'Nakuru West',
                                        'Nakuru North',
                                        'Narok North',
                                        'Narok East',
                                        'Narok South',
                                        'Narok West',
                                        'Transmara East',
                                        'Transmara West',
                                        'Kajiado North',
                                        'Kajiado Central',
                                        'Kajiado West',
                                        'Isinya',
                                        'Loitokitok',
                                        'Mashuuru',
                                        'Kipkelion',
                                        'Kericho',
                                        'Londiani',
                                        'Bureti',
                                        'Belgut',
                                        'Sigowei/Soin',
                                        'Sotik',
                                        'Chepalungu',
                                        'Bomet East',
                                        'Bomet',
                                        'Konoin',
                                        'Lugari',
                                        'Matete',
                                        'Likuyani',
                                        'Kakamega Central',
                                        'Kakamega East',
                                        'Navakholo',
                                        'Mumias',
                                        'Mumias East',
                                        'Matungu',
                                        'Butere',
                                        'Khwisero',
                                        'Kakamega North',
                                        'Kakamega South',
                                        'Vihiga',
                                        'Sabatia',
                                        'Hamisi',
                                        'Luanda',
                                        'Emuhaya',
                                        'Mt. Elgon',
                                        'Bungoma Central',
                                        'Bungoma East',
                                        'Bungoma North',
                                        'Bungoma South',
                                        'Bungoma West',
                                        'Webuye West',
                                        'Cheptais',
                                        'Kimilini',
                                        'Bumula',
                                        'Teso North',
                                        'Teso South',
                                        'Nambale',
                                        'Bunyala',
                                        'Busia',
                                        'Butula',
                                        'Samia',
                                        'Ugenya',
                                        'Ugunja',
                                        'Siaya',
                                        'Gem',
                                        'Bondo',
                                        'Rarieda',
                                        'Kisumu East',
                                        'Kisumu West',
                                        'Kisumu Central',
                                        'Seme',
                                        'Nyando',
                                        'Muhoroni',
                                        'Nyakach',
                                        'Mbita',
                                        'Rachuonyo East',
                                        'Rachuonyo North',
                                        'Rachuonyo South',
                                        'Homa Bay',
                                        'Ndhiwa',
                                        'Rangwe',
                                        'Suba',
                                        'Rongo',
                                        'Awendo',
                                        'Migori',
                                        'Suna West',
                                        'Uriri',
                                        'Nyatike',
                                        'Kuria West',
                                        'Kuria East',
                                        'Gucha',
                                        'Gucha South',
                                        'Kenyenya',
                                        'Kisii Central',
                                        'Kisii South',
                                        'Kitutu Central',
                                        'Marani',
                                        'Masaba south',
                                        'Nyamache',
                                        'Sameta',
                                        'Masaba North',
                                        'Manga',
                                        'Borabu',
                                        'Nyamira North',
                                        'Nyamira South',
                                        'Westlands',
                                        'Dagoretti',
                                        'Langata',
                                        'Kibra',
                                        'Kasarani',
                                        'Embakasi',
                                        'Makadara',
                                        'Kamukunji',
                                        'Starehe',
                                        'Mathare',
                                        'Njiru'
                                    );
                                    // Loop through counties and generate options
                                    foreach ($sub_counties as $sub_county) {
                                        $selected = (isset($row['sub_county']) && $row['sub_county'] === $sub_county) ? 'selected' : '';
                                        echo '<option value="' . $sub_county . '" ' . $selected . '>' . $sub_county . '</option>';
                                    }
                                    ?>
                                </select>
                                <span class="error" id="subCountyName_err"></span>
                            </div>

                            <fieldset class="mb-3">
                                <h6 class="form-label">School level</h6>
                                <label for="schoolLevel" class="form-check-label">
                                    <input type="radio" <?php echo (isset($row['school_level']) && $row['school_level'] === 'secondary') ? 'checked' : ''; ?> id="schoolLevel"
                                        class="form-check-input" name="school_level" value="Secondary" />
                                    Secondary
                                </label>
                                <label class="form-check-label">
                                    <input type="radio" <?php echo (isset($row['school_level']) && $row['school_level'] === 'primary') ? 'checked' : ''; ?>
                                        class="form-check-input ms-5" name="school_level" value="Primary" />
                                    Primary
                                </label>

                            </fieldset>
                            <span class="error" id="schoolLevel_err"></span>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" id="submit">Submit</button>

                </form>
            </div>
        </div>
    </div>
</body>

</html>