<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<body>
    <div style="font:14px/1.4285714 Arial,sans-serif;color:#333">

        <table style="width:100%;border-collapse:collapse">
            <tbody>
                <tr>
                    <td style=
                    "font:14px/1.4285714 Arial,sans-serif;padding:10px 10px 0;background:#f5f5f5">
                    <table style="width:100%;border-collapse:collapse">
                            <tbody>
                                <tr>
                                    <td style=
                                    "font:14px/1.4285714 Arial,sans-serif;padding:0;background-color:#ffffff;border-radius:5px">
                                    <div style=
                                    "border:1px solid #cccccc;border-radius:5px;padding:20px">
                                        <table style=
                                        "width:100%;border-collapse:collapse">
                                            <tbody>
                                                    <tr>
                                                        <td style=
                                                        "font:14px/1.4285714 Arial,sans-serif;padding:0">

                                                            <p style=
                                                            "margin-bottom:0">
                                                                <h4> Hello, {{ $name }}</h4>
                                                            Please confirm your
                                                            email by clicking
                                                            the button
                                                            below.</p>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td style=
                                                        "font:14px/1.4285714 Arial,sans-serif;padding:15px 0 0">
                                                        <table style=
                                                        "width:auto;border-collapse:collapse">
                                                            <tbody>
                                                                    <tr>
                                                                        <td style="font:14px/1.4285714 Arial,sans-serif;padding:0">
                                                                        <div style="border:1px solid #486582;border-radius:3px">
                                                                            <table style="width:auto;border-collapse:collapse">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="font:14px/1.4285714 Arial,sans-serif;padding:4px 10px;background-color:#3068a2">
                                                                                            <a href="{{ Config::get('SunAuth.app.url') }}/auth/email/confirm/{{ $code }}"
                                                                                                style="color:white;text-decoration:none;font-weight:bold"
                                                                                                target="_blank">
                                                                                                Confirm
                                                                                                this
                                                                                                email
                                                                                                address</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <td style="font:14px/1.4285714 Arial,sans-serif;padding:20px 0;color:#707070"> </td>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>
</body>
</html>
