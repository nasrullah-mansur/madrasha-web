<!DOCTYPE html>
<html lang="en">
@include('front.components.head')
<body>
    <!-- Navbar start -->
    @include('front.components.header')
    <!-- Navbar end -->

    @yield('content')

    <!-- Footer start -->
    @include('front.components.footer')
    <!-- Footer end -->


    @include('front.components.script')
</body>
</html>