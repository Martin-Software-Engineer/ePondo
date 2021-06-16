<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
</head>
<body>
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
{{ $header ?? '' }}

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<!-- Body content -->
<tr>
<td class="content-cell">
{{ Illuminate\Mail\Markdown::parse($slot) }}
{{ $subcopy ?? '' }}
</td>
</tr>
<!-- <div class="row">
    <div class="col">
        <h1>Hi</h1>
    </div>
    <div class="col">
        <h1>Hi</h1>
    </div>
    <div class="col">
        <h1>Hi</h1>
    </div>
</div> -->

<!-- <tr>
<td class="email_footer">
<hr>
<div class="email_footer">Contact Us : ePondo@gmail.com</div> -->


<!-- </td>
<td class="email_footer">
<img style="" class="img_header_email"src="{{asset('app-assets/images/additional_pictures/navbar_logo.png')}}">
</td>
<td class="email_footer">
<h1>col-3</h1>  -->
</td>
</tr>

</table>
</td>
</tr>

{{ $footer ?? '' }}
</table>
</td>
</tr>
</table>
</body>
</html>
