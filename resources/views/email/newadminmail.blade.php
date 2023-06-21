
@component('mail::message')
# Order Shipped

Your order has been shipped!
created_by
email
password
@component('mail::panel')
    <p>Name: {{ $created_by }}</p>
    <p>Email: {{ $email }}</p>
    <p>Subject: {{ $password }}</p>
@endcomponent

Thanks,<br>
{{-- {{ config('app.name') }} --}}
@endcomponent

