<header class="header-area sticky-bar">
    <div class="main-header-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2">
                    <div class="logo pt-40">
                        <a href="index.html">
                            <h3 class="font-weight-bold">phatemeow</h3>
                        </a>
                    </div>
                </div>

                <div class="col-xl-7 col-lg-7">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li class="angle-shape">
                                    <a href="about_us.html"> ارتباط با ما </a>
                                </li>

                                <li><a href="contact-us.html"> تماس با ما </a></li>

                                <li class="angle-shape">
                                    <a href="shop.html"> فروشگاه </a>

                                    @php
                                        $parentCategories = App\Models\Category::where('parent_id', 0)->get();
                                    @endphp
                                    <ul class="mega-menu">

                                        @foreach ($parentCategories as $parentCategory)
                                            <li>
                                                <a class="menu-title" href="#">{{ $parentCategory->name }}</a>

                                                <ul>
                                                    @foreach ($parentCategory->children as $childCategory)
                                                        <li><a href="#">{{ $childCategory->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="angle-shape">
                                    <a href="index.html"> صفحه اصلی </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3">
                    <div class="header-right-wrap pt-40">
                        <div class="header-search">
                            <a class="search-active" href="#"><i class="sli sli-magnifier"></i></a>
                        </div>
                        <div class="cart-wrap">
                            <button class="icon-cart-active">
                                <span class="icon-cart">
                                    <i class="sli sli-bag"></i>
                                    <span class="count-style">02</span>
                                </span>


                                <span class="cart-price">
                                    500,000
                                </span>
                                <span>تومان</span>
                            </button>
                            <div class="shopping-cart-content">
                                <div class="shopping-cart-top">
                                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    <h4>سبد خرید</h4>
                                </div>
                                <ul>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 90.00</span>
                                        </div>

                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt=""
                                                    src="assets/img/cart/cart-1.svg" /></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 9,000</span>
                                        </div>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt=""
                                                    src="assets/img/cart/cart-2.svg" /></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-bottom">
                                    <div class="shopping-cart-total d-flex justify-content-between align-items-center"
                                        style="direction: rtl;">
                                        <h4>
                                            جمع کل :
                                        </h4>
                                        <span class="shop-total">
                                            25,000 تومان
                                        </span>
                                    </div>
                                    <div class="shopping-cart-btn btn-hover text-center">
                                        <a class="default-btn" href="checkout.html">
                                            ثبت سفارش
                                        </a>
                                        <a class="default-btn" href="cart-page.html">
                                            سبد خرید
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="setting-wrap">
                            <button class="setting-active">
                                <i class="sli sli-settings"></i>
                            </button>
                            <div class="setting-content">
                                <ul class="text-right">
                                    <li><a href="login.html">ورود</a></li>
                                    <li>
                                        <a href="register.html">ایجاد حساب</a>
                                    </li>
                                    <li><a href="my-account.html">پروفایل</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-search start -->
        <div class="main-search-active">
            <div class="sidebar-search-icon">
                <button class="search-close">
                    <span class="sli sli-close"></span>
                </button>
            </div>
            <div class="sidebar-search-input">
                <form>
                    <div class="form-search">
                        <input id="search" class="input-text" value="" placeholder=" ...جستجو "
                            type="search" />
                        <button>
                            <i class="sli sli-magnifier"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="header-small-mobile">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="mobile-logo">
                        <a href="index.html">
                            <h4 class="font-weight-bold">phatemeow</h4>
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="header-right-wrap">
                        <div class="cart-wrap">
                            <button class="icon-cart-active">
                                <span class="icon-cart">
                                    <i class="sli sli-bag"></i>
                                    <span class="count-style">02</span>
                                </span>

                                <span class="cart-price">
                                    500,000
                                </span>
                                <span>تومان</span>
                            </button>
                            <div class="shopping-cart-content">
                                <div class="shopping-cart-top">
                                    <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
                                    <h4>سبد خرید</h4>
                                </div>
                                <ul style="height: 400px;">
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 90.00</span>
                                        </div>

                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt=""
                                                    src="assets/img/cart/cart-1.svg" /></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="single-shopping-cart">
                                        <div class="shopping-cart-title">
                                            <h4><a href="#"> لورم ایپسوم </a></h4>
                                            <span>1 x 9,000</span>
                                        </div>
                                        <div class="shopping-cart-img">
                                            <a href="#"><img alt=""
                                                    src="assets/img/cart/cart-2.svg" /></a>
                                            <div class="item-close">
                                                <a href="#"><i class="sli sli-close"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-bottom">
                                    <div class="shopping-cart-total d-flex justify-content-between align-items-center"
                                        style="direction: rtl;">
                                        <h4>
                                            جمع کل :
                                        </h4>
                                        <span class="shop-total">
                                            25,000 تومان
                                        </span>
                                    </div>
                                    <div class="shopping-cart-btn btn-hover text-center">
                                        <a class="default-btn" href="checkout.html">
                                            ثبت سفارش
                                        </a>
                                        <a class="default-btn" href="cart-page.html">
                                            سبد خرید
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mobile-off-canvas">
                            <a class="mobile-aside-button" href="#"><i class="sli sli-menu"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
