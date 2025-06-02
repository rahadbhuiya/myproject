<x-mail::message>

{{-- Greeting --}}
# {{ $greeting ?? 'Hello!' }}

Please click the button below to verify your email address.

<x-mail::button :url="$actionUrl">
    {{ $actionText }}
</x-mail::button>

If you did not create an account, no further action is required.

Regards,  
**KalaChan Store**

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
    If you’re having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below into your web browser:  
    <span class="break-all">{{ $actionUrl }}</span>
</x-slot:subcopy>
@endisset

</x-mail::message>
