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
              <input type="text" id="schoolName" name="school_name" maxlength="50" placeholder="School Name" class="form-control"
              value="<?php echo isset($row['school_name']) ? htmlspecialchars($row['school_name']) : ''; ?>" required>
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
    <option selected disabled>Select County First</option>
    <option value="Changamwe" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Changamwe')
        echo 'selected'; ?>>Changamwe</option>
    <option value="Jomvu" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Jomvu')
        echo 'selected'; ?>>Jomvu</option>
    <option value="Kisauni" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kisauni')
        echo 'selected'; ?>>Kisauni</option>
    <option value="Nyali" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyali')
        echo 'selected'; ?>>Nyali</option>
    <option value="Likoni" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Likoni')
        echo 'selected'; ?>>Likoni</option>
    <option value="Mvita" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mvita')
        echo 'selected'; ?>>Mvita</option>
    <option value="Msambweni" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mswambweni')
        echo 'selected'; ?>>Msambweni</option>
    <option value="Lunga Lunga" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lunga Lunga')
        echo 'selected'; ?>>Lunga Lunga</option>
    <option value="Kwale" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kwale')
        echo 'selected'; ?>>Kwale</option>
    <option value="Kinango" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kinango')
        echo 'selected'; ?>>Kinango</option>
    <option value="Bahari(Kilifi)" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bahari(Kilifi)')
        echo 'selected'; ?>>Bahari(Kilifi)</option>
    <option value="Kilifi South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kilifi South')
        echo 'selected'; ?>>Kilifi South</option>
    <option value="Kaloleni" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kaloleni')
        echo 'selected'; ?>>Kaloleni</option>
    <option value="Rabai" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rabai')
        echo 'selected'; ?>>Rabai</option>
    <option value="Ganze" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Ganze')
        echo 'selected'; ?>>Ganze</option>
    <option value="Malindi" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Malindi')
        echo 'selected'; ?>>Malindi</option>
    <option value="Magarini" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Magarini')
        echo 'selected'; ?>>Magarini</option>
    <option value="Tana Delta" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tana Delta')
        echo 'selected'; ?>>Tana Delta</option>
    <option value="Tana River" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tana River')
        echo 'selected'; ?>>Tana River</option>
    <option value="Bura(Tana North)" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bura(Tana North)')
        echo 'selected'; ?>>Bura(Tana North)</option>
    <option value="Lamu East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lamu East')
        echo 'selected'; ?>>Lamu East</option>
    <option value="Lamu West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lamu West')
        echo 'selected'; ?>>Lamu West</option>
    <option value="Taveta" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Taveta')
        echo 'selected'; ?>>Taveta</option>
    <option value="Wundanyi(Taita)" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Wundanyi(Taita)')
        echo 'selected'; ?>>Wundanyi(Taita)</option>
    <option value="Mwatate" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mwatate')
        echo 'selected'; ?>>Mwatate</option>
    <option value="Voi" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Voi')
        echo 'selected'; ?>>Voi</option>
    <option value="Hulugho" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Hulugho')
        echo 'selected'; ?>>Hulugho</option>
    <option value="Liara" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Liara')
        echo 'selected'; ?>>Liara</option>
    <option value="Balambala" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Balambala')
        echo 'selected'; ?>>Balambala</option>
    <option value="Lagdera" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lagdera')
        echo 'selected'; ?>>Lagdera</option>
    <option value="Dadaab" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Dadaab')
        echo 'selected'; ?>>Dadaab</option>
    <option value="Fafi" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Fafi')
        echo 'selected'; ?>>Fafi</option>
    <option value="Ijara" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Ijara')
        echo 'selected'; ?>>Ijara</option>
    <option value="Wajir North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Wajir North')
        echo 'selected'; ?>>Wajir North</option>
    <option value="Wajir East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Wajir East')
        echo 'selected'; ?>>Wajir East</option>
    <option value="Buna"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Buna')
        echo 'selected'; ?>>Buna</option>
    <option value="Habaswein"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Habaswein')
        echo 'selected'; ?>>Habaswein</option>
    <option value="Tarbaj"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tarbaj')
        echo 'selected'; ?>>Tarbaj</option>
    <option value="Wajir West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Wajir West')
        echo 'selected'; ?>>Wajir West</option>
    <option value="Eldas"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Eldas')
        echo 'selected'; ?>>Eldas</option>
    <option value="Wajir South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Wajir South')
        echo 'selected'; ?>>Wajir South</option>
    <option value="Mandera West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mandera West')
        echo 'selected'; ?>>Mandera West</option>
    <option value="Banisa"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Banisa')
        echo 'selected'; ?>>Banisa</option>
    <option value="Mandera North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mandera North')
        echo 'selected'; ?>>Mandera North</option>
    <option value="Mandera Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mandera Central')
        echo 'selected'; ?>>Mandera Central</option>
    <option value="Mandera East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mandera East')
        echo 'selected'; ?>>Mandera East</option>
    <option value="Lafey"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lafey')
        echo 'selected'; ?>>Lafey</option>
    <option value="Moyale"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Moyale')
        echo 'selected'; ?>>Moyale</option>
    <option value="Marsabit"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Marsabit')
        echo 'selected'; ?>>Marsabit</option>
    <option value="Horr North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Horr North')
        echo 'selected'; ?>>Horr North</option>
    <option value="Loiyangalani"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Loiyangalani')
        echo 'selected'; ?>>Loiyangalani</option>
    <option value="Chalbi"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Chalbi')
        echo 'selected'; ?>>Chalbi</option>
    <option value="Sololo"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Sololo')
        echo 'selected'; ?>>Sololo</option>
    <option value="Marsabit South(Laisamis)"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Marsabit South(Laisamis)')
        echo 'selected'; ?>>Marsabit South(Laisamis)</option>
    <option value="Garbatula"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Garbatula')
        echo 'selected'; ?>>Garbatula</option>
    <option value="Isiolo"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Isiolo')
        echo 'selected'; ?>>Isiolo</option>
    <option value="Merti"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Merti')
        echo 'selected'; ?>>Merti</option>
    <option value="Igembe South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Igembe South')
        echo 'selected'; ?>>Igembe South</option>
    <option value="Igembe Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Igembe Central')
        echo 'selected'; ?>>Igembe Central</option>
    <option value="Igembe North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Igembe North')
        echo 'selected'; ?>>Igembe North</option>
    <option value="Imenti South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Imenti South')
        echo 'selected'; ?>>Imenti South</option>
    <option value="Imenti North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Imenti North')
        echo 'selected'; ?>>Imenti North</option>
    <option value="Meru Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Meru Central')
        echo 'selected'; ?>>Meru Central</option>
    <option value="Tigania Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tigania Central')
        echo 'selected'; ?>>Tigania Central</option>
    <option value="Tigania East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tigania East')
        echo 'selected'; ?>>Tigania East</option>
    <option value="Tigania West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tigania West')
        echo 'selected'; ?>>Tigania West</option>
    <option value="Buuri"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Buuri')
        echo 'selected'; ?>>Buuri</option>
    <option value="Meru South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Meru South')
        echo 'selected'; ?>>Meru South</option>
    <option value="Maara"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Maara')
        echo 'selected'; ?>>Maara</option>
    <option value="Tharaka South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tharaka South')
        echo 'selected'; ?>>Tharaka South</option>
    <option value="Tharaka North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tharaka North')
        echo 'selected'; ?>>Tharaka North</option>
   <option value="Embu East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Embu East')
       echo 'selected'; ?>>Embu East</option>
    <option value="Embu North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Embu North')
        echo 'selected'; ?>>Embu North</option>
    <option value="Embu West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Embu West')
        echo 'selected'; ?>>Embu West</option>
    <option value="Mbeere North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mbeere North')
        echo 'selected'; ?>>Mbeere North</option>
    <option value="Mbeere South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mbeere South')
        echo 'selected'; ?>>Mbeere South</option>
    <option value="Mwingi Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mwingi Central')
        echo 'selected'; ?>>Mwingi Central</option>
    <option value="Mwingi West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mwingi West')
        echo 'selected'; ?>>Mwingi West</option>
    <option value="Mwingi East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mwingi East')
        echo 'selected'; ?>>Mwingi East</option>
    <option value="Kitui West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kitui West')
        echo 'selected'; ?>>Kitui West</option>
    <option value="Kitui Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kitui Central')
        echo 'selected'; ?>>Kitui Central</option>
    <option value="Nzambani"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nzambani')
        echo 'selected'; ?>>Nzambani</option>
    <option value="Mutomo"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mutomo')
        echo 'selected'; ?>>Mutomo</option>
    <option value="Ikutha"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Ikutha')
        echo 'selected'; ?>>Ikutha</option>
    <option value="Katulani"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Katulani')
        echo 'selected'; ?>>Katulani</option>
    <option value="Kisasi"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kisasi')
        echo 'selected'; ?>>Kisasi</option>
    <option value="Kyuso"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kyuso')
        echo 'selected'; ?>>Kyuso</option>
    <option value="Lower Yatta"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lower Yatta')
        echo 'selected'; ?>>Lower Yatta</option>
    <option value="Matinyani"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Matinyani')
        echo 'selected'; ?>>Matinyani</option>
    <option value="Mumoni"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mumoni')
        echo 'selected'; ?>>Mumoni</option>
    <option value="Mutito"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mutito')
        echo 'selected'; ?>>Mutito</option>
    <option value="Masinga"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Masinga')
        echo 'selected'; ?>>Masinga</option>
    <option value="Yatta"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Yatta')
        echo 'selected'; ?>>Yatta</option>
    <option value="Kangundo"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kangundo')
        echo 'selected'; ?>>Kangundo</option>
    <option value="Matungulu"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Matungulu')
        echo 'selected'; ?>>Matungulu</option>
    <option value="Kathiani"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kathiani')
        echo 'selected'; ?>>Kathiani</option>
    <option value="Athi River"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Athi River')
        echo 'selected'; ?>>Athi River</option>
    <option value="Machakos"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Machakos')
        echo 'selected'; ?>>Machakos</option>
    <option value="Mwala"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mwala')
        echo 'selected'; ?>>Mwala</option>
    <option value="Kibwezi"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kibwezi')
        echo 'selected'; ?>>Kibwezi</option>
    <option value="Kilungu"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kilungu')
        echo 'selected'; ?>>Kilungu</option>
    <option value="Makindu"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Makindu')
        echo 'selected'; ?>>Makindu</option>
    <option value="Makueni"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Makueni')
        echo 'selected'; ?>>Makueni</option>
    <option value="Mbooni West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mbooni West')
        echo 'selected'; ?>>Mbooni West</option>
    <option value="Mbooni East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mbooni East')
        echo 'selected'; ?>>Mbooni East</option>

