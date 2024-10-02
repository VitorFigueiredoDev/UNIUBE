<html>
    <title>titulo</title>
    <head>
        <script>
            function valida(){
                nome = document.getElementById("nome").value;
                if(nome == ""){
                    alert("digite um nome");
                    return false;
                }
                return true;
            }
        </script>
    </head>
    <body>
        <form method="post" action="rota.php" onsubmit="return valida();">
        <input type="text" name="nome" id="nome">
        <input type="submit" value="enviar">
        </form>
        
    </body>
</html>