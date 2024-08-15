<footer class="bd-footer py-4 py-md-5 bg-body-tertiary text-center">
    <div class="container-xl py-4 py-md-5 px-4 px-md-3 text-body-secondary">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                   data-bs-title="Agenda de Ramais" class="d-inline-flex align-items-center mb-2 text-body-emphasis text-decoration-none" href="<?=url("/contatos")?>" aria-label=Contatos">
                    <i class="bi bi-book fs-1 mb-3 me-2 text-smsub fw-bold"></i>
                    <span class="text-smsub fw-bold fs-6">SMSUB AGENDA</span>
                </a>
                <ul class="list-unstyled small">
                    <li class="mb-2">Desenvolvido com todo amor pela equipe de <strong>SMSUB - COTI - Coordenação de Tecnologia da smsubrmação</strong>.</li>
                    <li class="mb-2">Código licenciado <a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                                          data-bs-title="Liçenca de Software" class="text-decoration-none text-smsub fw-bold" href="https://github.com/rrrjesus/agenda/blob/main/LICENSE" target="_blank" rel="license noopener">MIT</a></li>
                    <li class="mb-2">Versão Atual v2.0.2.</li>
                    <li class="mb-2">Código Fonte <a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="GitHub do Desenvolvedor" class="text-decoration-none text-smsub fw-bold" href="https://github.com/rrrjesus/agenda" target="_blank" rel="noopener"><i class="bi bi-github"></i> @rrrjesus/agenda</a>.</li>
                </ul>
            </div>

            <div class="col-lg-2 mb-3">
                <h5>Mais</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Acessar Home"  class="text-decoration-none text-smsub fw-bold" href="<?= url(); ?>">Home</a></li>
                    <li class="mb-2"><a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Acessar Contatos" class="text-decoration-none text-smsub fw-bold" href="<?= url("/contatos"); ?>">Contatos</a></li>
                    <li class="mb-2"><a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Acessar Sobre" class="text-decoration-none text-smsub fw-bold" href="<?= url("/sobre"); ?>">Sobre</a></li>
<!--                    <li class="mb-2"><a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Acessar Blog" class="text-decoration-none text-smsub fw-bold" href="http://10.23.237.79/blog">Blog</a></li>-->
                    <?php if(!empty($user->id)):?>
                        <li class="mb-2"><a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Acessar Painel" class="text-decoration-none text-smsub fw-bold" href="<?= url("/dashboard"); ?>">Painel</a></li>
                    <?php else: ?>
                        <li class="mb-2"><a data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Login no Painel" class="text-decoration-none text-smsub fw-bold" href="<?= url("/entrar"); ?>">Entrar</a></li>
                    <?php endif;?>
                </ul>
            </div>

            <div class="col-12 col-lg-4 mb-3">
                <h5>Contato:</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><p><b>Telefone:</b><br> +55 11 4934-3131</p></li>
                    <li class="mb-2"><p><b>E-mail:</b><br>
                            <a class="text-decoration-none text-smsub fw-bold" href="mailto:<?=CONF_SITE_EMAIL?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="E-mail de COTI - Suporte"><?=CONF_SITE_EMAIL?></a></p></li>
                    <li class="mb-2"><p><b>Endereço:</b><br><a class="text-decoration-none text-smsub fw-bold" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Endereço no Google Maps de SMSUB"  target="_blank" href="https://www.google.com/maps/place/Condom%C3%ADnio+do+Edif%C3%ADcio+Martinelli/@-23.5455906,-46.6350075,15z/data=!4m6!3m5!1s0x94ce5854575bec47:0xcff6dbd0a9dd6bac!8m2!3d-23.5455906!4d-46.6350075!16s%2Fm%2F047d5rn?entry=ttu">
                                <i class="bi bi-pin-map-fill"></i> </a> Rua São Bento, 405 / Rua Líbero Badaró, 504 - Edifício Martinelli - 10º, 23º e 24º andar - Centro - São Paulo</p></li>
                </ul>
            </div>

            <div class="col-lg-2">
                <h5>Social:</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a target="_blank" class="text-decoration-none text-smsub fw-bold"
                                        href="https://www.facebook.com/<?= CONF_SOCIAL_FACEBOOK_PAGE; ?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="<?=CONF_SITE_NAME?> no Facebook"><i class="bi bi-facebook"></i> /SMSUB</a></li>
                    <li class="mb-2"><a target="_blank" class="text-decoration-none text-smsub fw-bold"
                                        href="https://www.instagram.com/<?= CONF_SOCIAL_INSTAGRAM_PAGE; ?>" data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="<?=CONF_SITE_NAME?> no Instagram"><i class="bi bi-instagram"></i> @SMSUB</a></li>
                    <li class="mb-2"><a target="_blank" class="text-decoration-none text-smsub fw-bold" href="https://www.youtube.com/<?= CONF_SOCIAL_YOUTUBE_PAGE; ?>"
                                        data-bs-togglee="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="<?=CONF_SITE_NAME?> no YouTube"><i class="bi bi-youtube"></i> /SMSUB</a></li>
                </ul>
            </div>

            <p data-bs-toggle="tooltip" data-bs-placement="left" title="Termos da <?=CONF_SITE_DESC?>" class="termos text-center p-3"> &copy; 2023, SMSUB todos os direitos reservados</p>
        </div>
    </div>
</footer>