<option value="Kathonzweni"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kathonzweni')
    echo 'selected'; ?>>Kathonzweni</option>
    <option value="Mukaa"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mukaa')
        echo 'selected'; ?>>Mukaa</option>
    <option value="Nzaui"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nzaui')
        echo 'selected'; ?>>Nzaui</option>
    <option value="Kinangop"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kinangop')
        echo 'selected'; ?>>Kinangop</option>
    <option value="Kipipiri"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kipipiri')
        echo 'selected'; ?>>Kipipiri</option>
    <option value="Mirangine"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mirangine')
        echo 'selected'; ?>>Mirangine</option>
    <option value="Nyandarua Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyandarua Central')
        echo 'selected'; ?>>Nyandarua Central</option>
    <option value="Nyandarua North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyandarua North')
        echo 'selected'; ?>>Nyandarua North</option>
    <option value="Nyandarua South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyandarua South')
        echo 'selected'; ?>>Nyandarua South</option>
    <option value="Nyandarua West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyandarua West')
        echo 'selected'; ?>>Nyandarua West</option>
    <option value="Tetu"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tetu')
        echo 'selected'; ?>>Tetu</option>
    <option value="Kieni East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kieni East')
        echo 'selected'; ?>>Kieni East</option>
    <option value="Kieni West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kieni West')
        echo 'selected'; ?>>Kieni West</option>
    <option value="Mathira East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mathira East')
        echo 'selected'; ?>>Mathira East</option>

