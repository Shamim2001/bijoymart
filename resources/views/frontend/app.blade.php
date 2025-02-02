<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Menu Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Left Sidebar (Dropdown Menu) -->
            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                        Categories
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Women’s Clothing</a></li>
                        <li><a class="dropdown-item" href="#">Men’s Clothing</a></li>
                        <!-- Add more categories here -->
                    </ul>
                </div>
            </div>

            <!-- Right Banner Slider -->
            <div class="col-md-9">
                <div id="bannerSlider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="banner1.jpg" class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                            <img src="banner2.jpg" class="d-block w-100" alt="Banner 2">
                        </div>
                        <!-- Add more banners -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#bannerSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bannerSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between overflow-auto">
                <img src="scroll-banner1.jpg" class="scroll-banner" alt="Scroll Banner 1">
                <img src="scroll-banner2.jpg" class="scroll-banner" alt="Scroll Banner 2">
                <img src="scroll-banner3.jpg" class="scroll-banner" alt="Scroll Banner 3">
            </div>
        </div>
    </div>

    <style>
        .scroll-banner {
            width: 30%;
            margin-right: 10px;
        }
    </style>


    <div class="container mt-4">
        <div id="scrollingSection" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="product1.jpg" class="card-img-top" alt="Product 1">
                                <div class="card-body">
                                    <h5 class="card-title">Product 1</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="product2.jpg" class="card-img-top" alt="Product 2">
                                <div class="card-body">
                                    <h5 class="card-title">Product 2</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="product2.jpg" class="card-img-top" alt="Product 2">
                                <div class="card-body">
                                    <h5 class="card-title">Product 2</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="product2.jpg" class="card-img-top" alt="Product 2">
                                <div class="card-body">
                                    <h5 class="card-title">Product 2</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Add more products here -->
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container mt-5">
        <!-- Top Product Section -->
        <div class="row">
            <div class="col-md-12">
                <h3>Top Products</h3>
            </div>
            <!-- Display top products in a grid -->
            <div class="col-md-3">
                <div class="card">
                    <img src="top-product1.jpg" class="card-img-top" alt="Top Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Top Product 1</h5>
                    </div>
                </div>
            </div>
            <!-- Repeat for other products -->
        </div>

        <!-- Feature Product Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Featured Products</h3>
            </div>
            <!-- Display featured products in a grid -->
            <div class="col-md-3">
                <div class="card">
                    <img src="feature-product1.jpg" class="card-img-top" alt="Feature Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Feature Product 1</h5>
                    </div>
                </div>
            </div>
            <!-- Repeat for other products -->
        </div>

        <!-- Best Selling Product Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Best Selling Products</h3>
            </div>
            <!-- Display best selling products in a grid -->
            <div class="col-md-3">
                <div class="card">
                    <img src="best-product1.jpg" class="card-img-top" alt="Best Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Best Product 1</h5>
                    </div>
                </div>
            </div>
            <!-- Repeat for other products -->
        </div>
    </div>









    {{-- 


    <!-- Bootstrap JS and dependencies (Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".dropdown").hover(
                function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
                },
                function() {
                    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
                }
            );
        });
    </script> --}}
</body>

</html>
