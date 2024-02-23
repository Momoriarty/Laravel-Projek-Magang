<!-- resources/views/demo/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $demo->nama_template }}</title>
</head>
<style>
    {{ $demo->css }}
</style>

<body>
    {!! $demo->html !!}

    <script>
        {!! $demo->js !!}
    </script>
</body>

</html>