<option value="Mathira West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mathira West')
    echo 'selected'; ?>>Mathira West</option>
    <option value="Mukurwe-ini"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mukurwe-ini')
        echo 'selected'; ?>>Mukurwe-ini</option>
    <option value="Nyeri Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyeri Central')
        echo 'selected'; ?>>Nyeri Central</option>
    <option value="Nyeri South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyeri South')
        echo 'selected'; ?>>Nyeri South</option>
    <option value="Kirinyaga Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kirinyaga Central')
        echo 'selected'; ?>>Kirinyaga Central</option>
    <option value="Kirinyaga East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kirinyaga East')
        echo 'selected'; ?>>Kirinyaga East</option>
    <option value="Kiinyaga West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kiinyaga West')
        echo 'selected'; ?>>Kiinyaga West</option>
    <option value="Mwea East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mwea East')
        echo 'selected'; ?>>Mwea East</option>
    <option value="Mwea West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mwea West')
        echo 'selected'; ?>>Mwea West</option>
    <option value="Kangema"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kangema')
        echo 'selected'; ?>>Kangema</option>
    <option value="Mathioya"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mathioya')
        echo 'selected'; ?>>Mathioya</option>
    <option value="Kahuro"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kahuro')
        echo 'selected'; ?>>Kahuro</option>
    <option value="Kigumo"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kigumo')
        echo 'selected'; ?>>Kigumo</option>
    <option value="Murang'a East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Murang\'a East')
        echo 'selected'; ?>>Murang'a East</option>
    <option value="Kandara"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kandara')
        echo 'selected'; ?>>Kandara</option>
    <option value="Gatanga"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Gatanga')
        echo 'selected'; ?>>Gatanga</option>
    <option value="Murang'a south"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Murang\'a south')
        echo 'selected'; ?>>Murang'a south</option>
    <option value="Gatundu South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Gatundu South')
        echo 'selected'; ?>>Gatundu South</option>

    <option value="Gatundu North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Gatundu North')
        echo 'selected'; ?>>Gatundu North</option>
    <option value="Juja"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Juja')
        echo 'selected'; ?>>Juja</option>
    <option value="Ruiru"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Ruiru')
        echo 'selected'; ?>>Ruiru</option>
    <option value="Githunguri"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Githunguri')
        echo 'selected'; ?>>Githunguri</option>
    <option value="Kiambu"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kiambu')
        echo 'selected'; ?>>Kiambu</option>
    <option value="Kiambaa"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kiambaa')
        echo 'selected'; ?>>Kiambaa</option>
    <option value="Kabete"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kabete')
        echo 'selected'; ?>>Kabete</option>
    <option value="Kikuyu"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kikuyu')
        echo 'selected'; ?>>Kikuyu</option>
    <option value="Limuru"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Limuru')
        echo 'selected'; ?>>Limuru</option>
    <option value="Lari"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lari')
        echo 'selected'; ?>>Lari</option>
    <option value="Thika East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Thika East')
        echo 'selected'; ?>>Thika East</option>
    <option value="Thika West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Thika West')
        echo 'selected'; ?>>Thika West</option>
    <option value="Turkana North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Turkana North')
        echo 'selected'; ?>>Turkana North</option>
    <option value="Turkana West"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Turkana West')
        echo 'selected'; ?>>Turkana West</option>
    <option value="Turkana Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Turkana Central')
        echo 'selected'; ?>>Turkana Central</option>
    <option value="Loima"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Loima')
        echo 'selected'; ?>>Loima</option>

    14
    <option value="Tinderet" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Tinderet')
        echo 'selected'; ?>>Tinderet</option>
    <option value="Nandi Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nandi Central')
        echo 'selected'; ?>>Nandi Central</option>
    <option value="Nandi East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nandi East')
        echo 'selected'; ?>>Nandi East</option>
    <option value="Chesumei" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Chesumei')
        echo 'selected'; ?>>Chesumei</option>
    <option value="Nandi North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nandi North')
        echo 'selected'; ?>>Nandi North</option>
    <option value="Nandi South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nandi South')
        echo 'selected'; ?>>Nandi South</option>
    <option value="East Pokot" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'East Pokot')
        echo 'selected'; ?>>East Pokot</option>
    <option value="Baringo North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Baringo North')
        echo 'selected'; ?>>Baringo North</option>
    <option value="Baringo Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Baringo Central')
        echo 'selected'; ?>>Baringo Central</option>
    <option value="Koibatek" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Koibatek')
        echo 'selected'; ?>>Koibatek</option>
    <option value="Marigat" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Marigat')
        echo 'selected'; ?>>Marigat</option>
    <option value="Mogotio" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mogotio')
        echo 'selected'; ?>>Mogotio</option>
    <option value="Laikipia West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Laikipia West')
        echo 'selected'; ?>>Laikipia West</option>
    <option value="Laikipia East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Laikipia East')
        echo 'selected'; ?>>Laikipia East</option>
    <option value="Laikipia North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Laikipia North')
        echo 'selected'; ?>>Laikipia North</option>
    <option value="Laikipia Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Laikipia Central')
        echo 'selected'; ?>>Laikipia Central</option>
    <option value="Nyahururu" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyahururu')
        echo 'selected'; ?>>Nyahururu</option>
    <option value="Molo" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Molo')
        echo 'selected'; ?>>Molo</option>
    <option value="Njoro" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Njoro')
        echo 'selected'; ?>>Njoro</option>
    <option value="Naivasha" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Naivasha')
        echo 'selected'; ?>>Naivasha</option>
    <option value="Gilgil" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Gilgil')
        echo 'selected'; ?>>Gilgil</option>
    <option value="Kuresoi" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kuresoi')
        echo 'selected'; ?>>Kuresoi</option>
    <option value="Kuresoi North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kuresoi North')
        echo 'selected'; ?>>Kuresoi North</option>
    <option value="Subukia" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Subukia')
        echo 'selected'; ?>>Subukia</option>
    <option value="Rongai" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rongai')
        echo 'selected'; ?>>Rongai</option>
    <option value="Nakuru" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nakuru')
        echo 'selected'; ?>>Nakuru</option>
