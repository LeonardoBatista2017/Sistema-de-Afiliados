<!DOCTYPE html>
<html>
    <body>
        <p>Olá, {{$comment->name}}!</p>
        <p>Seu comentário foi respondido.</p>
        <p><b>Dados do comentário: </b> {{$comment->description}}</p>
        <p><b>Dados da resposta: </b> {{$reply->description}}</p>
        <br>
        <p>Att,</p>
        <p>Equipe EspecializaTi!</p>
    </body>
</html>