<?php
@include("includes/head.php");
session_start();
error_reporting(0);
$pageTitle = "School";
include('includes/dbconnection.php');
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Editor") || (!$u->hasRole("Super_admin")))) {
  // If $userData is empty or user doesn't have any of the specified roles, log out the user
  header('Location: userAccount.php?logoutSubmit=1');
  exit();
} else if (strlen($_SESSION['sessData'] == 0)) {
  header('location:logout.php');
} else {

  ?>

    <head>
      <title>ScholarInfo --School</title>
    </head>

    <body>
  <div class="main-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php @include "includes/sidebar.php" ?>
    <!-- partial -->

    <div class="page-wrapper">
      <!-- partial:partials/_navbar.html -->
      <?php @include "includes/header.php" ?>
      <!-- partial -->
      <div class="page-content">
        <div class="container-fluid">
          <div class="card p-4 rounded-3">

            <h3 class="p-3">ADD INSTITUTION DETAILS</h3>

            <form role="form" id="schoolForm" method="post" action="school_process.php">

              <?php


              if (!empty($_SESSION["insertRecord"])) {

                // Echo the success message
                echo '<div class = "alert alert-success alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
                echo $_SESSION["insertRecord"];
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>';
                if (isset($_SESSION['insertRecord'])) {
                  unset($_SESSION['insertRecord']);
                }
              } else if (!empty($_SESSION['insertRecordError'])) {

                // Echo the error message
                echo '<div class = "alert alert-danger alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
                echo $_SESSION["insertRecordError"];
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>

</div>';
                if (isset($_SESSION['insertRecordError'])) {
                  unset($_SESSION['insertRecordError']);
                }
              }


              ?>

              <div class="row align-items-center mb-3 col-lg">
                <div class="mb-3 ">
                  <label for="school_name">Institution Name</label>
                  <input type="text" name="school_name" maxlength="50" placeholder="School Name" class="form-control"
                    required>
                  <div class="text-danger error" id="schoolNameError"></div>
                </div>
                <div class="row align-items-center mb-3 col-lg">
                <div class="mb-3 ">
                  <label for="school_name">Phone Number</label>
                  <input type="text" name="phone" maxlength="10" placeholder="Phone Number" class="form-control"
                    required>
                  <div class="text-danger error" id="schoolNameError"></div>
                </div>
                <div class="row align-items-center mb-3 col-lg">
                <div class="mb-3 ">
                  <label for="school_name">Email</label>
                  <input type="text" name="email" maxlength="100" placeholder="Email" class="form-control"
                    required>
                  <div class="text-danger error" id="schoolNameError"></div>
                </div>
                <div class="mb-3">
                  <label for="cnty">County</label>
                  <select id="cnty" class="form-control" name="county">
                    <option selected disabled>County</option>
                    <option id="30" value='Baringo'>Baringo</option>
                    <option id="36" value='Bomet'>Bomet</option>
                    <option id="39" value='Bungoma'>Bungoma</option>
                    <option id="40" value='Busia'>Busia</option>
                    <option id="28" value='Elgeyo-Marakwet'>Elgeyo-Marakwet</option>
                    <option id="14" value='Embu'>Embu</option>
                    <option id="7" value='Garissa'>Garissa</option>
                    <option id="43" value='Homa Bay'>Homa Bay</option>
                    <option id="11" value='Isiolo'>Isiolo</option>
                    <option id="34" value='Kajiado'>Kajiado</option>
                    <option id="37" value='Kakamega'>Kakamega</option>
                    <option id="35" value='Kericho'>Kericho</option>
                    <option id="22" value='Kiambu'>Kiambu</option>
                    <option id="3" value='Kilifi'>Kilifi</option>
                    <option id="20" value='Kirinyaga'>Kirinyaga</option>
                    <option id="45" value='Kisii'>Kisii</option>
                    <option id="42" value='Kisumu'>Kisumu</option>
                    <option id="15" value='Kitui'>Kitui</option>
                    <option id="2" value='Kwale'>Kwale</option>
                    <option id="31" value='Laikipia'>Laikipia</option>
                    <option id="5" value='Lamu'>Lamu</option>
                    <option id="16" value='Machakos'>Machakos</option>
                    <option id="17" value='Makueni'>Makueni</option>
                    <option id="9" value='Mandera'>Mandera</option>
                    <option id="10" value='Marsabit'>Marsabit</option>
                    <option id="12" value='Meru'>Meru</option>
                    <option id="44" value='Migori'>Migori</option>
                    <option id="1" value='Mombasa'>Mombasa</option>
                    <option id="21" value='Murang' a'>Murang'a</option>
                    <option id="47" value='Nairobi City'>Nairobi City</option>
                    <option id="32" value='Nakuru'>Nakuru</option>
                    <option id="29" value='Nandi'>Nandi</option>
                    <option id="33" value='Narok'>Narok</option>
                    <option id="46" value='Nyamira'>Nyamira</option>
                    <option id="18" value='Nyandarua'>Nyandarua</option>
                    <option id="19" value='Nyeri'>Nyeri</option>
                    <option id="25" value='Samburu'>Samburu</option>
                    <option id="41" value='Siaya'>Siaya</option>
                    <option id="6" value='Taita-Taveta'>Taita-Taveta</option>
                    <option id="4" value='Tana River'>Tana River</option>
                    <option id="13" value='Tharaka-Nithi'>Tharaka-Nithi</option>
                    <option id="26" value='Trans Nzoia'>Trans Nzoia</option>
                    <option id="23" value='Turkana'>Turkana</option>
                    <option id="27" value='Uasin Gishu'>Uasin Gishu</option>
                    <option id="38" value='Vihiga'>Vihiga</option>
                    <option id="24" value='West Pokot'>West Pokot</option>
                    <option id="8" value='Wajir'>Wajir</option>
                  </select>
                  <div class="text-danger error" id="countyError"></div>
                </div>
                <div class="mb-3">
                  <label for="sub_cnty">Sub County</label>
                  <select id="sub_cnty" class="form-control sub_county" name="sub_county">
                    <option selected disabled>Select County First</option>
                    <option value="Changamwe" />
                    <option value="Jomvu" />
                    <option value="Kisauni" />
                    <option value="Nyali" />
                    <option value="Likoni" />
                    <option value="Mvita" />
                    <option value="Msambweni" />
                    <option value="Lunga Lunga" />
                    <option value="Kwale" />
                    <option value="Kinango" />
                    <option value="Bahari(Kilifi)" />
                    <option value="Kilifi South" />
                    <option value="Kaloleni" />
                    <option value="Rabai" />
                    <option value="Ganze" />
                    <option value="Malindi" />
                    <option value="Magarini" />
                    <option value="Tana Delta" />
                    <option value="Tana River" />
                    <option value="Bura(Tana North)" />
                    <option value="Lamu East" />
                    <option value="Lamu West" />
                    <option value="Taveta" />
                    <option value="Wundanyi(Taita)" />
                    <option value="Mwatate" />
                    <option value="Voi" />
                    <option value="Hulugho" />
                    <option value="Liara" />
                    <option value="Balambala" />
                    <option value="Lagdera" />
                    <option value="Dadaab" />
                    <option value="Fafi" />
                    <option value="Ijara" />
                    <option value="Wajir North" />
                    <option value="Wajir East" />
                    <option value="Buna" />
                    <option value="Habaswein" />
                    <option value="Tarbaj" />
                    <option value="Wajir West" />
                    <option value="Eldas" />
                    <option value="Wajir South" />
                    <option value="Mandera West" />
                    <option value="Banisa" />
                    <option value="Mandera North" />
                    <option value="Mandera Central" />
                    <option value="Mandera East" />
                    <option value="Lafey" />
                    <option value="Moyale" />
                    <option value="Marsabit" />
                    <option value="Horr North" />
                    <option value="Loiyangalani" />
                    <option value="Chalbi" />
                    <option value="Sololo" />
                    <option value="Marsabit South(Laisamis)" />
                    <option value="Garbatula" />
                    <option value="Isiolo" />
                    <option value="Merti" />
                    <option value="Igembe South" />
                    <option value="Igembe Central" />
                    <option value="Igembe North" />
                    <option value="Imenti South" />
                    <option value="Imenti North" />
                    <option value="Meru Central" />
                    <option value="Tigania Central" />
                    <option value="Tigania East" />
                    <option value="Tigania West" />
                    <option value="Buuri" />
                    <option value="Meru South" />
                    <option value="Maara" />
                    <option value="Tharaka South" />
                    <option value="Tharaka North" />
                    <option value="Embu East" />
                    <option value="Embu North" />
                    <option value="Embu West" />
                    <option value="Mbeere North" />
                    <option value="Mbeere South" />
                    <option value="Mwingi Central" />
                    <option value="Mwingi West" />
                    <option value="Mwingi East" />
                    <option value="Kitui West" />
                    <option value="Kitui Central" />
                    <option value="Nzambani" />
                    <option value="Mutomo" />
                    <option value="Mutomo" />
                    <option value="Ikutha" />
                    <option value="Katulani" />
                    <option value="Kisasi" />
                    <option value="Kyuso" />
                    <option value="Lower Yatta" />
                    <option value="Matinyani" />
                    <option value="Mumoni" />
                    <option value="Mutito" />
                    <option value="Masinga" />
                    <option value="Yatta" />
                    <option value="Kangundo" />
                    <option value="Matungulu" />
                    <option value="Kathiani" />
                    <option value="Athi River" />
                    <option value="Machakos " />
                    <option value="Mwala" />
                    <option value="Kibwezi" />
                    <option value="Kilungu" />
                    <option value="Makindu" />
                    <option value="Makueni" />
                    <option value="Mbooni West" />
                    <option value="Mbooni East" />
                    <option value="Kathonzweni" />
                    <option value="Mukaa" />
                    <option value="Nzaui" />
                    <option value="Kinangop" />
                    <option value="Kipipiri" />
                    <option value="Mirangine" />
                    <option value="Nyandarua Central" />
                    <option value="Nyandarua North" />
                    <option value="Nyandarua South" />
                    <option value="Nyandarua West" />
                    <option value="Tetu" />
                    <option value="Kieni East" />
                    <option value="Kieni West" />
                    <option value="Mathira East" />
                    <option value="Mathira West" />
                    <option value="Mukurwe-ini" />
                    <option value="Nyeri Central" />
                    <option value="Nyeri South" />
                    <option value="Kirinyaga Central" />
                    <option value="Kirinyaga East" />
                    <option value="Kiinyaga West" />
                    <option value="Mwea East" />
                    <option value="Mwea West" />
                    <option value="Kangema" />
                    <option value="Mathioya" />
                    <option value="Kahuro" />
                    <option value="Kigumo" />
                    <option value="Murang'a East" />
                    <option value="Kandara" />
                    <option value="Gatanga" />
                    <option value="Murang'a south" />
                    <option value="Gatundu South" />
                    <option value="Gatundu North" />
                    <option value="Juja" />
                    <option value="Ruiru" />
                    <option value="Githunguri" />
                    <option value="Kiambu" />
                    <option value="Kiambaa" />
                    <option value="Kabete" />
                    <option value="Kikuyu" />
                    <option value="Limuru" />
                    <option value="Lari" />
                    <option value="Thika East" />
                    <option value="Thika West" />
                    <option value="Turkana North" />
                    <option value="Turkana West" />
                    <option value="Turkana Central" />
                    <option value="Loima" />
                    <option value="Turkana South" />
                    <option value="Turkana East" />
                    <option value="Kibish" />
                    <option value="Kipkomo" />
                    <option value="Pokot Central" />
                    <option value="Pokot North" />
                    <option value="Pokot South" />
                    <option value="West Pokot" />
                    <option value="Samburu Central" />
                    <option value="Samburu North" />
                    <option value="Samburu East" />
                    <option value="Kwanza" />
                    <option value="Endebes" />
                    <option value="Transzoia East" />
                    <option value="Kiminini" />
                    <option value="Transzoia West" />
                    <option value="Soy" />
                    <option value="Wareng" />
                    <option value="Moiben" />
                    <option value="Eldoret West" />
                    <option value="Eldoret East" />
                    <option value="Kesses" />
                    <option value="Marakwet East" />
                    <option value="Marakwet West" />
                    <option value="Keiyo" />
                    <option value="Keiyo South" />
                    <option value="Tinderet" />
                    <option value="Nandi Central" />
                    <option value="Nandi East" />
                    <option value="Chesumei" />
                    <option value="Nandi North" />
                    <option value="Nandi South" />
                    <option value="East Pokot" />
                    <option value="Baringo North" />
                    <option value="Baringo Central" />
                    <option value="Koibatek" />
                    <option value="Marigat" />
                    <option value="Mogotio" />
                    <option value="Laikipia West" />
                    <option value="Laikipia East" />
                    <option value="Laikipia North" />
                    <option value="Laikipia Central" />
                    <option value="Nyahururu" />
                    <option value="Molo" />
                    <option value="Njoro" />
                    <option value="Naivasha" />
                    <option value="Gilgil" />
                    <option value="Kuresoi " />
                    <option value="Kuresoi North" />
                    <option value="Subukia" />
                    <option value="Rongai" />
                    <option value="Nakuru" />
                    <option value="Nakuru West" />
                    <option value="Nakuru North" />
                    <option value="Narok North" />
                    <option value="Narok East" />
                    <option value="Narok South" />
                    <option value="Narok West" />
                    <option value="Transmara East" />
                    <option value="Transmara West" />
                    <option value="Kajiado North" />
                    <option value="Kajiado Central" />
                    <option value="Kajiado West" />
                    <option value="Isinya" />
                    <option value="Loitokitok" />
                    <option value="Mashuuru" />
                    <option value="Kipkelion " />
                    <option value="Kericho" />
                    <option value="Londiani" />
                    <option value="Bureti" />
                    <option value="Belgut" />
                    <option value="Sigowei/Soin" />
                    <option value="Sotik" />
                    <option value="Chepalungu" />
                    <option value="Bomet East" />
                    <option value="Bomet " />
                    <option value="Konoin" />
                    <option value="Lugari" />
                    <option value="Matete" />
                    <option value="Likuyani" />
                    <option value="Kakamega Central" />
                    <option value="Kakamega East" />
                    <option value="Navakholo" />
                    <option value="Mumias " />
                    <option value="Mumias East" />
                    <option value="Matungu" />
                    <option value="Butere" />
                    <option value="Khwisero" />
                    <option value="Kakamega North" />
                    <option value="Kakamega South" />
                    <option value="Vihiga" />
                    <option value="Sabatia" />
                    <option value="Hamisi" />
                    <option value="Luanda" />
                    <option value="Emuhaya" />
                    <option value="Mt. Elgon" />
                    <option value="Bungoma Central" />
                    <option value="Bungoma East" />
                    <option value="Bungoma North" />
                    <option value="Bungoma South" />
                    <option value="Bungoma West" />
                    <option value="Webuye West" />
                    <option value="Cheptais" />
                    <option value="Kimilili" />
                    <option value="Bumula" />
                    <option value="Teso North" />
                    <option value="Teso South" />
                    <option value="Nambale" />
                    <option value="Bunyala" />
                    <option value="Busia" />
                    <option value="Butula" />
                    <option value="Samia" />
                    <option value="Ugenya" />
                    <option value="Ugunja" />
                    <option value="Siaya" />
                    <option value="Gem" />
                    <option value="Bondo" />
                    <option value="Rarieda" />
                    <option value="Kisumu East" />
                    <option value="Kisumu West" />
                    <option value="Kisumu Central" />
                    <option value="Seme" />
                    <option value="Nyando" />
                    <option value="Muhoroni" />
                    <option value="Nyakach" />
                    <option value="Mbita" />
                    <option value="Rachuonyo East" />
                    <option value="Rachuonyo North" />
                    <option value="Rachuonyo South" />
                    <option value="Homa Bay" />
                    <option value="Ndhiwa" />
                    <option value="Rangwe" />
                    <option value="Suba " />
                    <option value="Rongo" />
                    <option value="Awendo" />
                    <option value="Migori" />
                    <option value="Suna West" />
                    <option value="Uriri" />
                    <option value="Nyatike" />
                    <option value="Kuria West" />
                    <option value="Kuria East" />
                    <option value="Gucha" />
                    <option value="Gucha South" />
                    <option value="Kenyenya" />
                    <option value="Kisii Central" />
                    <option value="Kisii South" />
                    <option value="Kitutu Central" />
                    <option value="Marani" />
                    <option value="Masaba south" />
                    <option value="Nyamache" />
                    <option value="Sameta" />
                    <option value="Masaba North" />
                    <option value="Manga" />
                    <option value="Borabu" />
                    <option value="Nyamira North" />
                    <option value="Nyamira South" />
                    <option value="Westlands" />
                    <option value="Dagoretti" />
                    <option value="Langata" />
                    <option value="Kibra" />
                    <option value="Kasarani" />
                    <option value="Embakasi" />
                    <option value="Makadara" />
                    <option value="Kamukunji" />
                    <option value="Starehe" />
                    <option value="Mathare" />
                    <option value="Njiru" />
                  </select>
                  <div class="text-danger error" id="subCountyError"></div>
                </div>

                <fieldset class="mb-3">
                  <h6 class="form-label">Institution level</h6>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input ms-5" name="school_level" value="vocational" />
                    Vocational
                  </label>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input ms-5" name="school_level" value="Secondary" />
                    Secondary
                  </label>
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input ms-5" name="school_level" value="Primary" />
                    Primary
                  </label>
                  <div class="text-danger error" id="schoolLevelError"></div>

                </fieldset>
                <div class="row_bottom ms-5">
                  <div>
                    <input type="submit" class="btn btn-primary justify-content-start text-uppercase" value="submit"
                      name="submit" />
                  </div>
                  <div>
                    <input type="reset" class="btn btn-danger justify-content-end text-uppercase" name="reset" />
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>
      </div>
      <script>
        // Client-side validation
        document.getElementById('schoolForm').addEventListener('submit', function (event) {
          var valid = true;
          var schoolName = document.getElementsByName('school_name')[0].value.trim();
          var county = document.getElementsByName('county')[0].value;
          var subCounty = document.getElementsByName('sub_county')[0].value;
          var schoolLevel = document.querySelector('input[name="school_level"]:checked');

          // Clear previous error messages
          var errorDivs = document.getElementsByClassName('error');
          for (var i = 0; i < errorDivs.length; i++) {
            errorDivs[i].innerHTML = '';
          }

          if (schoolName === '') {
            document.getElementById('schoolNameError').innerHTML = 'School Name is required.';
            valid = false;
          }

          if (county === 'County' || county === '') {
            document.getElementById('countyError').innerHTML = 'County is required.';
            valid = false;
          }

          if (subCounty === '' || subCounty === 'Select County First') {
            document.getElementById('subCountyError').innerHTML = 'Sub County is required.';
            valid = false;
          }

          if (!schoolLevel) {
            document.getElementById('schoolLevelError').innerHTML = 'Please select School Level.';
            valid = false;
          }

          if (!valid) {
            event.preventDefault();
          }
        });
        var inputFields = document.querySelectorAll('input, select');
        for (var i = 0; i < inputFields.length; i++) {
          inputFields[i].addEventListener('change', function () {
            var fieldName = this.getAttribute('name');
            var errorDiv = document.getElementById(fieldName + 'Error');
            if (errorDiv) {
              errorDiv.innerHTML = '';
            }
          });
        }
        document.getElementsByName('county')[0].addEventListener('change', function () {
          document.getElementById('subCountyError').innerHTML = '';
        });

        // Event listener to clear School Level error when radio buttons change
        var schoolLevelRadios = document.querySelectorAll('input[name="school_level"]');
        for (var i = 0; i < schoolLevelRadios.length; i++) {
          schoolLevelRadios[i].addEventListener('change', function () {
            document.getElementById('schoolLevelError').innerHTML = '';
          });
        }
      </script>



      <script>
        // Get the county and subcounty select elements
        const countySelect = document.getElementById('cnty');
        const subcountySelect = document.querySelector('select[name="sub_county"]');

        // Define the county-to-subcounty mapping
        const countySubcountyMap = {
          30: ['Baringo South', 'Baringo Central', 'Baringo North', 'Mogotio', 'Eldama Ravine'],
          36: ['Bomet Central', 'Bomet East', 'Chepalungu', 'Konoin', 'Sotik'],
          39: ['Bumula', 'Kabuchai', 'Kanduyi', 'Kimilil', 'Mt Elgon', 'Sirisia', 'Tongaren', 'Webuye East', 'Webuye West'],
          40: ['Budalangi', 'Butula', 'Funyula', 'Nambele', 'Teso North', 'Teso South'],
          28: ['Keiyo North', 'Keiyo South', 'Marakwet East', 'Marakwet West'],
          14: ['Manyatta', 'Mbeere North', 'Mbeere South', 'Runyenjes'],
          7: ['Daadab', 'Fafi', 'Garissa', 'Hulugho', 'Ijara', 'Lagdera Balambala'],
          43: ['Homa Bay Town', 'Kabondo', 'Karachwonyo', 'Kasipul', 'Mbita', 'Ndhiwa', 'Rangwe', 'Suba'],
          11: ['Central', 'Garba Tula', 'Kina', 'Merit', 'Oldonyiro', 'Sericho'],
          34: ['Isinya', 'Kajiado Central', 'Kajiado North', 'Loitokitok', 'Mashuuru'],
          37: ['Butere', 'Kakamega Central', 'Kakamega East', 'Kakamega North', 'Kakamega South', 'Khwisero', 'Lugari', 'Lukuyani', 'Lurambi', 'Matete', 'Mumias', 'Mutungu', 'Navakholo'],
          35: ['Ainamoi', 'Belgut', 'Bureti', 'Kipkelion East', 'Kipkelion West', 'Soin Sigowet'],
          22: ['Gatundu North', 'Gatundu South', 'Githunguri', 'Juja', 'Kabete', 'Kiambaa', 'Kiambu', 'Kikuyu', 'Limuru', 'Ruiru', 'Thika Town', 'Lari'],
          3: ['Genzw', 'Kaloleni', 'Kilifi North', 'Kilifi South', 'Magarini', 'Malindi', 'Rabai'],
          20: ['Kirinyaga Central', 'Kirinyaga East', 'Kirinyaga West', 'Mwea East', 'Mwea West'],
          45: ['Gucha', 'Gucha South', 'Kenyenya', 'Kisii Central', 'Kisii South', 'Kitutu Central', 'Marani', 'Masaba South', 'Nyamache', 'Sameta'],
          42: ['Kisumu Central', 'Kisumu East', 'Kisumu West', 'Mohoroni', 'Nyakach', 'Nyando', 'Seme'],
          15: ['Ikutha', 'Katulani', 'Kisasi', 'Kitui Central', 'Kitui West', 'Lower Yatta', 'Matiyani', 'Migwani', 'Mutitu', 'Mutomo', 'Muumonikyusu', 'Mwingi Central', 'Mwingi East', 'Nzambani', 'Tseikuru'],
          2: ['Kinango', 'Lungalunga', 'Msambweni', 'Mutuga'],
          31: ['Laikipia Central', 'Laikipia East', 'Laikipia North', 'Laikipia West', 'Nyahururu'],
          5: ['Lamu East', 'Lamu West'],
          16: ['Kathiani', 'Machakos Town', 'Masinga', 'Matungulu', 'Mavoko', 'Mwala', 'Yatta'],
          17: ['Kaiti', 'Kibwei West', 'Kibwezi East', 'Kilome', 'Makueni', 'Mbooni'],
          9: ['Banissa', 'Lafey', 'Mandera East', 'Mandera North', 'Mandera South', 'Mandera West'],
          10: ['Laisamis', 'Moyale', 'North Hor', 'Saku'],
          12: ['Buuri', 'Igembe Central', 'Igembe North', 'Igembe South', 'Imenti Central', 'Imenti North', 'Imenti South', 'Tigania East', 'Tigania West'],
          44: ['Awendo', 'Kuria East', 'Kuria West', 'Mabera', 'Ntimaru', 'Rongo', 'Suna East', 'Suna West', 'Uriri'],
          1: ['Changamwe', 'Jomvu', 'Kisauni', 'Likoni', 'Mvita', 'Nyali'],
          21: ['Gatanga', 'Kahuro', 'Kandara', 'Kangema', 'Kigumo', 'Kiharu', 'Mathioya', 'Murang’a South'],
          47: ['Dagoretti North ', 'Dagoretti South ', 'Embakasi Central ', 'Embakasi East', 'Embakasi North ', 'Embakasi South ', 'Embakasi West ', 'Kamukunji ', 'Kasarani ', 'Kibra ', 'Lang\'ata ', 'Makadara ', 'Mathare ', 'Roysambu ', 'Ruaraka ', 'Starehe ', 'Westlands '],
          32: ['Bahati', 'Gilgil', 'Kuresoi North', 'Kuresoi South', 'Molo', 'Naivasha', 'Nakuru Town East', 'Nakuru Town West', 'Njoro', 'Rongai', 'Subukia'],
          29: ['Aldai', 'Chesumei', 'Emgwen', 'Mosop', 'Namdi Hills', 'Tindiret'],
          33: ['Narok East', 'Narok North', 'Narok South', 'Narok West', 'Transmara East', 'Transmara West'],
          46: ['Borabu', 'Manga', 'Masaba North', 'Nyamira North', 'Nyamira South'],
          18: ['Kinangop', 'Kipipiri', 'Ndaragwa', 'Ol Kalou', 'Ol Joro Orok'],
          19: ['Kieni East', 'Kieni West', 'Mathira East', 'Mathira West', 'Mkurweni', 'Nyeri Town', 'Othaya', 'Tetu'],
          25: ['Samburu East', 'Samburu North', 'Samburu West'],
          41: ['Alego Usonga', 'Bondo', 'Gem', 'Rarieda', 'Ugenya', 'Unguja', 'Yala'],
          6: ['Mwatate', 'Taveta', 'Voi', 'Wundanyi'],
          4: ['Bura', 'Galole', 'Garsen'],
          13: ['Chuka', 'Igambangobe', 'Maara', 'Muthambi', 'Tharaka North', 'Tharaka South'],
          26: ['Cherangany', 'Endebess', 'Kiminini', 'Kwanza', 'Saboti'],
          23: ['Loima', 'Turkana Central', 'Turkana East', 'Turkana North', 'Turkana South'],
          27: ['Ainabkoi', 'Kapseret', 'Kesses', 'Moiben', 'Soy', 'Turbo'],
          38: ['Emuhaya', 'Hamisi', 'Luanda', 'Sabatia', 'Vihiga'],
          8: ['Eldas', 'Tarbaj', 'Wajir East', 'Wajir North', 'Wajir South', 'Wajir West'],
          24: ['Central Pokot', 'North Pokot', 'Pokot South', 'West Pokot']
        };




        // Event listener for county select change
        countySelect.addEventListener('change', function () {
          // Get the selected county option ID
          const selectedCountyId = countySelect.options[countySelect.selectedIndex].id;

          // Clear the subcounty options
          subcountySelect.innerHTML = '';

          // Populate the subcounty options based on the selected county
          if (countySubcountyMap.hasOwnProperty(selectedCountyId)) {
            const subcounties = countySubcountyMap[selectedCountyId];
            for (let subcounty of subcounties) {
              const option = document.createElement('option');
              option.value = subcounty;
              option.textContent = subcounty;
              subcountySelect.appendChild(option);
            }
          }
        });


      </script>
      <!-- core:js -->
      <script src="assets/vendors/core/core.js"></script>
      <!-- endinject -->

      <!-- Plugin js for this page -->
      <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
      <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

      <!-- End plugin js for this page -->

      <!-- inject:js -->
      <script src="assets/vendors/feather-icons/feather.min.js"></script>
      <script src="assets/js/template.js"></script>
      <!-- endinject -->

      <!-- Custom js for this page -->
      <script src="assets/js/dashboard-dark.js"></script>
      <!-- End custom js for this page -->



    <?php
} ?>