<option value="Turkana South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Turkana South')
    echo 'selected'; ?>>Turkana South</option>
    <option value="Turkana East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Turkana East')
        echo 'selected'; ?>>Turkana East</option>
    <option value="Kibish"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kibish')
        echo 'selected'; ?>>Kibish</option>
    <option value="Kipkomo"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kipkomo')
        echo 'selected'; ?>>Kipkomo</option>
    <option value="Pokot Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Pokot Central')
        echo 'selected'; ?>>Pokot Central</option>
    <option value="Pokot North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Pokot North')
        echo 'selected'; ?>>Pokot North</option>
    <option value="Pokot South"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Pokot South')
        echo 'selected'; ?>>Pokot South</option>
    <option value="West Pokot"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'West Pokot')
        echo 'selected'; ?>>West Pokot</option>
    <option value="Samburu Central"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Samburu Central')
        echo 'selected'; ?>>Samburu Central</option>
    <option value="Samburu North"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Samburu North')
        echo 'selected'; ?>>Samburu North</option>
    <option value="Samburu East"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Samburu East')
        echo 'selected'; ?>>Samburu East</option>
    <option value="Kwanza" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kwanza')
        echo 'selected'; ?>>Kwanza</option>
    <option value="Endebes" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Endebes')
        echo 'selected'; ?>>Endebes</option>
    <option value="Transzoia East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Transzoia East')
        echo 'selected'; ?>>Transzoia East</option>
    <option value="Kiminini" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kiminini')
        echo 'selected'; ?>>Kiminini</option>
    <option value="Transzoia West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Transzoia West')
        echo 'selected'; ?>>Transzoia West</option>
    <option value="Soy" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Soy')
        echo 'selected'; ?>>Soy</option>
    <option value="Wareng" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Wareng')
        echo 'selected'; ?>>Wareng</option>
    <option value="Moiben" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Moiben')
        echo 'selected'; ?>>Moiben</option>
    <option value="Eldoret West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Eldoret West')
        echo 'selected'; ?>>Eldoret West</option>
    <option value="Eldoret East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Eldoret East')
        echo 'selected'; ?>>Eldoret East</option>
    <option value="Kesses" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kesses')
        echo 'selected'; ?>>Kesses</option>
    <option value="Marakwet East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Marakwet East')
        echo 'selected'; ?>>Marakwet East</option>
    <option value="Marakwet West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Marakwet West')
        echo 'selected'; ?>>Marakwet West</option>
    <option value="Keiyo" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Keiyo')
        echo 'selected'; ?>>Keiyo</option>
    <option value="Keiyo South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Keiyo South')
        echo 'selected'; ?>>Keiyo South</option>

