@foreach ($data as $item)
    <html lang="en">

    <head>
        <title>Harvest vase</title>
        <link rel="stylesheet" href="../../file.css">
        <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi"
            rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">
            <div class="product-img">
                <img src="{{ asset('/upload/user') }}/{{ $item->avatar }}" height="420" width="327">
            </div>
            <div class="product-info">
                <div class="product-text">
                    <div>
                        <h4>{{ __("Product name") }}</h4>
                        <p>{{ $item->name }}</p>
                    </div>
                    <div>
                        <h4>{{ __("Stock") }}:</h4>
                        <p>{{ $item->stock }}</p>
                    </div>
                    <div>
                        <h4>Sku:</h4>
                        <p>{{ $item->sku }}</p>
                    </div>
                    <div>
                        <h4>{{ __("Expired at") }}</h4>
                        <p>{{ $item->expired_at }}</p>
                    </div>
                    <div>
                        <h4>{{ __("Category name") }}</h4>
                        <p>{{ $item->product_catelory->name }}</p>
                    </div>

                </div>
            </div>
        </div>

    </body>

    </html>
@endforeach
