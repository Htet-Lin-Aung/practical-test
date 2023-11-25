<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background: #f8f9fa; /* Set your background color */
            color: #212529; /* Set your text color */
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-control.error {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="card-header">{{ $form->name }}</h2>

    <div class="card-body">
        <form method="POST" action="{{ route('survey.store',$form) }}">
            @method('POST')
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email"
                            class="form-control @error('email') error @enderror" name="email"
                            value="{{ old('email') }}"  autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            @foreach($form->fields as $field)
                <div class="form-group">
                    <label for="{{ $field->code }}">{{ $field->name }}</label>


                    @if($field->type == "textarea")
                        <textarea id="{{ $field->code }}" class="form-control @error($field->code) error @enderror"
                                name="{{ $field->code }}</textarea>
                    @else
                        <input id="{{ $field->code }}" type="{{ $field->type }}"
                            class="form-control @error($field->code) error @enderror" name="{{$field->code}}"
                            value="{{ old($field->code) }}"  autofocus>
                    @endif

                    @error($field->code)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            @endforeach

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