<option value="Nakuru West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nakuru West')
    echo 'selected'; ?>>Nakuru West</option>
    <option value="Nakuru North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nakuru North')
        echo 'selected'; ?>>Nakuru North</option>
    <option value="Narok North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Narok North')
        echo 'selected'; ?>>Narok North</option>
    <option value="Narok East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Narok East')
        echo 'selected'; ?>>Narok East</option>
    <option value="Narok South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Narok South')
        echo 'selected'; ?>>Narok South</option>
    <option value="Narok West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Narok West')
        echo 'selected'; ?>>Narok West</option>
    <option value="Transmara East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Transmara East')
        echo 'selected'; ?>>Transmara East</option>
    <option value="Transmara West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Transmara West')
        echo 'selected'; ?>>Transmara West</option>
    <option value="Kajiado North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kajiado North')
        echo 'selected'; ?>>Kajiado North</option>
    <option value="Kajiado Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kajiado Central')
        echo 'selected'; ?>>Kajiado Central</option>
    <option value="Kajiado West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kajiado West')
        echo 'selected'; ?>>Kajiado West</option>
    <option value="Isinya" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Isinya')
        echo 'selected'; ?>>Isinya</option>
    <option value="Loitokitok" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Loitokitok')
        echo 'selected'; ?>>Loitokitok</option>
    <option value="Mashuuru" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mashuuru')
        echo 'selected'; ?>>Mashuuru</option>
    <option value="Kipkelion" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kipkelion')
        echo 'selected'; ?>>Kipkelion</option>
    <option value="Kericho" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kericho')
        echo 'selected'; ?>>Kericho</option>

