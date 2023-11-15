<header class="p-3 bg-dark text-white">
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script>
        $(document).on('ready', function () {
            if (window.localStorage.getItem('hs-builder-popover') === null) {
                $('#builderPopover').popover('show')
                    .on('shown.bs.popover', function () {
                        $('.popover').last().addClass('popover-dark')
                    });

                $(document).on('click', '#closeBuilderPopover', function () {
                    window.localStorage.setItem('hs-builder-popover', true);
                    $('#builderPopover').popover('dispose');
                });
            } else {
                $('#builderPopover').on('show.bs.popover', function () {
                    return false
                });
            }
            $('.js-navbar-vertical-aside-toggle-invoker').click(function () {
                $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
            });
            var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
                desktop: {
                    position: 'left'
                }
            }).init();
            var sidebar = $('.js-navbar-vertical-aside').hsSideNav();
            $('.js-nav-tooltip-link').tooltip({boundary: 'window'})

            $(".js-nav-tooltip-link").on("show.bs.tooltip", function (e) {
                if (!$(body).hasClass("navbar-vertical-aside-mini-mode")) {
                    return false;
                }
            });
            $('.js-hs-unfold-invoker').each(function () {
                var unfold = new HSUnfold($(this)).init();
            });
            $('.js-form-search').each(function () {
                new HSFormSearch($(this)).init()
            });
        });
    </script>
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="{{ route('home.post') }}" class="btn btn-outline-light me-2">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="GET" action="{{ route('posts.search') }}">
                @csrf
                <div class="input-group">
                    <form class="d-flex">
                        <input type="search" name="keyword" class="form-control form-control-line"
                               placeholder="Search..."
                               aria-label="Search">
                        <button class="btn btn-outline-success border" type="submit"><i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </form>
            @auth
                <div class="dropdown">
                    <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                       data-hs-unfold-options='{"target": "#accountNavbarDropdown", "type": "css-animation" }'>
                        @if(auth()->user()->avatar)
                            <div class="avatar avatar-sm avatar-circle">
                                <img class="avatar-img" src="{{ asset(auth()->user()->avatar) }}"
                                     alt="Image Description">
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        @else
                            <div class="avatar avatar-sm avatar-circle">
                                <img src="{{ asset('images/default_avatar.jpg') }}" alt="Image Description">
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        @endif
                    </a>

                    <div id="accountNavbarDropdown"
                         class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account"
                         style="width: 16rem;">
                        <div class="dropdown-item-text">
                            <div class="media align-items-center">
                                <div class="avatar avatar-sm avatar-circle mr-2">
                                    <img class="avatar-img" src="{{ asset(auth()->user()->avatar) }}"
                                         alt="Image Description">
                                </div>
                                <div class="media-body">
                                    <span class="card-title h5"> {{ auth()->user()->username }}</span>
                                    <span class="card-text"> {{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider "></div>
                        <a class="dropdown-item " href="{{ route('profile.info') }}">
                            <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
                                  title="Profile &amp; account">Profile &amp; account</span>
                        </a>
{{--                        <a class="dropdown-item" href="{{ route('profile.edit') }}">--}}
{{--                            <span class="text-truncate pr-2"--}}
{{--                                  title="Profile &amp; account">Update account information</span>--}}
{{--                        </a>--}}
                        <a class="dropdown-item" href="{{ route('home.index') }}">
                            <span class="text-truncate pr-2" title="Settings">Manager post</span>
                        </a>
{{--                        <a class="dropdown-item" href="#">--}}
{{--                            <span class="text-truncate pr-2" title="Settings">Settings</span>--}}
{{--                        </a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout.perform') }}">
                            <span class="text-truncate pr-2" title="Sign out">Sign out</span>
                        </a>
                    </div>
                </div>
            @endauth

            @guest
                <div class="text-end">
                    <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">Login</a>
                    <a href="{{ route('register.perform') }}" class="btn btn-warning">Sign-up</a>
                </div>
            @endguest
        </div>
    </div>
</header>
