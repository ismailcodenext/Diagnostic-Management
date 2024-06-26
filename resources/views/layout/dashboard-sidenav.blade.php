<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<title>Dashboard | @yield('title')</title>

<link rel="shortcut icon" type="image/x-icon" href="{{asset('front-end/assets/img/favicon.jpg')}}">

<link rel="stylesheet" href="{{asset('front-end/assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('front-end/assets/plugins/select2/css/select2.min.css')}}">

<link rel="stylesheet" href="{{asset('front-end/assets/css/animate.css')}}">

<link rel="stylesheet" href="{{asset('front-end/assets/css/dataTables.bootstrap4.min.css')}}">

<link rel="stylesheet" href="{{asset('front-end/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{asset('front-end/assets/plugins/fontawesome/css/all.min.css')}}">

<link rel="stylesheet" href="{{asset('front-end/assets/css/style.css')}}">





<script src="{{asset('js/toastify-js.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/config.js')}}"></script>
</head>
<body>

    <div class="main-wrapper">

        <div class="header">

        <div class="header-left active">
        <a href="index.html" class="logo">
        <img src="{{asset('front-end/assets/img/logo.png')}}" alt="">
        </a>
        <a href="index.html" class="logo-small">
        <img src="{{asset('front-end/assets/img/logo-small.png')}}" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
        </div>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
        </span>
        </a>

        <ul class="nav user-menu">

        <li class="nav-item">
        <div class="top-nav-search">
        <a href="javascript:void(0);" class="responsive-search">
        <i class="fa fa-search"></i>
        </a>
        <form action="#">
        <div class="searchinputs">
        <input type="text" placeholder="Search Here ...">
        <div class="search-addon">
        <span><img src="{{asset('front-end/assets/img/icons/closes.svg')}}" alt="img"></span>
        </div>
        </div>
        </form>
        </div>
        </li>

        <li class="nav-item dropdown has-arrow main-drop">
        <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
        <span class="user-img"><img src="{{asset('front-end/assets/img/profiles/avator1.jpg')}}" alt="">
        <span class="status online"></span></span>
        </a>
        <div class="dropdown-menu menu-drop-user">
        <div class="profilename">
        <div class="profileset">
        <span class="user-img"><img src="{{asset('front-end/assets/img/profiles/avator1.jpg')}}" alt="">
        <span class="status online"></span></span>
        <div class="profilesets">
        <h6>John Doe</h6>
        <h5>Admin</h5>
        </div>
        </div>
        <hr class="m-0">
        <a class="dropdown-item" href="profile.html"> <i class="me-2" data-feather="user"></i> My Profile</a>
        <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a>
        <hr class="m-0">
        <button  onclick="logout()" class="side-bar-item">
            <span class="side-bar-item-caption">Logout</span>
        </button>
        </div>
        </div>
        </li>
        </ul>


        <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="profile.html">My Profile</a>
        <a class="dropdown-item" href="generalsettings.html">Settings</a>
        <button  onclick="logout()" class="dropdown-item side-bar-item">
            <span class="side-bar-item-caption">Logout</span>
        </button>
        </div>
        </div>

        </div>


        <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
        <ul>
        <li class="active">
        <a href="{{url('/dashboardSummary')}}"><img src="{{asset('front-end/assets/img/icons/dashboard.svg')}}" alt="img"><span> Dashboard</span> </a>
        </li>
        <li class="submenu">
        <a href="javascript:void(0);"><img src="{{asset('front-end/assets/img/icons/product.svg')}}" alt="img"><span> Patient Management</span> <span class="menu-arrow"></span></a>
        <ul>
        <li><a href="{{url('/patient-page')}}">Patient List</a></li>
        <li><a href="addproduct.html">Add Product</a></li>
        <li><a href="categorylist.html">Category List</a></li>
        <li><a href="addcategory.html">Add Category</a></li>
        <li><a href="subcategorylist.html">Sub Category List</a></li>
        <li><a href="subaddcategory.html">Add Sub Category</a></li>
        <li><a href="brandlist.html">Brand List</a></li>
        <li><a href="addbrand.html">Add Brand</a></li>
        <li><a href="importproduct.html">Import Products</a></li>
        <li><a href="barcode.html">Print Barcode</a></li>
        </ul>
        </li>
            <li class="submenu">
                <a href="javascript:void(0);"><img src="{{asset('front-end/assets/img/icons/product.svg')}}" alt="img"><span> Doctor Management</span> <span class="menu-arrow"></span></a>
                <ul>
                    <li><a href="{{url('/doctor-list')}}">Doctor List</a></li>
                    <li><a href="{{url('/doctor-create')}}">Add Product</a></li>
                    <li><a href="categorylist.html">Category List</a></li>
                    <li><a href="addcategory.html">Add Category</a></li>
                    <li><a href="subcategorylist.html">Sub Category List</a></li>
                    <li><a href="subaddcategory.html">Add Sub Category</a></li>
                    <li><a href="brandlist.html">Brand List</a></li>
                    <li><a href="addbrand.html">Add Brand</a></li>
                    <li><a href="importproduct.html">Import Products</a></li>
                    <li><a href="barcode.html">Print Barcode</a></li>
                </ul>
            </li>

        <li class="submenu">
        <a href="javascript:void(0);"><img src="{{asset('front-end/assets/img/icons/sales1.svg')}}" alt="img"><span> Sales</span> <span class="menu-arrow"></span></a>
        <ul>
        <li><a href="saleslist.html">Sales List</a></li>
        <li><a href="pos.html">POS</a></li>
        <li><a href="pos.html">New Sales</a></li>
        <li><a href="salesreturnlists.html">Sales Return List</a></li>
        <li><a href="createsalesreturns.html">New Sales Return</a></li>
        </ul>
        </li>
        <li class="submenu">
        <a href="javascript:void(0);"><img src="{{asset('front-end/assets/img/icons/purchase1.svg')}}" alt="img"><span> Purchase</span> <span class="menu-arrow"></span></a>
        <ul>
        <li><a href="purchaselist.html">Purchase List</a></li>
        <li><a href="addpurchase.html">Add Purchase</a></li>
        <li><a href="importpurchase.html">Import Purchase</a></li>
        </ul>
        </li>


        </ul>
        </div>
        </div>
        </div>
    </div>


    <div class="content">
        @yield('content')
    </div>

  <script>

async function getProfile() {
    try {
        showLoader();
        let res = await axios.get("/user-profile", HeaderToken());
        hideLoader();
        document.getElementById('Name').innerText = res.data['firstName'];

    } catch (e) {
        unauthorized(e.response.status)
    }
}

    async function logout() {

        try {
            let res = await axios.get("/logout", HeaderToken());
            localStorage.clear();
            sessionStorage.clear();
            window.location.href = "/userLogin";
        } catch (e) {
            errorToast(res.data['message']);
        }
    }


  </script>

<script src="{{asset('front-end/assets/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{asset('front-end/assets/js/feather.min.js')}}"></script>

<script src="{{asset('front-end/assets/js/jquery.slimscroll.min.js')}}"></script>

<script src="{{asset('front-end/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('front-end/assets/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('front-end/assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('front-end/assets/plugins/select2/js/select2.min.js')}}"></script>

<script src="{{asset('front-end/assets/plugins/sweetalert/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/sweetalert/sweetalerts.min.js')}}"></script>

<script src="{{asset('front-end/assets/js/script.js')}}"></script>
</body>
</html>
