<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.commonHead')
</head>

<body>
    <div class="main-wrapper">
        @include('admin.layout.header')
        @include('admin.layout.sidebar')
        @yield('mainContent')
    </div>
    @include('admin.layout.customizerLink')
    @include('admin.layout.commonFooter')
    @stack('custom-script')
</body>

</html>