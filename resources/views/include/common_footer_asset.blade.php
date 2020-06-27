<script src="{{ asset('admin-assets/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('admin-assets/assets/js/custom.js') }}"></script>
    <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>

        <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin-assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/apps/contact.js') }}"></script>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <script src="{{ asset('admin-assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin-assets/plugins/monthpicker/jquery.ui.monthpicker.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery("#month1").monthpicker({
    changeYear: true,
    stepYears: 2,
                showOn:     "both",
                buttonImage: "images/calendar.png",
                buttonImageOnly: true
            });
            jQuery("#month2").monthpicker({
                monthNames: ['January','February','March','April','May','June', 'July','August','September','October', 'November','December'], 
monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                showOn:     "both",
                buttonImage: "images/calendar.png",
                buttonImageOnly: true,
    showButtonPanel: true,
                changeYear: false,
                yearRange: 'c-2:c+2',
                dateFormat: 'MM y'
            });
            jQuery("#date1").datepicker({
                showOn:     "both",
                buttonImage: "images/calendar.png",
                buttonImageOnly: true
            });
        });
    </script>
<script>
    jQuery('input.monthpicker').monthpicker({changeYear:true,dateFormat:'yy-mm'});
</script>