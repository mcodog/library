<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <a class="navbar-brand" href="{{ route('getItems') }}">BookWise</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @guest
                        <i class="fas fa-user-circle"></i>
                        Guest
                    @else
                        @if (Auth::user()->profile_image)
                            <img src="{{ asset(Auth::user()->profile_image) }}"
                                style="width: 30px; height: 30px; border-radius: 50%;">
                            {{ Auth::user()->name }}
                        @else
                            <i class="fas fa-user-circle"></i>
                            {{ Auth::user()->name }}
                        @endif

                    @endguest
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @guest
                        <a class="dropdown-item" href="{{ route('register') }}">Signup</a>
                        <a class="dropdown-item" href="{{ route('login') }}">Signin</a>
                    @else
                        @if (Auth::user()->role == '1')
                            <a class="dropdown-item" href="{{ route('user.index') }}">Accounts</a>
                        @else
                            <a class="dropdown-item" href="{{ route('user.index') }}">User Profile</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    @endguest
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @if (Auth::check() && Auth::user()->role === '1')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="crudDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                        CRUD
                    </a>
                    <div class="dropdown-menu" aria-labelledby="crudDropdown">
                        <a class="dropdown-item" href="{{ route('genre.index') }}">Genre</a>
                        <a class="dropdown-item" href="{{ route('author.index') }}">Author</a>
                        <a class="dropdown-item" href="{{ route('book.index') }}">Book</a>
                        <a class="dropdown-item" href="{{ route('stocks.index') }}">Stock</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link dropdown-toggle" href="#" id="nestedDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            DataTables
                        </a>
                        <div class="dropdown-menu" aria-labelledby="nestedDropdown">
                            <a class="dropdown-item" href="{{ route('books.table') }}">Book</a>
                            <a class="dropdown-item" href="{{ route('stock.table') }}">Stock</a>
                            <a class="dropdown-item" href="{{ route('author.table') }}">Author</a>
                        </div>
                    </div>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.history') }}">
                    <i class="fas fa-user-circle"></i>
                    History
                </a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('most.used') }}">
                    <i class="fa-solid fa-thumbs-up"></i>
                    Most Used
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewCheckout') }}">
                    <i class="fa fa-book" aria-hidden="true" style="font-size:20px;color:#A4E9D5"></i>
                    <span class="text-color" style="color: #A4E9D5;">Checkout</span>
                    <span
                        class="badge badge-secondary">{{ Session::has('checkout') ? array_sum(array_column(Session::get('checkout'), 'quantity')) : '' }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('borrow') }}">
                    <i class="fa fa-book" aria-hidden="true" style="font-size:20px;color: #40e0d0"></i>
                    <span class="text-color" style="color: #40e0d0;">Borrow</span>
                </a>
            </li>
        </ul>
        <form action="{{ route('books.search') }}" method="GET" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search"
                aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
