<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Campo - Login</title>
    <link href="/assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/global.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-white text-center border-0 pt-4 pb-0">
                        <img src="assets/img/logo_meu_campo.svg" alt="Logo Meu Campo" class="img-fluid" style="max-height: 120px;">
                        <h3 class="text-center font-weight-light my-4">Acesse sua conta</h3>
                    </div>
                    <div class="card-body">
                        <form action="/login" method="POST">
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Endereço de E-mail</label>
                                <input class="form-control" id="inputEmail" name="email" type="email" placeholder="nome@exemplo.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label">Senha</label>
                                <input class="form-control" id="inputPassword" name="senha" type="password" placeholder="Digite sua senha" required>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small text-decoration-none" href="#">Esqueceu a senha?</a>
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="#">Precisa de uma conta? Cadastre-se!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/assets/alpine/alpine.js" defer></script>
</body>
</html>
