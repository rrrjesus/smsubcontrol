<?php $this->layout("_login"); ?>

<div class="form-signin w-100 m-auto mt-2">
    <form class="needs-validation" novalidate id="login" name="login" action="<?= url("/painel/login"); ?>" method="post" enctype="multipart/form-data">
        <?=csrf_input();?>
        <div class="row justify-content-center">
            <div class="form-floating mb-3 mt-1 text-center">
                <img height="80" width="200" src="<?=theme("assets/images/smsub_logo/SUBPREFEITURAS_HORIZONTAL_FUNDO_CLARO.png", CONF_VIEW_ADMIN)?>" class="mb-1 me-2" alt="logo" >
            </div>
        </div>
                <div class="ajax_response"><?=flash();?></div>

        <label for="inputPassword" class="form-label fw-semibold"><i class="bi bi-envelope-at pe-2"></i>Email</label>
        <div class="form-floating mb-3 mt-1">
            <input class="form-control" type="email" name="email" id="email" value="<?=($cookie ?? null)?>"
                   placeholder="nome@smsub.prefeitura.sp.gov.br" data-bs-togglee="tooltip" data-bs-placement="right"
                   data-bs-title="Digite seu email !!!">
        </div>

        <label for="inputPassword" class="form-label fw-semibold"><i class="bi bi-lock pe-2"></i>Senha</label>
        <div class="form-floating mb-3 mt-1">
            <input type="password" name="password" id="password" class="form-control" placeholder="********"
                   data-bs-togglee="tooltip" data-bs-placement="right" data-bs-title="Digite sua senha !!!">
        </div>

        <div class="form-check text-start my-2">
            <input class="form-check-input" type="checkbox" id="togglePassword">
            <label class="form-check-label" for="flexCheckDefault">
                Mostrar a Senha <span class="badge rounded-pill text-bg-dark ps-2" data-bs-togglee="tooltip" data-bs-placement="right"  data-bs-title="Selecione caso queira ver a senha">?</span>
            </label>
        </div>

        <p class="my-3"><a class="link-body-emphasis text-decoration-none fw-semibold text-danger" href="<?= url("/recuperar"); ?>">Esqueceu a senha ?</a></p>

        <div class="d-grid">
            <button class="btn btn-outline-<?=CONF_ADMIN_COLOR?> fw-semibold mt-3" type="submit" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-title="Clique para fazer o login">Entrar</button>
        </div>
    </form>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </symbol>
        <symbol id="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </symbol>
        <symbol id="twitter" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
        </symbol>
    </svg>


    <footer class="pt-3">
        <div class="d-flex flex-column flex-sm-row justify-content-between pt-2 border-top">
            <p>&copy; 2023 Todos os direitos reservados.</p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
                <li class="ms-3"><a class="link-body-emphasis" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
            </ul>
        </div>
        <div class="d-flex flex-column flex-sm-row justify-content-between">
            <p>Desenvolvido por <strong>rrrjesus</strong></p>
            <ul class="list-unstyled d-flex">
                <li class="ms-3"><a class="link-body-emphasis text-decoration-none fw-medium"
                                    target="_blank" href="https://api.whatsapp.com/send?phone=5511991091365&text=Olá, preciso de ajuda com o login.">
                        <i class="bi bi-whatsapp text-success"></i> 991091365</a></li>
            </ul>
        </div>
    </footer>

</div>