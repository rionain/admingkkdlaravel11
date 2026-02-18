<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <title>@yield('title')</title>

    @yield('style')
</head>

<body style="background:#22313F;font-family: 'Open Sans'">
    <br>
    <br>
    <br>
    <br>
    <table style="width: 80%;margin-left: auto;margin-right: auto;border-spacing: 0;max-width: 700px;">
        <tr>
            <td
                style="background-color: white;text-align: center;padding: 0px;background-color: #1E8BC3;border-top-left-radius: 5px;border-top-right-radius: 5px">

                <h1 style="color: white">
                    <img src="{{ asset('assets/images/logo-sinode.png') }}" alt="Logo" style="width: 60px;">
                    {{-- <img src="https://cdn.discordapp.com/attachments/833278163521634315/867665073237655572/gkkd-logo-4A961B596C-seeklogo.png"
                        alt="Logo" style="width: 50px;margin-right: 10px"> --}}
                    <span>SINODE GKKD</span>
                </h1>
            </td>
        </tr>
        <tr>
            <td id="content" style="width:100%;padding:20px;background-color: white">
                @yield('content')
            </td>
        </tr>
        <tr>
            <td
                style="padding:20px;background-color:#1E8BC3;color:white;text-align: center;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px">
                &copy;{{ date('Y') }} Sinode. All right reserved.
            </td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <br>
</body>

</html>
