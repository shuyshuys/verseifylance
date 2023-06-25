<?php
include_once('./pages/auth/koneksi.php');
include_once('./pages/auth/auth.php');

// if isset session user
if (isset($_SESSION['user'])) {
    $query = "select 
f.FULL_NAME as FREELANCER_NAME,
c.FULL_NAME as CUSTOMER_NAME,
u.`ROLE` as role
from users u 
left join freelancers f ON f.ID_USER = u.ID_USER 
left join customers c on c.ID_USER = u.ID_USER
WHERE u.ID_USER=" . $_SESSION['user']['ID_USER'] . "";

    $result = mysqli_query($koneksi, $query);
    $userLogin = mysqli_fetch_assoc($result);
}

$query = "SELECT count(ID_ORDER) FROM orders o JOIN payments p ON p.ID_PAYMENT = o.ID_PAYMENT where ID_CUSTOMER = 1101 and p.STATUS = 0";
$result = mysqli_query($koneksi, $query);
$orderCount = mysqli_fetch_assoc($result)['count(ID_ORDER)'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Verseifylance</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/images/favicon.ico" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="./assets/css/core/libs.min.css" />


    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="./assets/css/hope-ui.min.css?v=2.0.0" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="./assets/css/custom.min.css?v=2.0.0" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="./assets/css/dark.min.css" />

    <!-- Customizer Css -->
    <link rel="stylesheet" href="./assets/css/customizer.min.css" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="./assets/css/rtl.min.css" />

    <!-- Flatpickr css -->
    <link rel="stylesheet" href="./assets/vendor/flatpickr/dist/flatpickr.min.css" />

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WNGH9RL');
        window.tag_manager_event = 'dashboard-free-preview';
        window.tag_manager_product = 'HopeUI';
    </script>
    <!-- End Google Tag Manager -->

</head>

<body class="uikit " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <span class="uisheet screen-darken"></span>
        <div class="header" style="background: url('./assets/images/dashboard/top-image.jpg'); background-size: cover; background-repeat: no-repeat; height: 100vh;position: relative;">
            <div class="main-img">
                <div class="container">
                    <h1 class="my-4">
                        <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="15" r="15" fill="" />
                            <path d="M10 10L15 20L20 10" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
                            <circle cx="15" cy="15" r="2" fill="#FFFFFF" />
                        </svg>


                        <span>VerseifyLance</span>
                    </h1>
                    <h4 class="mb-5 text-white">Boost your freelance career with us <br> The ultimate
                        platform to <br><b>showcase</b> your talents, <b>connect</b> with clients, and <b>unleash your
                            earning potential!</b>.</h4>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="ms-3">
                            <form action="pages/auth/sign-up" method="get" class="sign-up-form d-flex" data-aos="fade-up" data-aos-delay="300">
                                <input type="email" class="form-control" placeholder="Enter email address" name="email">
                                <input type="submit" class="btn btn-primary ms-1" value="Sign up" name="submit">
                            </form>
                        </div>
                        <div class="ms-3 lh-1">
                            <a class="d-flex github-button" target="_blank" href="https://github.com/shuyshuys/verseifylance"
                            data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star shuyshuys/verseifylance on GitHub"
                            >
                                <img src="./assets/images/brands/23.png" width="24px" height="24px">
                                <span class="mx-2 text-danger fw-bold">
                                    STAR US</span>
                                <span>ON GITHUB</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <nav class="rounded nav navbar navbar-expand-lg navbar-light top-1">
                    <div class="container-fluid">
                        <a class="mx-2 navbar-brand" href="#">
                            <!--Logo start-->
                            <!--logo End-->

                            <!--Logo start-->
                            <div class="logo-main">
                                <div class="logo-normal">
                                    <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="15" cy="15" r="15" fill="#FFFFFF" />
                                        <path d="M10 10L15 20L20 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        <circle cx="15" cy="15" r="2" fill="currentColor" />
                                    </svg>
                                </div>
                                <div class="logo-mini">
                                    <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="15" cy="15" r="15" fill="#FFFFFF" />
                                        <path d="M10 10L15 20L20 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        <circle cx="15" cy="15" r="2" fill="currentColor" />
                                    </svg>
                                </div>
                            </div>
                            <!--logo End-->




                            <h5 class="logo-title">VerseifyLance</h5>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-2" aria-controls="navbar-2" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar-2">
                            <ul class="mb-2 navbar-nav ms-auto mb-lg-0 d-flex align-items-start align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#" target="">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#explore" target="">Explore</a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" aria-current="page" href="#faq" target="">FAQ</a>
                                </li>
                                <?php
                                if (!isset($_SESSION['user'])) {
                                ?>
                                    <li class="nav-item me-3">
                                        <a class="btn btn-success d-flex align-items-center" aria-current="page" href="pages/auth/sign-in" target="">
                                            Signin
                                        </a>
                                    </li>
                                    <?php
                                } else {
                                    if ($_SESSION['user']['ROLE'] == 'customers') {
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="./dashboard/app/billing" target="">
                                                My Orders <?php echo ($orderCount > 0) ? "<span class='badge bg-warning'>$orderCount</span>" : ""; ?>
                                            </a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="./dashboard/freelancer" target="">Dashboard</a>
                                        <?php } ?>
                                        <li class="nav-item dropdown">
                                            <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img src="./assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                                                <img src="./assets/images/avatars/avtar_1.png" alt="User-Profile" class="theme-color-purple-img img-fluid avatar avatar-50 avatar-rounded">
                                                <img src="./assets/images/avatars/avtar_2.png" alt="User-Profile" class="theme-color-blue-img img-fluid avatar avatar-50 avatar-rounded">
                                                <img src="./assets/images/avatars/avtar_4.png" alt="User-Profile" class="theme-color-green-img img-fluid avatar avatar-50 avatar-rounded">
                                                <img src="./assets/images/avatars/avtar_5.png" alt="User-Profile" class="theme-color-yellow-img img-fluid avatar avatar-50 avatar-rounded">
                                                <img src="./assets/images/avatars/avtar_3.png" alt="User-Profile" class="theme-color-pink-img img-fluid avatar avatar-50 avatar-rounded">
                                                <div class="caption ms-3 d-none d-md-block ">
                                                    <h6 class="mb-0 caption-title"><?php echo !empty($userLogin['FREELANCER_NAME']) ? $userLogin['FREELANCER_NAME'] : $userLogin['CUSTOMER_NAME']; ?></h6>
                                                    <p class="mb-0 caption-sub-title"><?php echo $userLogin['role']; ?></p>
                                                </div>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <!-- <li><a class="dropdown-item" href="./dashboard/app/user-profile.html">Profile</a>
                                            </li> -->
                                                <li><a class="dropdown-item" href="./dashboard/app/user-privacy-setting.html">Privacy Setting</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item" href="./pages/auth/log-out">Logout</a></li>
                                            </ul>
                                        </li>
                                    <?php
                                }
                                    ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container">
            <section id="explore" class="py-5">
                <div class="container">
                    <h2 class="text-center mb-3">Layanan Populer</h2>
                    <div class="row">
                        <?php
                        // Query untuk mendapatkan layanan populer dari database
                        $query = "SELECT s.ID_SERVICE, f.FULL_NAME, title, description, price, DATEDIFF(CURDATE(), s.CREATED_AT) AS dayago FROM services s
                        join freelancers f on f.ID_FREELANCER = s.ID_FREELANCER;";
                        // Eksekusi query dan ambil hasilnya
                        $result = mysqli_query($koneksi, $query);
                        // Loop melalui hasil query dan tampilkan layanan populer
                        while ($row = mysqli_fetch_assoc($result)) {
                            $serviceID = $row['ID_SERVICE'];
                            $freelancername = $row['FULL_NAME'];
                            $serviceName = $row['title'];
                            $price = $row['price'];
                            $desc = $row['description'];
                            $dayago = $row['dayago'];
                        ?>
                            <!-- <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php //echo $serviceName; 
                                                                ?></h5>
                                        <p class="card-text">Harga: $<?php //echo $price; 
                                                                        ?></p>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        By <?php echo $freelancername; ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $serviceName; ?>.</h5>
                                        <p class="card-text"><?php echo $desc; ?>.</p>
                                        <?php $formatedprice = number_format($price, 0, ',', '.');?>
                                        <a href="./dashboard/app/orders?serviceID=<?php echo $serviceID; ?>" class="btn btn-primary">Rp.<?php echo $formatedprice ?></a>
                                    </div>
                                    <div class="card-footer text-muted">

                                        <?php
                                        if ($dayago == 0) {
                                            echo "Today.";
                                        } else {
                                            echo $dayago . " days ago.";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>

            <section id="user-guide" class="py-5">
                <div class="container">
                    <h1 class="mb-2 text-center">Freelancer Website Usage Guidelines</h1>
                    <ol>
                        <h4 class="mb-2 mt-1">
                            <li>Sign up for an account:</li>
                        </h4>
                        <ul>
                            <li>Visit the freelancer website.</li>
                            <li>Click on the "Sign Up" button.</li>
                            <li>Fill out the registration form with your details.</li>
                            <li>Submit the form to create your account.</li>
                        </ul>
                        <h4 class="mb-2 mt-1">
                            <li>Create your profile:</li>
                        </h4>
                        <ul>
                            <li>Log in to your account.</li>
                            <li>Go to your profile settings.</li>
                            <li>Provide information about your skills, experience, and portfolio.</li>
                            <li>Upload a professional profile picture.</li>
                            <li>Save your profile to make it visible to potential clients.</li>
                        </ul>
                        <h4 class="mb-2 mt-1">
                            <li>Browse available projects:</li>
                        </h4>
                        <ul>
                            <li>Explore the project listings on the website.</li>
                            <li>Filter the projects based on your skills and preferences.</li>
                            <li>Read project descriptions, requirements, and client reviews.</li>
                            <li>Select the projects that match your interests.</li>
                        </ul>
                        <h4 class="mb-2 mt-1">
                            <li>Submit proposals:</li>
                        </h4>
                        <ul>
                            <li>Click on a project to view more details.</li>
                            <li>Review the project scope and requirements.</li>
                            <li>Write a compelling proposal highlighting your skills and experience.</li>
                            <li>Submit your proposal to the client.</li>
                            <li>Wait for a response from the client.</li>
                        </ul>
                        <h4 class="mb-2 mt-1">
                            <li>Manage your projects:</li>
                        </h4>
                        <ul>
                            <li>Track the status of your submitted proposals.</li>
                            <li>Communicate with clients through the messaging system.</li>
                            <li>Collaborate with clients to complete the project requirements.</li>
                            <li>Submit your work and receive feedback from clients.</li>
                            <li>Ensure timely delivery and professional conduct.</li>
                        </ul>
                    </ol>
                </div>
        </div>
        </section>

        <section id="faq" class="py-5">
            <div class="container py-5">
                <h1 class="text-center">Frequently Asked Questions</h1>

                <div class="accordion" id="faqAccordion">


                    <div class="card">
                        <div class="card-header" id="faqHeading1">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                    Question 1: What is VerseifyLance?
                                </button>
                            </h5>
                        </div>

                        <div id="faqCollapse1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faqAccordion">
                            <div class="card-body">
                                Answer 1: Verseifylance is an online platform that connects freelancers with clients. Freelancers can offer their skills and services, while clients can find suitable freelancers for their projects.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading2">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse2" aria-expanded="true" aria-controls="faqCollapse2">
                                    Question 2: How do I sign up as a freelancer on Verseifylance?
                                </button>
                            </h5>
                        </div>

                        <div id="faqCollapse2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faqAccordion">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        Answer 2: To sign up as a freelancer on VerseifyLance, you can follow these steps:
                                        <ol>
                                            <li>Visit the VerseifyLance homepage.</li>
                                            <li>Click on the "Sign Up" or "Register" button displayed on the page.</li>
                                            <li>Fill out the registration form with the required information.</li>
                                            <li>Follow the further instructions to complete the registration process.</li>
                                        </ol>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading3">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse3" aria-expanded="true" aria-controls="faqCollapse3">
                                    Question 3: Is there a registration fee or subscription fee to use Verseifylance?
                                </button>
                            </h5>
                        </div>

                        <div id="faqCollapse3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faqAccordion">
                            <div class="card-body">
                                Answer 3: VerseifyLance is a free-to-use platform. There are no registration fees or subscription fees for freelancers or clients.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading4">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse4" aria-expanded="true" aria-controls="faqCollapse4">
                                    Question 4: How can I find projects that match my interests and skills on Verseifylance?
                                </button>
                            </h5>
                        </div>

                        <div id="faqCollapse4" class="collapse" aria-labelledby="faqHeading4" data-parent="#faqAccordion">
                            <div class="card-body">
                                <ul>
                                    <li>
                                        Answer 4: To find projects that match your interests and skills on Verseifylance, you can do the following:
                                        <ol>
                                            <li>Log in to your Verseifylance account.</li>
                                            <li>Go to the "Services" or "Projects" page to view the list of available projects.</li>
                                            <li>Use the search and filter features to refine the projects based on relevant categories, skills, or keywords.</li>
                                            <li>Explore the details of the projects that interest you and submit proposals or contact the clients if interested.</li>
                                        </ol>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading5">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse5" aria-expanded="true" aria-controls="faqCollapse5">
                                    Question 5: How can I find projects that match my interests and skills on Verseifylance?
                                </button>
                            </h5>
                        </div>

                        <div id="faqCollapse5" class="collapse" aria-labelledby="faqHeading5" data-parent="#faqAccordion">
                            <div class="card-body">
                                Answer 5: Verseifylance is an online platform that connects freelancers with clients. Freelancers can offer their skills and services, while clients can find suitable freelancers for their projects.
                            </div>
                        </div>
                    </div>


                </div>
        </section>
    </div>
    <div id="back-to-top" style="display: none;">
        <a class="p-0 btn btn-primary btn-sm position-fixed top" id="top" href="#top">
            <svg class="icon-30" width="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 15.5L12 8.5L19 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>
    </div>
    <!-- Footer Section Start -->
    <footer class="footer">
        <div class="footer-body">
            <ul class="left-panel list-inline mb-0 p-0">
                <li class="list-inline-item"><a href="./dashboard/extra/privacy-policy.html">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="./dashboard/extra/terms-of-service.html">Terms of Use</a></li>
                <li class="list-inline-item"><a href="mailto:ivlyns@pm.me">Contact: ivlyns@pm.me</a></li>

            </ul>
            <div class="right-panel">
                ©<script>
                    document.write(new Date().getFullYear())
                </script> Verseifylance, Made with
                <span class="">
                    <svg class="icon-15" width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z" fill="currentColor"></path>
                    </svg>
                </span> by <a href="https://profile.ahmadyaz.my.id">shuyshuys</a>.
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    </div>



    <!-- Library Bundle Script -->
    <script src="./assets/js/core/libs.min.js"></script>

    <!-- External Library Bundle Script -->
    <script src="./assets/js/core/external.min.js"></script>

    <!-- Widgetchart Script -->
    <script src="./assets/js/charts/widgetcharts.js"></script>

    <!-- mapchart Script -->
    <script src="./assets/js/charts/vectore-chart.js"></script>
    <script src="./assets/js/charts/dashboard.js"></script>

    <!-- fslightbox Script -->
    <script src="./assets/js/plugins/fslightbox.js"></script>

    <!-- Settings Script -->
    <script src="./assets/js/plugins/setting.js"></script>

    <!-- Slider-tab Script -->
    <script src="./assets/js/plugins/slider-tabs.js"></script>

    <!-- Form Wizard Script -->
    <script src="./assets/js/plugins/form-wizard.js"></script>

    <!-- AOS Animation Plugin-->

    <!-- App Script -->
    <script src="./assets/js/hope-ui.js" defer></script>

    <!-- Flatpickr Script -->
    <script src="./assets/vendor/flatpickr/dist/flatpickr.min.js"></script>
    <script src="./assets/js/plugins/flatpickr.js" defer></script>

    <script src="./assets/js/plugins/prism.mini.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</body>

</html>