<tr>
<td style="padding:0;background-color:#0773B9;">
<table class="footer" align="center" width="600" cellpadding="0" cellspacing="0" role="presentation" style="max-width:100%;background-color:#0773B9;">
<tr>
<td align="center" style="padding:24px 16px;color:#ffffff;font-size:13px;line-height:20px;">
<strong style="font-size:14px;color:#ffffff;">{{ config('company.name') }}</strong><br>
{{ config('company.tagline') }}<br>
{{ config('company.address2') }}, {{ config('company.address') }}<br>
<a href="tel:{{ config('company.phone') }}" style="color:#ffffff;text-decoration:none;">{{ config('company.phone') }}</a>
&nbsp;·&nbsp;
<a href="https://{{ config('company.website') }}" style="color:#ffffff;text-decoration:underline;">{{ config('company.website') }}</a>
<br><span style="font-size:11px;line-height:16px;">This email and its attachments are confidential and intended only for the addressee. If you received it in error, please notify us and delete it.</span>
<br><span style="font-size:11px;">&copy; {{ date('Y') }} {{ config('company.name') }}. All rights reserved.</span>
</td>
</tr>
</table>
</td>
</tr>
