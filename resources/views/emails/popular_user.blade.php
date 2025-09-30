@component('mail::message')
# Popular user alert

User **{{ $user->name }}** (ID: {{ $user->id }}) has **{{ $likesCount }}** likes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
