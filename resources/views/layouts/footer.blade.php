@section('footerstyle')
<link rel="stylesheet" href="{{ asset('css/layout/footer.css') }}">
@endsection
<div id="footer__content">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-lg-4 flex__to__center footer__column__one">
                <div class="footer__context__one">
                    <div class="logo"><span class="symbol">&#128615;</span> KWARA</div>
                    <form>
                        <div class="input-group mt-4 mb-2">
                            <input type="text" class="form-control" placeholder="Your email address">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-light m-0 waves-effect" type="button">Subscribe</button>
                            </div>
                        </div>
                    </form>
                    <small>Subscribe today to get the latest news & updates.</small>
                </div>
            </div>
            <div class="col-lg-4 flex__to__center footer__column__two">
                <div class="footer__context__two">
                    <h5 class="my-2">WEBSITE PAGES</h5>
                    <ul>
                        <li><a href="#home__">HOME</a></li>
                        <li><a href="#about__">ABOUT</a></li>
                        <li><a href="#section__three">LATEST</a></li>
                        <li><a href="#section__five">PRODUCTS</a></li>
                        <li><a href="#contact__">CONTACT</a></li>
                    </ul>
                </div>
            </div>
            <div id="contact__" class="col-lg-4 flex__to__center footer__column__three">
                <div class="footer__context__three text-center">
                    <h4>STAY CONNECTED</h4>
                    <button class="btn btn-block my-3">Email us</button>
                    <span>or follow us on</span>
                    <div class="d-flex justify-content-center footer__social__media">
                        <a href=""><i class="fab fa-facebook-square"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-twitter-square"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <hr class="footer__hr">
        <div class="footer__copy__right">
            <p>&copy; Kwara 2021</p>
        </div>
    </div>
</div>
