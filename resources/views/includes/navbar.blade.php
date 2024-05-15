<div class="font-[Poppins]">
    <header class="bg-white shadow-lg border-b-2 border-black-900">
        <nav class="flex justify-between items-center w-[82%]  mx-auto">
            <div>
                <img class="w-8 md:w-16 m-2" src="{{ url('') }}/landingpage/images/Logo-1.jpg" alt="Image" class="img-fluid m-1" >
            </div>
            <div
                class="nav-links duration-500 md:static absolute bg-white md:min-h-fit  top-[-100%] md:w-auto  w-full flex items-center px-5">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
                    <li class="{{ Request::route()->getName() == 'index' ? 'active' : '' }}">
                        <a href="{{ route('index') }}"  class="nav-link text-left">Beranda</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'iduka' ? 'active' : '' }}">
                        <a href="{{ route('iduka') }}"  class="nav-link text-left">Pengajuan
                            IDUKA</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'intership' ? 'active' : '' }}">
                        <a href="{{ route('intership') }}"  class="nav-link text-left">Program
                            Intership</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'berita' ? 'active' : '' }}">
                        <a href="{{ route('berita') }}"  class="nav-link text-left">Berita</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'project' ? 'active' : '' }}">
                        <a href="{{ route('project') }}"  class="nav-link text-left">Project</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'event' ? 'active' : '' }}">
                        <a href="{{ route('event') }}"  class="nav-link text-left">Event</a>
                    </li>
                </ul>
            </div>
            <div class="flex items-center gap-6 hidden md:block">
                <a href="{{route('login')}}" class="bg-blue-700 text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Login</a>
                <a href="{{route('register')}}" class="bg-blue-700 text-white px-5 py-2 rounded-full hover:bg-[#87acec]">Register</a>
            </div>
            <div>
                <ion-icon onclick="onToggleMenu(this)" name="menu" class="text-3xl cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
    </header>
    {{-- <div class="h-7 bg-white "></div> --}}



    <script>
        const navLinks = document.querySelector('.nav-links')

        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu'
            navLinks.classList.toggle('top-[9%]')
        }
    </script>
</div>