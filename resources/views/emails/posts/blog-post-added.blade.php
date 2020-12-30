@component('mail::message')
# Someone has posted a Blog Post

Be sure to proof read it!

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
