<!DOCTYPE html>
<html>

<head>
    <title>Payment Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .success {
            color: green;
        }

        .failed {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Payment Status</h1>
        <p class="{{ $status }}" style="text-transform: capitalize">{{ $msg }},شكرا لك</p>
    </div>
</body>

</html>
