@component('mail::message')
    <p>Hello <b>{{ $user->name ?? ''}}</b>,</p>
    <p>Thank you for using our application!</p>
    <p><b>{{ config('app.name') }}</b></p>
@endcomponent