<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Item</title>
    <link rel="stylesheet" href="{{ asset('css/boostrap.min.css') }}">
</head>

<body>
    <div class="container mt-5">
        <h1>Open AI</h1>
        <form action="{{ route('transcription.store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <br>
            <div class="row">
                <div class="col-3">
                    <label for="myfile">Select a file:</label>
                    <input type="file" id="myfile" name="radio" required><br><br>
                </div>
                <div class="col-9">
                    @if (isset($content))
                        <label for="myfile"><h2>Out Put:</h2></label>
                        <h4>{{ $content }}</h4>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">submit</button>
        </form>
    </div>
    <script src="boostrap.min.js"></script>
</body>

</html>
