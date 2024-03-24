<div class="login-bg-img">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90 mt-5  p-4">
                <div class="card-body">
                    <img class="nav-logo mx-5"  src="{{asset('front-end/assets/image/WGO-Logo.png')}}"  style="width: 250px; height:auto;" alt="logo"/>
                    <h5 style="text-align: center"></h5>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input id="password" placeholder="User Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary">Next</button>
                    <hr/>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{url('/registration')}}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{url('/sendOtp')}}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>

  async function SubmitLogin() {
            let email=document.getElementById('email').value;
            let password=document.getElementById('password').value;

            if(email.length===0){
                errorToast("Email is required");
            }
            else if(password.length===0){
                errorToast("Password is required");
            }
            else{
                showLoader();
                let res=await axios.post("/user-login",{email:email, password:password});
                hideLoader()
                if(res.status===200 && res.data['status']==='success'){
                    setToken(res.data['token'])
                    window.location.href="/dashboardSummary";
                }
                else{
                    errorToast(res.data['message']);
                }
            }
    }

</script>
<style>
    .login-bg-img{
        background-image: url({{asset('front-end/assets/image/login-bg-img.jpg')}});
        widows: 100%;
        height: 100vh;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center
    }

    .card{
        background-color: rgb(212, 212, 212);
        opacity: 0.9;
    }
</style>