<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="An Administrative Web for SINODE GKKD">
    <meta name="author" content="kreasi tech">
    <title></title>
    <script>
        const s3_url = `{{ env('AWS_URL') . env('AWS_BUCKET') . '/' }}`;
    </script>
</head>

<body>
    @yield ('content')
</body>

</html>
