@props(['url'])
<tr>
<td class="header" style="padding:0;background-color:transparent;">
<table align="center" width="680" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;max-width:680px;">
<tr>
<td style="padding:0;">
<a href="{{ $url }}" style="display:block;">
<img src="{{ asset('images/email-banner.png') }}?v={{ @filemtime(public_path('images/email-banner.png')) }}" width="680" alt="{{ config('company.name') }} – {{ config('company.tagline') }}" style="display:block;width:100%;max-width:680px;height:auto;border:0;background-color:#0773B9;color:#ffffff;font-size:18px;">
</a>
</td>
</tr>
<tr>
<td align="center" style="padding:12px 16px;background-color:#0B1F33;color:#ffffff;font-size:12px;line-height:18px;letter-spacing:.04em;">
ICT &amp; Multimedia &nbsp;·&nbsp; Web &amp; Apps &nbsp;·&nbsp; Graphics &nbsp;·&nbsp; Photography &nbsp;·&nbsp; Audio-Visual
</td>
</tr>
</table>
</td>
</tr>
