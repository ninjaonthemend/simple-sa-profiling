@component('mail::message')
# Hi {{ $name }},

Greetings!

This is just to inform you that you've been captured on our system.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
