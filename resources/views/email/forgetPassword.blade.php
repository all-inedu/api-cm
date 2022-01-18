<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"
        }
        
    </style>
</head>
<body style="background: #E6E6E6; padding: 2vw; ">
    <div class="container" style="width: 100%;padding-left:15px;padding-right:15px;margin-left:auto;margin-right:auto;">
        <div class="row text-center border-bottom pb-3 mb-3" style="text-align: center; padding-bottom: 1rem; margin-bottom: 1rem; border-bottom: 1px solid #dee2e6!important; display: flex; flex-wrap: wrap; margin-left: -15px; margin-right: -15px">
            <div class="col" style="flex-basis: 0;flex-grow: 1;max-width: 100%; text-align:center;">
                <img src="{{ asset('img/allin.png') }}" style="width: 200px; height: auto;">
            </div>
        </div>
        <div class="row bg-light p-4 border" style="width: 75%;border-bottom: 4px solid #E6E6E6;background-color: #f8f9fa!important; padding: 1.5rem;display: flex; flex-wrap: wrap; margin-left: auto; margin-right: auto">
            <div class="col mt-4" style="flex-basis: 0;flex-grow: 1;max-width: 100%">
                <h3>Hi, {{ $fullname }}!</h3>

                <p style="font-size: 2vw;">There was a request to reset your password.</p>
                <div style="width:1px; height: 5vh;"></div>
                <p>If you did not make this request, just ignore this email. Otherwise, please click the button below to reset your password:</p>

                <div class="p-3 text-center" style="padding: 1rem;text-align:center;margin-top: 1rem;">
                    <a href="https://vue-cm.all-inedu.com/reset/{{ $token }}"><button class="btn btn-primary py-2 px-4" style="padding: 0.375rem 0.75rem; background: color: #fff; background-color: #007bff; border-color: #007bff; cursor:pointer; display:inline-block;font-weight: 400; text-align:center;white-space:nowrap;vertical-align:middle;border: 1px solid transparent;font-size: .9rem;line-height: 1.5;border-radius: 0.25rem;color: #FFF">Reset Password</button></a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>