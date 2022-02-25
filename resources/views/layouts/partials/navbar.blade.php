<div id="banner-in">
    <img src="images/banner-inner.jpg" id="bannerin-img">
    <div id="inner-container">
        <div id="logo"><a href="index.html"><img src="images/logo.png"></a></div> <!--==end of <div id="logo">==-->
        <div id="main-menu">
            <nav class="navbar navbar-expand-lg navbar-light ">
                  <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                      <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="/index">HOME</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/about">ABOUT</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            AWARDS
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/car-awards">Car of the year</a></li>
                            <li><a class="dropdown-item" href="/psv-awards">PSV of the year</a></li>
                            <li><a class="dropdown-item" href="/dealer-awards">Dealer of the year</a></li>
                          </ul>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            INFORMATION
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/sponsors">Sponsors</a></li>
                            <li><a class="dropdown-item" href="/exhibitors">Exhibitors</a></li>
                            <li><a class="dropdown-item" href="/vendors">Vendors</a></li>
                            <li><a class="dropdown-item" href="/know-before-go">Know before you go</a></li>
                            <li><a class="dropdown-item" href="/know-before-go">Event activities</a></li>
                          </ul>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/auction">PUBLIC AUCTION</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="/contactus">CONTACT US</a>
                        </li>
                        @if(Auth::check())
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            MY ACCOUNT
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/myprofile">My Profile</a></li>
                            <li><a class="dropdown-item" href="/mycars">Car of the year</a></li>
                            <li><a class="dropdown-item" href="/mypsvs">PSV of the year</a></li>
                            <li><a class="dropdown-item" href="/mydealers">Dealer of the year</a></li>
                            <li><a class="dropdown-item" href="/auction-cars">Cars for Auction</a></li>
                              <li><a class="dropdown-item" href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Log Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                                </form>
                              </li>
                          </ul>
                        </li>
                        @endif
                      </ul>
                    </div>
                  </div>
                </nav>
        </div> <!--==end of <div id="main-menu">==-->
        
       <div id="title-inner">{{ $pagetitle }}</div>
    </div><!----end of  <div id="inner-container">---->
</div> <!--==end of <div id="banner-in"> ==-->
