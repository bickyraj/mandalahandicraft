@component('mail::message')

# Your Order is Delivered. Thank you for shopping with us.
@include('emails.order')
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
