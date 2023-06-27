<!-- JAVASCRIPT -->
 <script src="{{ asset('libs/jquery/jquery.min.js')}}"></script>
 <script src="{{ asset('libs/bootstrap/bootstrap.min.js')}}"></script>
 <script src="{{ asset('libs/metismenu/metismenu.min.js')}}"></script>
 <script src="{{ asset('libs/simplebar/simplebar.min.js')}}"></script>
 <script src="{{ asset('libs/node-waves/node-waves.min.js')}}"></script>
 <script src="{{ asset('libs/waypoints/waypoints.min.js')}}"></script>
 <script src="{{ asset('libs/jquery-counterup/jquery-counterup.min.js')}}"></script>
 <script type="module" src="{{ asset('js/nav-bar/nav-bar.js') }}"></script>

 @yield('script')

 <!-- App js -->
 <script src="{{ asset('js/app.min.js')}}"></script>

 @yield('script-bottom')
