@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://github.com/Buldozer85/images/blob/main/ico.png" class="logo" alt="Logo kuželny Veselí">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
