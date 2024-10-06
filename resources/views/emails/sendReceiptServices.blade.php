<x-mail::message>
# Introduction

We've received your order.

@foreach ($service_list as $service_lists)
    Service: {{ $service_lists->name }}
    Price: {{ $service_lists->price }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>