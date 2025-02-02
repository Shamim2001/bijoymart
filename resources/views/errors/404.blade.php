<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>

    <style>
        body {
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 50px;
            color: #FF6347;
        }

        p {
            font-size: 18px;
            color: #666;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <h1>404</h1>
    <p>Oops! The page you're looking for doesn't exist.</p>
    <p><a href="{{ url('/') }}">Go back to the homepage</a></p>

</body>

</html>