<option value="Londiani" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Londiani')
    echo 'selected'; ?>>Londiani</option>
    <option value="Bureti" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bureti')
        echo 'selected'; ?>>Bureti</option>
    <option value="Belgut" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Belgut')
        echo 'selected'; ?>>Belgut</option>
    <option value="Sigowei/Soin" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Sigowei/Soin')
        echo 'selected'; ?>>Sigowei/Soin</option>
    <option value="Sotik" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Sotik')
        echo 'selected'; ?>>Sotik</option>
    <option value="Chepalungu" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Chepalungu')
        echo 'selected'; ?>>Chepalungu</option>
    <option value="Bomet East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bomet East')
        echo 'selected'; ?>>Bomet East</option>
    <option value="Bomet" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bomet')
        echo 'selected'; ?>>Bomet</option>
    <option value="Konoin" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Konoin')
        echo 'selected'; ?>>Konoin</option>
    <option value="Lugari" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Lugari')
        echo 'selected'; ?>>Lugari</option>
    <option value="Matete" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Matete')
        echo 'selected'; ?>>Matete</option>
    <option value="Likuyani" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Likuyani')
        echo 'selected'; ?>>Likuyani</option>
    <option value="Kakamega Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kakamega Central')
        echo 'selected'; ?>>Kakamega Central</option>
    <option value="Kakamega East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kakamega East')
        echo 'selected'; ?>>Kakamega East</option>
    <option value="Navakholo" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Navakholo')
        echo 'selected'; ?>>Navakholo</option>
    <option value="Mumias" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mumias')
        echo 'selected'; ?>>Mumias</option>
    <option value="Mumias East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mumias East')
        echo 'selected'; ?>>Mumias East</option>
    <option value="Matungu" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Matungu')
        echo 'selected'; ?>>Matungu</option>
    <option value="Butere" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Butere')
        echo 'selected'; ?>>Butere</option>
    <option value="Khwisero" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Khwisero')
        echo 'selected'; ?>>Khwisero</option>
    <option value="Kakamega North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kakamega North')
        echo 'selected'; ?>>Kakamega North</option>
    <option value="Kakamega South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kakamega South')
        echo 'selected'; ?>>Kakamega South</option>
    <option value="Vihiga" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Vihiga')
        echo 'selected'; ?>>Vihiga</option>
    <option value="Sabatia" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Sabatia')
        echo 'selected'; ?>>Sabatia</option>
    <option value="Hamisi" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Hamisi')
        echo 'selected'; ?>>Hamisi</option>
    <option value="Luanda" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Luanda')
        echo 'selected'; ?>>Luanda</option>
