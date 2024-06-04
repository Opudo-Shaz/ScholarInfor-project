<!DOCTYPE html>
<html>

<head>
    <title>Generate Report</title>
</head>

<body>
    <form id="report-form">
        <label for="selected-fields">Select Fields:</label>
        <select id="selected-fields" multiple>
            <option value="first_name">First Name</option>
            <option value="middle_name">Middle Name</option>
            <option value="last_name">Last Name</option>

            <!-- Add other options for fields -->
        </select>
        <button type="button" id="generate-report-btn">Generate Report</button>
    </form>

    <div id="report-container"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#generate-report-btn').click(function() {
            var selectedFields = $('#selected-fields').val();
            $.ajax({
                url: 'generate_report.php',
                data: {
                    fields: selectedFields
                },
                success: function(data) {
                    $('#report-container').html(data);
                }
            });
        });
    });
    </script>
</body>

</html>