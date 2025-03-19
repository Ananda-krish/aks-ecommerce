<!-- Header -->
<header class="header">

    <!-- Top Bar -->
    <div class="top_bar">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-row">
                    <div class="top_bar_contact_item">
                        <div class="top_bar_icon">
                            <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918577/phone.png" alt="">
                        </div>+91 9823 132 111
                    </div>
                    <div class="top_bar_contact_item">
                        <div class="top_bar_icon">
                            <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918597/mail.png" alt="">
                        </div><a href="mailto:fastsales@gmail.com">contact@AKSsales.com</a>
                    </div>
                    <div class="top_bar_content ml-auto">
                        <div class="top_bar_user">
                            <div class="user_icon">
                                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918647/user.svg" alt="">
                            </div>
                            <div><a href="#">User Sign in</a></div>
                            <div><a href="{{ route('admin.login') }}">Admin Sign in</a></div>
                            <div>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Main -->
    <div class="header_main">
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="col-lg-2 col-sm-3 col-3 order-1">
                    <div class="logo_container">
                        <div class="logo"><a href="#">AKS</a></div>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                    <div class="header_search">
                        <div class="header_search_content">
                            <div class="header_search_form_container">
                                <form action="{{ route('autocomplete') }}" method="GET" enctype="multipart/form-data" class="header_search_form clearfix">
                                    @csrf
                                    <input type="search" name="search" required="required" class="header_search_input" placeholder="Search for products..." id="search-input">

                                    <!-- Autocomplete suggestions list -->
                                    <ul id="autocomplete-suggestions" class="autocomplete-suggestions-list"></ul>

                                    <button type="submit" class="header_search_button trans_300" value="Submit">
                                        <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918770/search.png" alt="">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wishlist & Cart -->
                <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                    <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                        <!-- Wishlist -->
                        <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist_icon">
                                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918681/heart.png" alt="">
                            </div>
                            <div class="wishlist_content">
                                <div class="wishlist_text"><a href="#">Wishlist</a></div>
                                <div class="wishlist_count">10</div>
                            </div>
                        </div>

                        <!-- Cart -->
                        <div class="cart">
                            <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                <div class="cart_icon">
                                    <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918704/cart.png" alt="">
                                    <!-- Dynamic Cart Count -->
                                    <div class="cart_count"><span>{{ $cartCount }}</span></div>
                                </div>
                                <div class="cart_content">
                                    <div class="cart_text"><a href="{{ route('usercart') }}">Cart</a></div>
                                    <!-- Dynamic Cart Total Price -->
                                    <div class="cart_price">${{ number_format($cartTotal, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="main_nav">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="main_nav_content d-flex flex-row">
                        <!-- Main Nav Menu -->
                        <div class="main_nav_menu">
                            <ul class="standard_dropdown main_nav_dropdown">
                                <li><a href="#">Home<i class="fas fa-chevron-down"></i></a></li>
                                <li><a href="{{ route('userproduct') }}">Products<i class="fas fa-chevron-down"></i></a></li>
                                <li><a href="{{ route('user.profile') }}">User Profile<i class="fas fa-chevron-down"></i></a></li>
                            </ul>
                        </div>

                        <!-- Menu Trigger -->
                        <div class="menu_trigger_container ml-auto">
                            <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                                <div class="menu_burger">
                                    <div class="menu_trigger_text">menu</div>
                                    <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Menu -->
    <div class="page_menu">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page_menu_content">
                        <div class="page_menu_search">
                            <form action="#">
                                <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                            </form>
                        </div>
                        <ul class="page_menu_nav">
                            <li class="page_menu_item has-children">
                                <a href="#">Language<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item has-children">
                                <a href="#">Currency<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item">
                                <a href="#">Home<i class="fa fa-angle-down"></i></a>
                            </li>
                            <li class="page_menu_item has-children">
                                <a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item has-children">
                                <a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item">
                                <a href="#">Shop<i class="fa fa-angle-down"></i></a>
                            </li>
                            <li class="page_menu_item">
                                <a href="#">Contact<i class="fa fa-angle-down"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<!-- jQuery and JavaScript for Autocomplete -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle input event on the search field
        $('#search-input').on('input', function() {
            let query = $(this).val();  // Get the current value of the search input
            let autocompleteList = $('#autocomplete-suggestions');  // Suggestions container

            // Only trigger if the search term has more than 2 characters
            if (query.length > 2) {
                $.ajax({
                    url: '{{ route("autocomplete.suggestions") }}',  // The correct route for autocomplete suggestions
                    method: 'GET',
                    data: { query: query },  // Send the search term to the server
                    success: function(data) {
                        // Clear previous suggestions
                        autocompleteList.empty();

                        // If there are results, create suggestion items
                        if (data.length > 0) {
                            data.forEach(function(product) {
                                autocompleteList.append(
                                    `<li class="suggestion-item" data-id="${product.id}">${product.name}</li>`
                                );
                            });

                            // Display the suggestions list
                            autocompleteList.show();
                        } else {
                            autocompleteList.hide();  // Hide if no results
                        }
                    },
                    error: function() {
                        autocompleteList.empty().hide();  // Hide if there's an error
                    }
                });
            } else {
                autocompleteList.empty().hide();  // Hide suggestions if query is too short
            }
        });

        // Handle clicking on a suggestion
        $(document).on('click', '.suggestion-item', function() {
            // Set the clicked suggestion to the search input
            $('#search-input').val($(this).text());

            // Hide suggestions
            $('#autocomplete-suggestions').hide();
        });

        // Hide suggestions when clicking anywhere outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#search-input, #autocomplete-suggestions').length) {
                $('#autocomplete-suggestions').hide();
            }
        });
    });
</script>
