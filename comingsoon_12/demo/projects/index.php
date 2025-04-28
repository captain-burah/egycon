
<?php
    //START SESSION
    session_start();
    require_once __DIR__ . '/../config.php';

    //CHECK FOR SESSION MESSAGES
    if(isset($_SESSION["ack_message"])) {
        if($_SESSION["ack_message"] == 'success'){
        $ack_message = "success";
        } else{
        $ack_message = $_SESSION["ack_message"];
        }

        //UNSET IT AFTER ASSIGNING TO VARIABLE
        unset($_SESSION["ack_message"]);
    } else {
        $ack_message = "";
    }



    function loadProjectData() {
        if (!file_exists('../admin/projects.json')) {
            return ['projects' => []];
        }
        $json = file_get_contents('../admin/projects.json');
        return json_decode($json, true);
    }

    $projects = loadProjectData();


    function loadContactData() {
        if (!file_exists('../admin/contacts.json')) {
            return ['projects' => []];
        }
        $json = file_get_contents('../admin/contacts.json');
        return json_decode($json, true);
    }

    $contacts = loadContactData();

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="reiGj5fzzdJrr5w8ipkOZUYNtNR7geEUInIysUzf" />
        <link rel="shortcut icon" href="images/favicon.png">

        <!--TITLE & DESCRIPTIONS-->
        <title lang="en-us">Construction Projects in Dubai | Egycon Contracting</title>
        <meta name="description" content="Explore Egycon Contracting's impressive portfolio of completed construction projects in Dubai. We showcase our expertise in various construction types, including residential buildings, commercial spaces, and more. Get inspired by our successful projects and see how we can bring your vision to life">
        <meta name="author" content="Egycon Contracting">
        <link rel="canonical" href="https://egycontracting.com" />
        
        <!-- ESSENTIAL OG TAGS -->
        <meta property="og:title" content="Construction Projects in Dubai | Egycon Contracting">
        <meta property="og:type" content="website" />
        <meta property="og:image" content="../assets/img/og/5.webp">
        <meta property="og:url" content="https://egycontracting.com/projects">
        <meta name="twitter:card" content="summary_large_image">


        <!--  NON-ESSENTIAL OG TAGS -->
        <meta property="og:description" content="Explore Egycon Contracting's impressive portfolio of completed construction projects in Dubai. We showcase our expertise in various construction types, including residential buildings, commercial spaces, and more. Get inspired by our successful projects and see how we can bring your vision to life">
        <meta property="og:site_name" content="Construction Projects in Dubai | Egycon Contracting">
        <meta name="twitter:image:alt" content="">

        <!--CANONICAL LINKS-->
        <link rel="canonical" href="https://egycontracting.com" hreflang="en">
        

		<!-- CSS here -->
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="../assets/css/gijgo.css">
            <link rel="stylesheet" href="../assets/css/slicknav.css">
            <link rel="stylesheet" href="../assets/css/animate.min.css">
            <link rel="stylesheet" href="../assets/css/magnific-popup.css">
            <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="../assets/css/themify-icons.css">
            <link rel="stylesheet" href="../assets/css/slick.css">
            <link rel="stylesheet" href="../assets/css/nice-select.css">
            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="stylesheet" href="../assets/css/responsive.css">


            <style>
                p, a, li, span, .footer-copy-right, .postcard__preview-txt{
                    font-family: "josefin", sans-serif !important;
                    font-size: 18px !important;
                    line-height: 1.5;
                }

                h1, h2, h3, h4, {
                    font-family: "josefin", sans-serif !important;
                    font-weight: 100 !important;
                }

                .hero-overly2{
                    position:relative
                    ;z-index:1
                }

                .hero-overly2::before{
                    position:absolute;
                    content:"";
                    background:radial-gradient(circle, rgba(0,0,0,0.38139005602240894) 0%, rgba(0,0,0,0.6895133053221288) 100%);
                    width:100%;
                    height:100%;
                    left:0;
                    top:0;
                    bottom:0;
                    right:0;
                    z-index:-1;
                    background-repeat:no-repeat
                }
                .grecaptcha-badge{
                    visibility: hidden !important;
                }
            </style>
   </head>

   <body>
    
    
    <header>
        <!-- Header Start -->
       <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-top d-none d-lg-block hero-overly2">
                   <div class="container-fluid">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>     
                                        <li><a href="tel:<?php echo htmlspecialchars($contacts['contacts'][0]['phone']); ?>" style="color: #fff !important;" rel="nofollow" title="Call Us"><?php echo htmlspecialchars($contacts['contacts'][0]['phone']); ?></a></li>
                                        <li><a href="mailto:<?php echo htmlspecialchars($contacts['contacts'][0]['email']); ?>" style="color: #fff !important;" rel="nofollow" title="Email Us"><?php echo htmlspecialchars($contacts['contacts'][0]['email']); ?></a></li>
                                        <li><?php echo htmlspecialchars($contacts['contacts'][0]['working_hours']); ?></li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">    
                                        <li><a href="https://www.instagram.com/egycondubai/" rel="nofollow" title="Our Instgram" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.facebook.com/people/Egycon-Contracting/100089927895882/" rel="nofollow" title="Our Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
               <div class="header-bottom  header-sticky" style="background-color: rgb(255,255,255) !important;">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo">
                                    <!-- logo-1 -->
                                    <a href="../index.html" rel="canonical" title="Home Page" class="big-logo">
                                        <img src="../assets/img/logo/logo_orig.png" alt="home-page" title="Home" height="auto" width="auto" loading="eager">
                                    </a>
                                    <!-- logo-2 -->
                                    <a href="../index.html" style="height: 10px !important;" rel="canonical" title="Home Page" class="small-logo">
                                        <img src="../assets/img/logo/loder-logo.png" alt="home-page" title="Home" height="auto" width="auto" loading="eager">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav> 
                                        <ul id="navigation">                                                                                                                   
                                            <li><a class="text-dark" rel="canonical" title="Home Page" href="../">Home</a></li>
                                            <li><a class="text-dark" rel="canonical" title="About Us Page" href="../about/">About</a></li>
                                            <li><a class="text-dark" rel="canonical" title="Projects Page" href="../projects/">Projects</a></li>
                                            <li><a class="text-dark" rel="canonical" title="Services Page" href="../services/">Services</a></li>
                                            <li><a class="text-dark" rel="canonical" title="Contact Us Page" href="../contact/">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>             
                            <div class="col-xl-2 col-lg-2 col-md-3">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <button title="Contact Modal" class="btn" data-toggle="modal" data-target="#contactModal">
                                        Contact Now
                                    </button>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->

        <!-- Modal -->
        <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title" id="exampleModalLabel">
                            Contact Now
                        </span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" action="../contact.php" method="POST" id="contact-form-modal">
                        
                            <div class="card-body py-0">
                                <p class="text-center">
                                    Get in touch with us. Our team is ready to assist you with your construction needs and inquiries.
                                </p>

                                <div class="form-group">
                                    <input type="text" id="modalName" name="modalName" class="form-control" placeholder="Full Name" required="true" autofocus="true" maxlength="30"> 
                                </div>

                                <div class="form-group">
                                    <input type="email" id="modalEmail" name="modalEmail" class="form-control" placeholder="Email Address" required="true" autofocus="true" maxlength="40"> 
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-5 pr-1">
                                            <style>
                                                select{
                                                    padding: 0;
                                                }
                                                .nice-select > ul.list {
                                                    height: 200px !important;
                                                    overflow: auto !important;
                                                }
                                            </style>
                                            <select class="form-control" name="modalCountryCode">
        
                                                <option value="" selected="selected">Country Code</option>
                    
                                                <option value="Afghanistan	-	+93">Afghanistan	-	+93</option>
                            
                                                <option value="Albania	-	+355">Albania	-	+355</option>
                            
                                                <option value="Algeria	-	+213">Algeria	-	+213</option>
                            
                                                <option value="American Samoa	-	+1">American Samoa	-	+1</option>
                            
                                                <option value="Andorra	-	+376">Andorra	-	+376</option>
                            
                                                <option value="Angola	-	+244">Angola	-	+244</option>
                            
                                                <option value="Anguilla	-	+1">Anguilla	-	+1</option>
                            
                                                <option value="Antigua and Barbuda	-	+1">Antigua and Barbuda	-	+1</option>
                            
                                                <option value="Argentina	-	+54">Argentina	-	+54</option>
                            
                                                <option value="Armenia	-	+374">Armenia	-	+374</option>
                            
                                                <option value="Aruba	-	+297">Aruba	-	+297</option>
                            
                                                <option value="Ascension	-	+247">Ascension	-	+247</option>
                            
                                                <option value="Australia	-	+61">Australia	-	+61</option>
                            
                                                <option value="Austria	-	+43">Austria	-	+43</option>
                            
                                                <option value="Azerbaijan	-	+994">Azerbaijan	-	+994</option>
                            
                                                <option value="Bahamas	-	+1">Bahamas	-	+1</option>
                            
                                                <option value="Bahrain	-	+973">Bahrain	-	+973</option>
                            
                                                <option value="Bangladesh	-	+880">Bangladesh	-	+880</option>
                            
                                                <option value="Barbados	-	+1">Barbados	-	+1</option>
                            
                                                <option value="Belarus	-	+375">Belarus	-	+375</option>
                            
                                                <option value="Belgium	-	+32">Belgium	-	+32</option>
                            
                                                <option value="Belize	-	+501">Belize	-	+501</option>
                            
                                                <option value="Benin	-	+229">Benin	-	+229</option>
                            
                                                <option value="Bermuda	-	+1">Bermuda	-	+1</option>
                            
                                                <option value="Bhutan	-	+975">Bhutan	-	+975</option>
                            
                                                <option value="Bolivia	-	+591">Bolivia	-	+591</option>
                            
                                                <option value="Bosnia and Herzegovina	-	+387">Bosnia and Herzegovina	-	+387</option>
                            
                                                <option value="Botswana	-	+267">Botswana	-	+267</option>
                            
                                                <option value="Brazil	-	+55">Brazil	-	+55</option>
                            
                                                <option value="British Virgin Islands	-	+1">British Virgin Islands	-	+1</option>
                            
                                                <option value="Brunei	-	+673">Brunei	-	+673</option>
                            
                                                <option value="Bulgaria	-	+359">Bulgaria	-	+359</option>
                            
                                                <option value="Burkina Faso	-	+226">Burkina Faso	-	+226</option>
                            
                                                <option value="Burundi	-	+257">Burundi	-	+257</option>
                            
                                                <option value="Cambodia	-	+855">Cambodia	-	+855</option>
                            
                                                <option value="Cameroon	-	+237">Cameroon	-	+237</option>
                            
                                                <option value="Canada	-	+1">Canada	-	+1</option>
                            
                                                <option value="Cape Verde	-	+238">Cape Verde	-	+238</option>
                            
                                                <option value="Cayman Islands	-	+1">Cayman Islands	-	+1</option>
                            
                                                <option value="Central African Republic	-	+236">Central African Republic	-	+236</option>
                            
                                                <option value="Chad	-	+235">Chad	-	+235</option>
                            
                                                <option value="Chile	-	+56">Chile	-	+56</option>
                            
                                                <option value="China	-	+86">China	-	+86</option>
                            
                                                <option value="Colombia	-	+57">Colombia	-	+57</option>
                            
                                                <option value="Comoros	-	+269">Comoros	-	+269</option>
                            
                                                <option value="Congo	-	+242">Congo	-	+242</option>
                            
                                                <option value="Cook Islands	-	+682">Cook Islands	-	+682</option>
                            
                                                <option value="Costa Rica	-	+506">Costa Rica	-	+506</option>
                            
                                                <option value="Croatia	-	+385">Croatia	-	+385</option>
                            
                                                <option value="Cuba	-	+53">Cuba	-	+53</option>
                            
                                                <option value="Curacao	-	+599">Curacao	-	+599</option>
                            
                                                <option value="Cyprus	-	+357">Cyprus	-	+357</option>
                            
                                                <option value="Czech Republic	-	+420">Czech Republic	-	+420</option>
                            
                                                <option value="Democratic Republic of Congo	-	+243">Democratic Republic of Congo	-	+243</option>
                            
                                                <option value="Denmark	-	+45">Denmark	-	+45</option>
                            
                                                <option value="Diego Garcia	-	+246">Diego Garcia	-	+246</option>
                            
                                                <option value="Djibouti	-	+253">Djibouti	-	+253</option>
                            
                                                <option value="Dominica	-	+1">Dominica	-	+1</option>
                            
                                                <option value="Dominican Republic	-	+1">Dominican Republic	-	+1</option>
                            
                                                <option value="East Timor	-	+670">East Timor	-	+670</option>
                            
                                                <option value="Ecuador	-	+593">Ecuador	-	+593</option>
                            
                                                <option value="Egypt	-	+20">Egypt	-	+20</option>
                            
                                                <option value="El Salvador	-	+503">El Salvador	-	+503</option>
                            
                                                <option value="Equatorial Guinea	-	+240">Equatorial Guinea	-	+240</option>
                            
                                                <option value="Eritrea	-	+291">Eritrea	-	+291</option>
                            
                                                <option value="Estonia	-	+372">Estonia	-	+372</option>
                            
                                                <option value="Ethiopia	-	+251">Ethiopia	-	+251</option>
                            
                                                <option value="Falkland (Malvinas) Islands	-	+500">Falkland (Malvinas) Islands	-	+500</option>
                            
                                                <option value="Faroe Islands	-	+298">Faroe Islands	-	+298</option>
                            
                                                <option value="Fiji	-	+679">Fiji	-	+679</option>
                            
                                                <option value="Finland	-	+358">Finland	-	+358</option>
                            
                                                <option value="France	-	+33">France	-	+33</option>
                            
                                                <option value="French Guiana	-	+594">French Guiana	-	+594</option>
                            
                                                <option value="French Polynesia	-	+689">French Polynesia	-	+689</option>
                            
                                                <option value="Gabon	-	+241">Gabon	-	+241</option>
                            
                                                <option value="Gambia	-	+220">Gambia	-	+220</option>
                            
                                                <option value="Georgia	-	+995">Georgia	-	+995</option>
                            
                                                <option value="Germany	-	+49">Germany	-	+49</option>
                            
                                                <option value="Ghana	-	+233">Ghana	-	+233</option>
                            
                                                <option value="Gibraltar	-	+350">Gibraltar	-	+350</option>
                            
                                                <option value="Greece	-	+30">Greece	-	+30</option>
                            
                                                <option value="Greenland	-	+299">Greenland	-	+299</option>
                            
                                                <option value="Grenada	-	+1">Grenada	-	+1</option>
                            
                                                <option value="Guadeloupe	-	+590">Guadeloupe	-	+590</option>
                            
                                                <option value="Guam	-	+1">Guam	-	+1</option>
                            
                                                <option value="Guatemala	-	+502">Guatemala	-	+502</option>
                            
                                                <option value="Guinea	-	+224">Guinea	-	+224</option>
                            
                                                <option value="Guinea-Bissau	-	+245">Guinea-Bissau	-	+245</option>
                            
                                                <option value="Guyana	-	+592">Guyana	-	+592</option>
                            
                                                <option value="Haiti	-	+509">Haiti	-	+509</option>
                            
                                                <option value="Honduras	-	+504">Honduras	-	+504</option>
                            
                                                <option value="Hong Kong	-	+852">Hong Kong	-	+852</option>
                            
                                                <option value="Hungary	-	+36">Hungary	-	+36</option>
                            
                                                <option value="Iceland	-	+354">Iceland	-	+354</option>
                            
                                                <option value="India	-	+91">India	-	+91</option>
                            
                                                <option value="Indonesia	-	+62">Indonesia	-	+62</option>
                            
                                                <option value="Inmarsat Satellite	-	+870">Inmarsat Satellite	-	+870</option>
                            
                                                <option value="Iran	-	+98">Iran	-	+98</option>
                            
                                                <option value="Iraq	-	+964">Iraq	-	+964</option>
                            
                                                <option value="Ireland	-	+353">Ireland	-	+353</option>
                            
                                                <option value="Israel	-	+972">Israel	-	+972</option>
                            
                                                <option value="Italy	-	+39">Italy	-	+39</option>
                            
                                                <option value="Ivory Coast	-	+225">Ivory Coast	-	+225</option>
                            
                                                <option value="Jamaica	-	+1">Jamaica	-	+1</option>
                            
                                                <option value="Japan	-	+81">Japan	-	+81</option>
                            
                                                <option value="Jordan	-	+962">Jordan	-	+962</option>
                            
                                                <option value="Kazakhstan	-	+7">Kazakhstan	-	+7</option>
                            
                                                <option value="Kenya	-	+254">Kenya	-	+254</option>
                            
                                                <option value="Kiribati	-	+686">Kiribati	-	+686</option>
                            
                                                <option value="Kuwait	-	+965">Kuwait	-	+965</option>
                            
                                                <option value="Kyrgyzstan	-	+996">Kyrgyzstan	-	+996</option>
                            
                                                <option value="Laos	-	+856">Laos	-	+856</option>
                            
                                                <option value="Latvia	-	+371">Latvia	-	+371</option>
                            
                                                <option value="Lebanon	-	+961">Lebanon	-	+961</option>
                            
                                                <option value="Lesotho	-	+266">Lesotho	-	+266</option>
                            
                                                <option value="Liberia	-	+231">Liberia	-	+231</option>
                            
                                                <option value="Libya	-	+218">Libya	-	+218</option>
                            
                                                <option value="Liechtenstein	-	+423">Liechtenstein	-	+423</option>
                            
                                                <option value="Lithuania	-	+370">Lithuania	-	+370</option>
                            
                                                <option value="Luxembourg	-	+352">Luxembourg	-	+352</option>
                            
                                                <option value="Macau	-	+853">Macau	-	+853</option>
                            
                                                <option value="Macedonia	-	+389">Macedonia	-	+389</option>
                            
                                                <option value="Madagascar	-	+261">Madagascar	-	+261</option>
                            
                                                <option value="Malawi	-	+265">Malawi	-	+265</option>
                            
                                                <option value="Malaysia	-	+60">Malaysia	-	+60</option>
                            
                                                <option value="Maldives	-	+960">Maldives	-	+960</option>
                            
                                                <option value="Mali	-	+223">Mali	-	+223</option>
                            
                                                <option value="Malta	-	+356">Malta	-	+356</option>
                            
                                                <option value="Marshall Islands	-	+692">Marshall Islands	-	+692</option>
                            
                                                <option value="Martinique	-	+596">Martinique	-	+596</option>
                            
                                                <option value="Mauritania	-	+222">Mauritania	-	+222</option>
                            
                                                <option value="Mauritius	-	+230">Mauritius	-	+230</option>
                            
                                                <option value="Mayotte	-	+262">Mayotte	-	+262</option>
                            
                                                <option value="Mexico	-	+52">Mexico	-	+52</option>
                            
                                                <option value="Micronesia	-	+691">Micronesia	-	+691</option>
                            
                                                <option value="Moldova	-	+373">Moldova	-	+373</option>
                            
                                                <option value="Monaco	-	+377">Monaco	-	+377</option>
                            
                                                <option value="Mongolia	-	+976">Mongolia	-	+976</option>
                            
                                                <option value="Montenegro	-	+382">Montenegro	-	+382</option>
                            
                                                <option value="Montserrat	-	+1">Montserrat	-	+1</option>
                            
                                                <option value="Morocco	-	+212">Morocco	-	+212</option>
                            
                                                <option value="Mozambique	-	+258">Mozambique	-	+258</option>
                            
                                                <option value="Myanmar	-	+95">Myanmar	-	+95</option>
                            
                                                <option value="Namibia	-	+264">Namibia	-	+264</option>
                            
                                                <option value="Nauru	-	+674">Nauru	-	+674</option>
                            
                                                <option value="Nepal	-	+977">Nepal	-	+977</option>
                            
                                                <option value="Netherlands	-	+31">Netherlands	-	+31</option>
                            
                                                <option value="Netherlands Antilles	-	+599">Netherlands Antilles	-	+599</option>
                            
                                                <option value="New Caledonia	-	+687">New Caledonia	-	+687</option>
                            
                                                <option value="New Zealand	-	+64">New Zealand	-	+64</option>
                            
                                                <option value="Nicaragua	-	+505">Nicaragua	-	+505</option>
                            
                                                <option value="Niger	-	+227">Niger	-	+227</option>
                            
                                                <option value="Nigeria	-	+234">Nigeria	-	+234</option>
                            
                                                <option value="Niue	-	+683">Niue	-	+683</option>
                            
                                                <option value="Norfolk Island	-	+6723">Norfolk Island	-	+6723</option>
                            
                                                <option value="North Korea	-	+850">North Korea	-	+850</option>
                            
                                                <option value="Northern Marianas	-	+1">Northern Marianas	-	+1</option>
                            
                                                <option value="Norway	-	+47">Norway	-	+47</option>
                            
                                                <option value="Oman	-	+968">Oman	-	+968</option>
                            
                                                <option value="Pakistan	-	+92">Pakistan	-	+92</option>
                            
                                                <option value="Palau	-	+680">Palau	-	+680</option>
                            
                                                <option value="Palestine	-	+970">Palestine	-	+970</option>
                            
                                                <option value="Panama	-	+507">Panama	-	+507</option>
                            
                                                <option value="Papua New Guinea	-	+675">Papua New Guinea	-	+675</option>
                            
                                                <option value="Paraguay	-	+595">Paraguay	-	+595</option>
                            
                                                <option value="Peru	-	+51">Peru	-	+51</option>
                            
                                                <option value="Philippines	-	+63">Philippines	-	+63</option>
                            
                                                <option value="Poland	-	+48">Poland	-	+48</option>
                            
                                                <option value="Portugal	-	+351">Portugal	-	+351</option>
                            
                                                <option value="Puerto Rico	-	+1">Puerto Rico	-	+1</option>
                            
                                                <option value="Qatar	-	+974">Qatar	-	+974</option>
                            
                                                <option value="Reunion	-	+262">Reunion	-	+262</option>
                            
                                                <option value="Romania	-	+40">Romania	-	+40</option>
                            
                                                <option value="Russian Federation	-	+7">Russian Federation	-	+7</option>
                            
                                                <option value="Rwanda	-	+250">Rwanda	-	+250</option>
                            
                                                <option value="Saint Helena	-	+290">Saint Helena	-	+290</option>
                            
                                                <option value="Saint Kitts and Nevis	-	+1">Saint Kitts and Nevis	-	+1</option>
                            
                                                <option value="Saint Lucia	-	+1">Saint Lucia	-	+1</option>
                            
                                                <option value="Saint Barthelemy	-	+590">Saint Barthelemy	-	+590</option>
                            
                                                <option value="Saint Martin (French part)	-	+590">Saint Martin (French part)	-	+590</option>
                            
                                                <option value="Saint Pierre and Miquelon	-	+508">Saint Pierre and Miquelon	-	+508</option>
                            
                                                <option value="Saint Vincent and the Grenadines	-	+1">Saint Vincent and the Grenadines	-	+1</option>
                            
                                                <option value="Samoa	-	+685">Samoa	-	+685</option>
                            
                                                <option value="San Marino	-	+378">San Marino	-	+378</option>
                            
                                                <option value="Sao Tome and Principe	-	+239">Sao Tome and Principe	-	+239</option>
                            
                                                <option value="Saudi Arabia	-	+966">Saudi Arabia	-	+966</option>
                            
                                                <option value="Senegal	-	+221">Senegal	-	+221</option>
                            
                                                <option value="Serbia	-	+381">Serbia	-	+381</option>
                            
                                                <option value="Seychelles	-	+248">Seychelles	-	+248</option>
                            
                                                <option value="Sierra Leone	-	+232">Sierra Leone	-	+232</option>
                            
                                                <option value="Singapore	-	+65">Singapore	-	+65</option>
                            
                                                <option value="Sint Maarten	-	+1">Sint Maarten	-	+1</option>
                            
                                                <option value="Slovakia	-	+421">Slovakia	-	+421</option>
                            
                                                <option value="Slovenia	-	+386">Slovenia	-	+386</option>
                            
                                                <option value="Solomon Islands	-	+677">Solomon Islands	-	+677</option>
                            
                                                <option value="Somalia	-	+252">Somalia	-	+252</option>
                            
                                                <option value="South Africa	-	+27">South Africa	-	+27</option>
                            
                                                <option value="South Korea	-	+82">South Korea	-	+82</option>
                            
                                                <option value="South Sudan	-	+211">South Sudan	-	+211</option>
                            
                                                <option value="Spain	-	+34">Spain	-	+34</option>
                            
                                                <option value="Sri Lanka	-	+94">Sri Lanka	-	+94</option>
                            
                                                <option value="Sudan	-	+249">Sudan	-	+249</option>
                            
                                                <option value="Suriname	-	+597">Suriname	-	+597</option>
                            
                                                <option value="Swaziland	-	+268">Swaziland	-	+268</option>
                            
                                                <option value="Sweden	-	+46">Sweden	-	+46</option>
                            
                                                <option value="Switzerland	-	+41">Switzerland	-	+41</option>
                            
                                                <option value="Syria	-	+963">Syria	-	+963</option>
                            
                                                <option value="Taiwan	-	+886">Taiwan	-	+886</option>
                            
                                                <option value="Tajikistan	-	+992">Tajikistan	-	+992</option>
                            
                                                <option value="Tanzania	-	+255">Tanzania	-	+255</option>
                            
                                                <option value="Thailand	-	+66">Thailand	-	+66</option>
                            
                                                <option value="Togo	-	+228">Togo	-	+228</option>
                            
                                                <option value="Tokelau	-	+690">Tokelau	-	+690</option>
                            
                                                <option value="Tonga	-	+676">Tonga	-	+676</option>
                            
                                                <option value="Trinidad and Tobago	-	+1">Trinidad and Tobago	-	+1</option>
                            
                                                <option value="Tunisia	-	+216">Tunisia	-	+216</option>
                            
                                                <option value="Turkey	-	+90">Turkey	-	+90</option>
                            
                                                <option value="Turkmenistan	-	+993">Turkmenistan	-	+993</option>
                            
                                                <option value="Turks and Caicos Islands	-	+1">Turks and Caicos Islands	-	+1</option>
                            
                                                <option value="Tuvalu	-	+688">Tuvalu	-	+688</option>
                            
                                                <option value="Uganda	-	+256">Uganda	-	+256</option>
                            
                                                <option value="Ukraine	-	+380">Ukraine	-	+380</option>
                            
                                                <option value="UAE	-	+971">UAE	-	+971</option>
                            
                                                <option value="United Kingdom	-	+44">United Kingdom	-	+44</option>
                            
                                                <option value="United States of America	-	+1">United States of America	-	+1</option>
                            
                                                <option value="U.S. Virgin Islands	-	+1">U.S. Virgin Islands	-	+1</option>
                            
                                                <option value="Uruguay	-	+598">Uruguay	-	+598</option>
                            
                                                <option value="Uzbekistan	-	+998">Uzbekistan	-	+998</option>
                            
                                                <option value="Vanuatu	-	+678">Vanuatu	-	+678</option>
                            
                                                <option value="Vatican City	-	+379/ +39">Vatican City	-	+379/ +39</option>
                            
                                                <option value="Venezuela	-	+58">Venezuela	-	+58</option>
                            
                                                <option value="Vietnam	-	+84">Vietnam	-	+84</option>
                            
                                                <option value="Wallis and Futuna	-	+681">Wallis and Futuna	-	+681</option>
                            
                                                <option value="Yemen	-	+967">Yemen	-	+967</option>
                            
                                                <option value="Zambia	-	+260">Zambia	-	+260</option>
                            
                                                <option value="Zimbabwe	-	+263">Zimbabwe	-	+263</option>
                            
                                            </select>
                                        </div>

                                        <div class="col-md-7 pl-1">
                                            <input type="text" id="modalPhone" name="modalPhone" class="form-control" placeholder="eg. 501234567" required="true" autofocus="true">                                         
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control" id="modalMsg" name="modalMsg" placeholder="Place your inquiry here" rows="2" maxlength="100" required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="button" class="g-recaptcha btn btn-block py-3"
                                        data-sitekey="6Ld3GOkpAAAAAGLWMQFoWP6w0zFir5GWmNjwJhTS" 
                                        data-callback='onSubmit' 
                                        data-action='submit'
                                        value="Submit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary py-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </header>




    <main>
        <!-- slider Area Start-->
        <div class="slider-area ">
            <div class="single-slider hero-overly2 slider-height2 d-flex align-items-center" data-background="../assets/img/banner/1.webp">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap pt-100">
                                <h1 class="font-weight-bold" style="color: #fff !important; font-size: 4rem">Projects</h1>
                                <!-- <h2>Our projects</h2> -->
                                <nav aria-label="breadcrumb ">
                                    <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a style="color: #fff !important;" href="../" rel="canonical" title="Home Page" >Home</a></li>
                                    <li class="breadcrumb-item"><a style="color: #fff !important;">Project</a></li> 
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->


        <!-- Project Area Start -->
        <section class="project-area  py-5">
            <div class="container">
                <div class="project-heading mb-35">
                    <div class="row align-items-end">
                        <div class="col-lg-12">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle3">
                                <div class="front-text">
                                    <!-- <h2>Our Successful Ventures</h2> -->
                                </div>
                                <p>At Egycon Contracting LLC, our project portfolio reflects our unwavering commitment to excellence, innovation, and quality. From residential towers and commercial complexes to industrial facilities and public infrastructure, each project showcases our ability to deliver superior construction solutions tailored to meet the unique needs of our clients. Explore our diverse range of projects and witness the dedication, expertise, and craftsmanship that define our work.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    if (isset($projects['projects']) && is_array($projects['projects'])) {
                        foreach ($projects['projects'] as $index => $project) {
                            ?>
                                <div class="row text-center mx-auto mb-4">
                                    <div class="col-md-10 mx-auto">
                                        <div class="card shadow-sm">
                                            <div class="row">
                                            <div class="col-sm-3">
                                                <img class="d-block w-100 h-100" src="../assets/img/project/<?php echo htmlspecialchars($project['img']); ?>" alt="egycon-project-image-01" title="egycon-project-image-01" height="auto" width="auto" loading="lazy">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="card-body h-100">
                                                    <div class="d-flex align-items-start flex-column">
                                                        <div class="p-2">
                                                            <h2 class="text-left fw-light"><?php echo htmlspecialchars($project['name']); ?></h4>
                                                        </div>
                                                        <div class="p-2">
                                                            <p class="text-left">
                                                            <?php echo htmlspecialchars($project['description']); ?>
                                                            </p>
                                                        </div>
                                                        <div class="mt-auto p-2">
                                                            <p class="m-0"><?php echo htmlspecialchars($project['location']); ?></p>
                                                        </div>
                                                    </div>                            
                                                </div>
                                            </div>
                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6">No projects found.</td></tr>';
                    }
                ?>

            
                
            </div>
        </section>
        <!-- Project Area End -->
    </main>


    
    <footer>
        <!-- Footer Start-->
        <div class="footer-main border" style="background-color: rgb(255,255,255) !important;">
            <div class="footer-padding text-dark" style="background-color: rgb(255,255,255) !important;">
                <div class="container">
                    <div class="row justify-content-between align-items-stretch"> <!-- Added 'align-items-stretch' -->
                        <div class="col-lg-4 col-md-4 col-sm-8 d-flex"> <!-- Added 'd-flex' -->
                            <div class="single-footer-caption mb-30 flex-grow-1"> <!-- Added 'flex-grow-1' -->
                                <!-- logo -->
                                <div class="footer-logo mb-4">
                                    <a href="/">
                                        <img src="../assets/img/logo/logo_orig.png" alt="egycon-logo-footer" title="egycon-logo-footer" height="auto" width="auto" loading="lazy">
                                    </a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p class="info1">
                                            With a foundation built on integrity, innovation, 
                                            and quality, we strive to exceed expectations 
                                            and contribute to the architectural landscape 
                                        </p>
                                        <!-- <a href="https://www.facebook.com/people/Egycon-Contracting/100089927895882/" rel="nofollow"class="text-dark" title="Our Instgram" target="_blank"><i class="fab fa-instagram"></i></a>
                                        &nbsp;
                                        <a href="https://www.instagram.com/egycondubai/" rel="nofollow" title="Our Facebook"class="text-dark" target="_blank"><i class="fab fa-facebook-f"></i></a> -->
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-5 d-flex"> <!-- Added 'd-flex' -->
                            <div class="single-footer-caption mb-50 flex-grow-1"> <!-- Added 'flex-grow-1' -->
                                <div class="footer-tittle">
                                    <h4 class="text-dark">Links</h4>
                                    <ul>
                                        <li  style="line-height: 2 !important;"><a class="text-dark" href="../about/" title="About Us" rel="canonical">About</a></li>
                                        <li  style="line-height: 2 !important;"><a class="text-dark" href="../services/" title="Services" rel="canonical">Services</a></li>
                                        <li  style="line-height: 2 !important;"><a class="text-dark" href="../projects/" title="Projects" rel="canonical">Projects</a></li>
                                        <li  style="line-height: 2 !important;"><a class="text-dark" href="../contact/" title="Contact Us" rel="canonical">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-7 d-flex"> <!-- Added 'd-flex' -->
                            <div class="single-footer-caption mb-50 flex-grow-1"> <!-- Added 'flex-grow-1' -->
                                <div class="footer-tittle">
                                    <h4 class="text-dark">Contact</h4>
                                    <div class="footer-pera">
                                        <p class="info1 text-dark" style="line-height: 1.3;">
                                            Office 104, Ras Al Khor Industrial Area 2, Dubai, United Arab Emirates
                                        </p>
                                    </div>
                                    <ul>
                                        <li><a class="text-dark" href="mailto:info@egycontracting.com" title="Email Us" rel="nofollow">info@egycontracting.com</a></li>
                                        <li><a class="text-dark" href="tel:+97143881856" title="Call Us" rel="nofollow">Phone: (+971) 4 388 1856</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-8 d-flex"> <!-- Added 'd-flex' -->
                            <div class="single-footer-caption mb-50 flex-grow-1"> <!-- Added 'flex-grow-1' -->
                                <!-- Map -->
                                <div class="map-footer">
                                    <img src="../assets/img/gallery/world-map-icon.svg" alt="egycon-map-footer" title="egycon-map-footer" height="auto" width="auto" loading="lazy">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Copy-Right -->
                    <div class="row align-items-center justify-content--between mt-4">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> | <a href="../privacy-policy/" class="text-dark">Privacy Policy</a> | All rights reserved | Egycon Contracting LLC

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="../assets/js/popper.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.slicknav.min.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/slick.min.js"></script>
        <script src="../assets/js/gijgo.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
		<script src="../assets/js/animated.headline.js"></script>
        <script src="../assets/js/jquery.magnific-popup.js"></script>
        <script src="../assets/js/jquery.scrollUp.min.js"></script>
        <script src="../assets/js/jquery.nice-select.min.js"></script>
		<script src="../assets/js/jquery.sticky.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
        <script src="../assets/js/jquery.counterup.min.js"></script>
        <script src="../assets/js/contact.js"></script>
        <script src="../assets/js/jquery.form.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script src="../assets/js/mail-script.js"></script>
        <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
        <script src="../assets/js/plugins.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?render=6Ld3GOkpAAAAAGLWMQFoWP6w0zFir5GWmNjwJhTS"></script>
        <script>
            function onSubmit(token) {
                console.log('fhdkslaa');
                var button = document.createElement('input');
                button.type = 'hidden';
                button.name = 'recaptcha_token';
                button.value = token;

                var form = document.getElementById("contact-form-modal");
                form.appendChild(button);
                form.submit();
            }

        </script>

        
    </body>
</html>