<script type="text/javascript">
    $(document).ready(function() {
        hideFilters();
        var activeFilter = $("#user-filter option:selected").val();

        if (activeFilter != null) {
            $('#'+ activeFilter).show();
        }

        $('#user-filter').change(function () {
            hideFilters();
            var type = $('#user-filter').val();

            if (type == 'userName') {
                $('#userName').show();
            } else if (type == 'emailId') {
                $('#emailId').show();
            } else if (type == 'mobileNumber') {
                $('#mobileNumber').show()
            } else if (type == 'createdDate') {
                $('#createdDttm').show();
            } else if (type == 'dob') {
                $('#dob').show()
            }
        })

        $('#filter-btn').click(function () {
            triggerController('listUsers')

        })

        $('#downloadCsv').click(function () {
            triggerController('downloadCsvFile')
        })

        function hideFilters()
        {
            $('#username').hide()
            $('#emailId').hide()
            $('#mobileNumber').hide()
            $('#createdDttm').hide()
            $('#dob').hide()
        }


        function triggerController(methodname) {

            var queryString = '';
            var filterValue = '';
            var type = $('#user-filter').val();

            if (type == 'userName') {
                filterValue = $('#userName').val();
            } else if (type == 'emailId') {
                filterValue = $('#emailId').val();
            } else if (type == 'mobileNumber') {
                filterValue = $('#mobileNumber').val()
            } else if (type == 'createdDate') {
                filterValue = $('#createdDate').val();
            } else if (type == 'dob') {
                filterValue = $('#dob').val()
            }

            var baseUrl = '<?php echo base_url(); ?>'
            if (filterValue != null) {
                queryString += methodname + '?q=' + type + '=' + filterValue
                window.location.href = queryString;
            } else {
                alert("the selected field " + type + ' is empty')
            }
        }
    });
</script>
