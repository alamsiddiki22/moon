{{-- <p>Name: {{ $info['name'] }}</p>
<p>Email: {{ $info['email'] }}</p>
<p>Subject: {{ $info['subject'] }}</p>
<p>Message: {{ $info['message'] }}</p> --}}


@component('mail::message')
# Order Shipped

Your order has been shipped!

@component('mail::panel')
    <p>Name: {{ $info['name'] }}</p>
    <p>Email: {{ $info['email'] }}</p>
    <p>Subject: {{ $info['subject'] }}</p>
    <p>Message: {{ $info['message'] }}</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>Email Signature</TITLE>
<META content="text/html; charset=utf-8" http-equiv="Content-Type">
</HEAD>
<BODY style="font-size: 10pt; font-family: Arial, sans-serif;">

<table style="width: 500px; font-size: 11pt; font-family: Arial, sans-serif;" cellspacing="0" cellpadding="0">
<tbody>
 <tr>
    <td style="font-size: 10pt; font-family: Arial, sans-serif; width: 100px; padding-right: 10px; vertical-align: top; padding-top: 5px;" rowspan="6" width="100" valign="top">
        <a href="https://www.codetwo.com/email-signatures/" target="_blank"><img alt="Logo" style="width:77px; height:auto; border:0;" src="logo.png" width="77" border="0"></a>

    </td>


    <td style="padding-left:10px">
        <table cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td colspan="2" style="font-size: 10pt; color:#0079ac; font-family: Arial, sans-serif; width: 400px; vertical-align: top;" valign="top">
                        <strong><span style="font-size: 11pt; font-family: Arial, sans-serif; color:#8a8554;">{{ $info['name'] }} {lastName}</span></strong>
                        <strong style="font-family: Arial, sans-serif; font-size:11pt; color:#898553;"><span> | </span>{title}</strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size: 10pt; font-family: Arial, sans-serif; padding-bottom: 5px; vertical-align: top; line-height:17px;" valign="top">
                        <span><br></span>
                        <span><span style="color: #898553;"><strong>t:</strong></span><span style="font-size: 10pt; font-family: Arial, sans-serif; color:#000000;"> {phone}</span></span>
                        <span><span>| </span><span style="color: #898553;"><strong>m: </strong></span><span style="font-size: 10pt; font-family: Arial, sans-serif; color:#000000;">{mobile}</span></span>

                        <span><br><span style="color: #898553;"><strong>e: </strong></span><a href="mailto:{email}" style="font-size: 10pt; font-family: Arial, sans-serif; color:#000000; text-decoration: none;"><span style="font-size: 10pt; font-family: Arial, sans-serif; color:#000000; text-decoration: none;">{email}</span></a></span>

                        <span><br>
                            <span style="font-size:10pt; color:#8a8554; font-weight: bold;">{company} <span style="font-size:10pt; color:#8a8554; font-weight: bold;"> | </span></span>
                            <span>
                                <span style="font-size: 10pt; font-family: Arial, sans-serif; color: #000000;">{address1} <span>, </span></span>
                                <span style="font-size: 10pt; font-family: Arial, sans-serif; color: #000000;">{address2}</span>
                            </span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10pt; font-family: Arial, sans-serif; font-weight:bold; color: #1793ce; width:200px; height:19px; padding-top: 10px;" width="200">
                        <span style="display:inline-block; height:19px; font-family: Arial, sans-serif; font-size: 10pt;"><a href="{website}" target="_blank" style="text-decoration:none;"><span style="font-family:Arial, sans-serif; color:#8a8554; text-decoration:none;">{website}</span></a></span>
                    </td>
                    <td style="width:200px; text-align:right;  padding-top: 10px;" width="200"><span style="display:inline-block; height:19px;"><span><a href="https://www.facebook.com/MyCompanyFacebook" target="_blank"><img alt="Facebook icon" style="border:0; height:19px; width:19px" src="fb.png" width="19" height="19" border="0"></a>&nbsp;&nbsp;&nbsp;</span><span><a href="https://www.linkedin.com/company/mycompanylinkedin" target="_blank"><img alt="LinkedIn icon" style="border:0; height:19px; width:19px" src="ln.png" width="19" height="19" border="0"></a>&nbsp;&nbsp;&nbsp;</span><span><a href="https://twitter.com/MyCompanyTwitter" target="_blank"><img alt="Twitter icon" style="border:0; height:19px; width:19px" src="tt.png" width="19" height="19" border="0"></a>&nbsp;&nbsp;&nbsp;</span><span><a href="https://www.youtube.com/user/MyCompanyChannel" target="_blank"><img alt="Youtube icon" style="border:0; height:19px; width:19px" src="yt.png" width="19" height="19" border="0"></a>&nbsp;&nbsp;&nbsp;</span><span><a href="https://www.instagram.com/mycompanyinstagram/" target="_blank"><img alt="Instagram icon" style="border:0; height:19px; width:19px" src="it.png" width="19" height="19" border="0"></a>&nbsp;&nbsp;&nbsp;</span><span><a href="https://pinterest.com/mycompanypinterest/" target="_blank"><img alt="Pinterest icon" style="border:0; height:19px; width:19px" src="pt.png" width="19" height="19" border="0"></a></span></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
 </tr>
</tbody>
</table>

</BODY>
</HTML>
