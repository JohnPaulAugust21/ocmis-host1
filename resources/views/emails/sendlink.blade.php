<x-mail::message>
# Introduction

We've received your request to reset your password.

To reset, simply click the reset password button.


<x-mail::button :url="$link">
Reset Password Now
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
