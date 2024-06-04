<!DOCTYPE html>
<html>

<head>
    <title>KoolReport AJAX Example with Parameters</title>
</head>

<body>
    <div id="report-container"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var parameterValue = "some_value"; // Set parameter value

        $.ajax({
            url: 'generate_report.php',
            data: {
                parameter_name: parameterValue
            }, // Pass parameter value
            success: function(data) {
                $('#report-container').html(data);
            }
        });
    });
    </script>
</body>

</html>