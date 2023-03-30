<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des clients</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <td>#</td>
        <td>Prénom</td>
        <td>Nom</td>
        <td>Adresse</td>
        <td>code postal</td>
        <td>Ville</td>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->prenom}}</td>
            <td>{{$client->nom}}</td>
            <td>{{$client->adresse}}</td>
            <td>{{$client->code_postal}}</td>
            <td>{{$client->ville}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

