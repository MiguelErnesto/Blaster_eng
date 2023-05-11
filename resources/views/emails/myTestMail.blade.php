<!DOCTYPE html>
<html>
<head>
    <title>{{config('app.nombre_principal')}} | Email</title>
</head>
<body>
    <h1>{{config('app.nombre_principal')}} </h1>
    <br/>
    <h3>Message sent from: {{$name}}</h3>
    <h4>Email: {{$email}}</h4>
    <br/>
    <p></p>
    <p>{{$body}}</p>
</body>
</html>