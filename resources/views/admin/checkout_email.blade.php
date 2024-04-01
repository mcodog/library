<!DOCTYPE html>
<html>
<head>
    <title>Checkout Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h2>Checkout Items</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Due Date</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checkoutItems as $item)
            <tr>
                <td>{{ $item['title'] }}</td>
                <td><img src="{{ $item['img_path'] }}" alt="{{ $item['title'] }}" width="100"></td>
                <td>{{ $item['due_date'] }}</td>
                <td>{{ $item['quantity'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
