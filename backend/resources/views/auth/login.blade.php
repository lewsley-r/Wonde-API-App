<!DOCTYPE html>
<html>

<head>
    <title>Log in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/js/uikit-icons.min.js"></script>
</head>

<body>
<div class="uk-clearfix">
    <div class="uk-float-right" style="padding: 1vw">
        <div><a href="/register" class="uk-button uk-button-text">Register</a></div>
    </div>
</div>
    <div class="uk-align-center uk-card uk-card-default uk-width-1-2@m" style="background-color: #A9CEF4; margin-top: 20vh; width: 20vw; border-radius: 5px">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <img class="uk-align-center" src="img/wonde-logo.png" alt="Avatar">
            </div>
        </div>
        <form id="login-form" class="uk-align-center" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="uk-card-body">

                <div class="uk-margin">
                    <div class="uk-inline">
                        <a class="uk-form-icon" href="#" uk-icon="icon: users"></a>
                        <input id="login-email" class="uk-input" name="email" type="text" aria-label="Clickable icon" required autofocus>
                        
                    </div>
                    <div>
                        <span> 
                            <x-input-error :messages="$errors->get('email')" class="mt-2" /> 
                        </span>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-inline">
                        <a class="uk-form-icon" href="#" uk-icon="icon: lock"></a>
                        <input id="login-password" class="uk-input" name="password" type="password" aria-label="Clickable icon" required>
                        
                    </div>
                    <div>
                        <span> 
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </span>
                    </div>
                </div>

            </div>
            <div class="uk-card-footer">
                <button type="submit" class="uk-button uk-button-text" style="color: white">Submit</button>
            </div>
        </form>

    </div>


</body>

</html>