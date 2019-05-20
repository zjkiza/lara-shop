<ul>
    <li>Name : {{ $product->name }}</li>
    <li>Description : {{ $product->description }}</li>
    <li>Status : {{ $product->status }}</li>
    <li>Price : {{ $product->price }}</li>
    <li>Quantity : {{ $product->quantity }}</li>
    <li>Manufacturer : {{ $product->manufacturer->manufacturer_name }}</li>
    <li>Category : {{ $product->category->category_name }}</li>
    <li>Details:
        <ul>
            @foreach($product->details as $detail)

                <li>{{ $detail->name }}</li>

            @endforeach
        </ul>
    </li>
</ul>