<option value="Emuhaya"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Emuhaya')
    echo 'selected'; ?>>Emuhaya</option>
<option value="Mt. Elgon" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mt. Elgon')
    echo 'selected'; ?>>Mt. Elgon</option>
<option value="Bungoma Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bungoma Central')
    echo 'selected'; ?>>Bungoma Central</option>
<option value="Bungoma East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bungoma East')
    echo 'selected'; ?>>Bungoma East</option>
<option value="Bungoma North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bungoma North')
    echo 'selected'; ?>>Bungoma North</option>
<option value="Bungoma South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bungoma South')
    echo 'selected'; ?>>Bungoma South</option>
<option value="Bungoma West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bungoma West')
    echo 'selected'; ?>>Bungoma West</option>
<option value="Webuye West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Webuye West')
    echo 'selected'; ?>>Webuye West</option>
<option value="Cheptais" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Cheptais')
    echo 'selected'; ?>>Cheptais</option>
<option value="Kimilili" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kimilili')
    echo 'selected'; ?>>Kimilili</option>
<option value="Bumula" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bumula')
    echo 'selected'; ?>>Bumula</option>
<option value="Teso North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Teso North')
    echo 'selected'; ?>>Teso North</option>
<option value="Teso South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Teso South')
    echo 'selected'; ?>>Teso South</option>
<option value="Nambale" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nambale')
    echo 'selected'; ?>>Nambale</option>

   <option value="Bunyala" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bunyala')
       echo 'selected'; ?>>Bunyala</option>
<option value="Busia" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Busia')
    echo 'selected'; ?>>Busia</option>
<option value="Butula" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Butula')
    echo 'selected'; ?>>Butula</option>
<option value="Samia" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Samia')
    echo 'selected'; ?>>Samia</option>
<option value="Ugenya" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Ugenya')
    echo 'selected'; ?>>Ugenya</option>
<option value="Ugunja" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Ugunja')
    echo 'selected'; ?>>Ugunja</option>
<option value="Siaya" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Siaya')
    echo 'selected'; ?>>Siaya</option>
<option value="Gem" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Gem')
    echo 'selected'; ?>>Gem</option>
<option value="Bondo" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Bondo')
    echo 'selected'; ?>>Bondo</option>
