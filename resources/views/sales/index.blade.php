<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Coffee Price Calculator</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 700px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-inline .form-control {
            width: auto;
            display: inline-block;
        }
        .btn-primary {
            margin-top: 10px;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Sales</h1>
        <form action="{{ route('calculate.store') }}" method="POST" class="form-inline">
            @csrf
            <div class="form-group mb-2">
                <label for="product" class="sr-only">Product</label>
                <select name="product" id="product" class="form-control" required>
                    <option value="Gold coffee">Gold coffee</option>
                    <option value="Arabic coffee">Arabic coffee</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="quantity" class="sr-only">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" required>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="unit_cost" class="sr-only">Unit Cost (£)</label>
                <input type="number" step="0.01" name="unit_cost" id="unit_cost" class="form-control" placeholder="Unit Cost (£)" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Record Sale</button>
        </form>
        @if(session('sellingPrice'))
            <div class="alert alert-info mt-3">
                Selling Price: £{{ number_format(session('sellingPrice'), 2) }}
            </div>
        @endif
        <h2>Previous Sales</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Selling Price</th>
                    <th>Sold at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->product }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>£{{ number_format($sale->unit_cost, 2) }}</td>
                        <td>£{{ number_format($sale->selling_price, 2) }}</td>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
