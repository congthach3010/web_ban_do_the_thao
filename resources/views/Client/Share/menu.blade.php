<header class="header_wrap fixed-top header_with_topbar">
    @include('Client.Share.top')
    <div class="bottom_header dark_skin main_menu_uppercase">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="/">
                    <img class="logo_light" src="/assets_client/assets/images/logo_light.png" alt="logo" />
                    <img class="logo_dark" src="/assets_client/assets/images/logo_dark.png" alt="logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-expanded="false">
                    <span class="ion-android-menu"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="dropdown">
                            <a class="nav-link active" href="/">Trang chủ</a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Blog</a>
                            <div class="dropdown-menu">
                                <ul>
                                    @foreach ($chuyen_muc as $key => $value)
                                        <li><a class="dropdown-item nav-link nav_item"
                                                href="/blog-list/{{ $value->id }}">{{ $value->ten_chuyen_muc }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </li>
                        @foreach ($danhMuc as $value)
                            @if ($value->id_danh_muc_cha == 0)
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link"
                                        href="/category/{{ $value->slug_danh_muc }}-post-{{ $value->id }}">{{ $value->ten_danh_muc }}</a>
                                    <div class="dropdown-menu dropdown-reverse">
                                        @foreach ($danhMuc as $v)
                                            @if ($value->id == $v->id_danh_muc_cha)
                                                <ul>
                                                    <li>
                                                        <ul>
                                                            <li><a class="dropdown-item nav-link nav_item"
                                                                    href="/category/{{ $v->slug_danh_muc }}-post-{{ $v->id }}">{{ $v->ten_danh_muc }}</a>
                                                            </li>

                                                        </ul>
                                                    </li>

                                                </ul>
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i
                                class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form id="searchsp" action="/search">
                                <input type="text" placeholder="Search" class="form-control" name="query">
                                <button type="submit" class="search_icon"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <div class="search_overlay"></div>
                    </li>
                    @if (Auth::guard('customer')->check())
                        <div id="cartMini">
                            <ul class="navbar-nav attr-nav align-items-center">
                                @if (Auth::guard('customer')->check())
                                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#"
                                            data-toggle="dropdown"><i class="linearicons-cart"></i></a>
                                        <div class="cart_box dropdown-menu dropdown-menu-right">
                                            <ul class="cart_list" v-for="(value, key) in listCart">
                                                <li>
                                                    <a href="#" class="item_remove"><i class="ion-close"
                                                            v-on:click="remove(value.id)"></i></a>
                                                    <a href="#"><img v-bind:src="value.hinh_anh_chinh"
                                                            alt="cart_thumb1">@{{ value.ten_san_pham }}</a>
                                                    <span class="cart_quantity">@{{ value.so_luong_mua }}<span
                                                            class="cart_amount">
                                                            <span class="price_symbole"> Giá</span>
                                                            <template v-if="value.gia_khuyen_mai==0">
                                                                <td class="product-subtotal" data-title="Total">
                                                                    @{{ formatPrice(donGia(value.gia) * value.so_luong_mua) }} đ
                                                                </td>
                                                            </template>
                                                            <template v-else>
                                                                <td class="product-subtotal" data-title="Total">
                                                                    @{{ formatPrice(donGia(value.gia_khuyen_mai) * value.so_luong_mua) }} đ
                                                                </td>
                                                            </template>
                                                </li>
                                            </ul>
                                            <div class="cart_footer">
                                                <p class="cart_buttons"><a href="/client/cart"
                                                        class="btn btn-fill-line rounded-0 view-cart">Xem Giỏ Hàng</a>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </ul>


                {{-- <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="javascript:void(0);" class="nav-link search_trigger"><i
                                class="linearicons-magnifier"></i></a>
                        <div class="search_wrap">
                            <span class="close-search"><i class="ion-ios-close-empty"></i></span>
                            <form>
                                <input type="text" placeholder="Search" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <div class="search_overlay"></div>
                    </li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#"
                            data-toggle="dropdown"><i class="linearicons-cart"></i></a>
                        <div class="cart_box dropdown-menu dropdown-menu-right">
                            <ul class="cart_list" id="listCart">
                                <li>

                                </li>

                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span
                                            class="price_symbole">$</span></span>159.00</p>
                                <p class="cart_buttons"><a href="#"
                                        class="btn btn-fill-line rounded-0 view-cart">View Cart</a><a href="#"
                                        class="btn btn-fill-out rounded-0 checkout">Checkout</a></p>
                            </div>
                        </div>
                    </li>
                </ul> --}}
            </nav>
        </div>
    </div>
</header>
{{-- @include('Client.share.js') --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function() {
        $("#registerForm").hide();
        $("#viewRegister").click(function() {
            $("#loginForm").hide();
            $("#registerForm").show();
        });
        $("#viewLogin").click(function() {
            $("#registerForm").hide();
            $("#loginForm").show();
        });
        $("#loginForm").submit(function(e) {
            e.preventDefault();
            var payload = window.getFormData($(this));
            axios
                .post('/login', payload)
                .then((res) => {
                    if (res.data.status == 1) {
                        // toastr.success("Đã login thành công!");
                        window.location.href = "/";
                    } else if (res.data.status == 2) {
                        toastr.warning("Tài khoản chưa kích hoạt!");
                    } else {
                        toastr.error("Đăng nhập thất bại");
                    }
                })
                .catch((res) => {
                    var listError = res.response.data.errors;
                    $.each(listError, function(key, value) {
                        toastr.error(value[0]);
                    });
                });
        });

        $("#registerForm").submit(function(e) {
            e.preventDefault();
            var payload = window.getFormData($(this));
            axios
                .post('/register', payload)
                .then((res) => {
                    if (res.status) {
                        toastr.success("Mã kích hoạt đã gửi đến Email!");
                        $("#registerForm").hide();
                        $("#loginForm").show();
                    }
                })
                .catch((res) => {
                    var listError = res.response.data.errors;
                    $.each(listError, function(key, value) {
                        toastr.error(value[0]);
                    });
                });
        });

        $(".addToCart").click(function(e) {

            var id_san_pham = $(this).data('id');
            axios
                .get('/client/add-to-cart/' + id_san_pham)
                .then((res) => {
                    if (res.data.status) {
                        toastr.success(res.data.message);
                        app.loadTable();
                    } else {
                        toastr.error(res.data.message);
                    }
                });
        });
    })
    var app = new Vue({
        el: '#cartMini',
        data: {
            listCart: [],
        },
        created() {
            this.loadTable();

        },
        methods: {
            remove(id) {
                axios
                    .get('/client/cart/remove/' + id)
                    .then((res) => {
                        //toastr.success("Đã xóa sản phẩm khỏi giỏ hàng");
                        this.loadTable();
                    });
            },
            loadTable() {
                axios
                    .get('/client/cart/data')
                    .then((res) => {
                        this.listCart = res.data.chiTiet;
                    });
            },

            totalRequest() {
                var total = 0;
                for (var i in this.listCart) {
                    total = total + this.listCart[i].thanh_tien;
                }
                return total;
            },

            donGia(x, y) {
                if (x == 0) {
                    return y;
                } else {
                    return x;
                }
            },
            thanhTien(v) {
                if (v.gia_khuyen_mai == 0) {
                    return this.donGia(v.gia) * v.so_luong_mua;
                } else {
                    return this.donGia(v.gia_khuyen_mai) * v.so_luong_mua;
                }
            },

            formatPrice(value) {
                let val = (value / 1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },

            count() {
                count = 0;
                for (var i in this.listCart) {
                    count += 1;
                }
                return count;
            },
            stringToArray(str) {

                return str.split(",");
            },
        },
    });
</script>
@include('Client.Share.model')
