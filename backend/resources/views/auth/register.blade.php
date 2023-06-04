<!DOCTYPE html>
<html>

<head>
    <title>Register a user</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.14/dist/js/uikit-icons.min.js"></script>
</head>

<body>

    <div class="uk-align-center uk-card uk-card-default uk-width-1-2@m" style="background-color: #A9CEF4; margin-top: 20vh; width: 20vw; border-radius: 5px">
        <div class="uk-card-header">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <img class="" width="400" height="400" src="img/wonde-logo.png" alt="Avatar">
                </div>
            </div>
        </div>
        <form class="uk-align-center" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="uk-card-body">

                <div class="uk-margin">
                    <div class="uk-inline">
                        <a class="uk-form-icon" href="#" uk-icon="icon: happy"></a>
                        <input class="uk-input" name="name" type="text" aria-label="Clickable icon" uk-tooltip="Enter your full name" required autofocus>
                         
                    </div>
                    <div>
                        <span> 
                            <x-input-error :messages="$errors->get('name')" class="mt-2" /> 
                        </span>
                    </div>
                </div>

                
                        

                <div class="uk-margin">
                    <div class="uk-inline">
                        <a class="uk-form-icon" href="#" uk-icon="icon: users"></a>
                        <input class="uk-input" name="email" type="text" aria-label="Clickable icon" uk-tooltip="Enter your email" required autofocus>
                        
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
                        <input class="uk-input" name="password" type="password" aria-label="Clickable icon" uk-tooltip="Enter a password" required>
                        
                    </div>
                    <div>
                        <span> 
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </span>
                    </div>
                </div>

                <div class="uk-margin">
                    <div class="uk-inline">
                        <a class="uk-form-icon" href="#" uk-icon="icon: lock"></a>
                        <input class="uk-input" name="password_confirmation" type="password" aria-label="Clickable icon" uk-tooltip="Confirm your password" required>
                        
                    </div>
                    <div>
                        <span> 
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </span>
                    </div>
                </div>

            </div>
            <div class="uk-card-footer">
                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="uk-button uk-button-text">Submit</button>
                </div>
                
            </div>
        </form>

    </div>


</body>