<option value="Rarieda" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rarieda')
    echo 'selected'; ?>>Rarieda</option>

    <option value="Kisumu East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kisumu')
        echo 'selected'; ?>>Kisumu East</option>
    <option value="Kisumu West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kisumu West')
        echo 'selected'; ?>>Kisumu West</option>
    <option value="Kisumu Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kisumu Central')
        echo 'selected'; ?>>Kisumu Central</option>
    <option value="Seme" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Seme')
        echo 'selected'; ?>>Seme</option>
    <option value="Nyando" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyando')
        echo 'selected'; ?>>Nyando</option>
    <option value="Muhoroni" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Muhoroni')
        echo 'selected'; ?>>Muhoroni</option>
    <option value="Nyakach" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyakach')
        echo 'selected'; ?>>Nyakach</option>
    <option value="Mbita" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mbita')
        echo 'selected'; ?>>Mbita</option>
    <option value="Rachuonyo East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rachuonyo East')
        echo 'selected'; ?>>Rachuonyo East</option>
    <option value="Rachuonyo North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rachuonyo North')
        echo 'selected'; ?>>Rachuonyo North</option>
    <option value="Rachuonyo South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rachuonyo South')
        echo 'selected'; ?>>Rachuonyo South</option>
    <option value="Homa Bay"<?php if (isset($row['sub_county']) && $row['sub_county'] === 'Homa Bay')
        echo 'selected'; ?>>Homa Bay</option>
    <option value="Ndhiwa" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Ndhiwa')
        echo 'selected'; ?>>Ndhiwa</option>
    <option value="Rangwe" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rangwe')
        echo 'selected'; ?>>Rangwe</option>
    <option value="Suba" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Suba')
        echo 'selected'; ?>>Suba</option>
    <option value="Rongo" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Rongo')
        echo 'selected'; ?>>Rongo</option>
    <option value="Awendo" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Awendo')
        echo 'selected'; ?>>Awendo</option>
    <option value="Migori" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Migori')
        echo 'selected'; ?>>Migori</option>
    <option value="Suna West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Suna West')
        echo 'selected'; ?>>Suna West</option>
    <option value="Uriri" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Uriri')
        echo 'selected'; ?>>Uriri</option>
    <option value="Nyatike" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyatike')
        echo 'selected'; ?>>Nyatike</option>
    <option value="Kuria West" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kuria West')
        echo 'selected'; ?>>Kuria West</option>
    <option value="Kuria East" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kuria East')
        echo 'selected'; ?>>Kuria East</option>
    <option value="Gucha" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Gucha')
        echo 'selected'; ?>>Gucha</option>
    <option value="Gucha South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Gucha South')
        echo 'selected'; ?>>Gucha South</option>
    <option value="Kenyenya" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kenyanya')
        echo 'selected'; ?>>Kenyenya</option>
    <option value="Kisii Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kisii Central')
        echo 'selected'; ?>>Kisii Central</option>
    <option value="Kisii South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kisii South')
        echo 'selected'; ?>>Kisii South</option>
    <option value="Kitutu Central" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kitutu Central')
        echo 'selected'; ?>>Kitutu Central</option>
    <option value="Marani <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Marani')
        echo 'selected'; ?>">Marani</option>
    <option value="Masaba south" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Masaba south')
        echo 'selected'; ?>>Masaba south</option>
    <option value="Nyamache" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyamacha')
        echo 'selected'; ?>>Nyamache</option>
    <option value="Sameta" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Sameta')
        echo 'selected'; ?>>Sameta</option>
    <option value="Masaba North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Masaba North')
        echo 'selected'; ?>>Masaba North</option>
    <option value="Manga" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Manga')
        echo 'selected'; ?>>Manga</option>
    <option value="Borabu" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Borabu')
        echo 'selected'; ?>>Borabu</option>
    <option value="Nyamira North" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyamira North')
        echo 'selected'; ?>>Nyamira North</option>
    <option value="Nyamira South" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Nyamira South')
        echo 'selected'; ?>>Nyamira South</option>
    <option value="Westlands" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Westlands')
        echo 'selected'; ?>>Westlands</option>
    <option value="Dagoretti" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Dagoretti')
        echo 'selected'; ?>>Dagoretti</option>
    <option value="Langata" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Langata')
        echo 'selected'; ?>>Langata</option>
    <option value="Kibra" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kibra')
        echo 'selected'; ?>>Kibra</option>
    <option value="Kasarani" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kasarani')
        echo 'selected'; ?>>Kasarani</option>
    <option value="Embakasi" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Embakasi')
        echo 'selected'; ?>>Embakasi</option>
    <option value="Makadara" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Makadara')
        echo 'selected'; ?>>Makadara</option>
    <option value="Kamukunji" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Kamukunji')
        echo 'selected'; ?>>Kamukunji</option>
    <option value="Starehe" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Starehe')
        echo 'selected'; ?>>Starehe</option>
    <option value="Mathare" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Mathare')
        echo 'selected'; ?>>Mathare</option>
    <option value="Njiru" <?php if (isset($row['sub_county']) && $row['sub_county'] === 'Njiru')
        echo 'selected'; ?>>Njiru</option>
</select>

<span class="error" id="subCountyName_err"></span>
</div>

<fieldset class="mb-3">
<h6 class="form-label">School level</h6>
<label for="schoolLevel" class="form-check-label">
<input type="radio" <?php echo (isset($row['school_level']) && $row['school_level'] === 'secondary') ? 'checked' : ''; ?> id="schoolLevel"  class="form-check-input" name="school_level" value="Secondary" />
Secondary
</label>
<label class="form-check-label">
<input type="radio" <?php echo (isset($row['school_level']) && $row['school_level'] === 'primary') ? 'checked' : ''; ?> class="form-check-input ms-5" name="school_level" value="Primary" />
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