<x-mail::message>
# Introduction

We've received your order.

@foreach ($products as $product)
    <p>Product: {{ $product->name }}</p>
    <p>Quantity: {{ $product->qty }}</p>
    <!-- Add more details as needed -->
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>