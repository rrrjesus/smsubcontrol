<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
        <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none" href="<?=url("/painel")?>"><i class="bi bi-house-heart"></i> Início</a></li>

        <?php
            if(isset($urls)){
                echo breadcrumbAdmin($urls, $namepage, $name);
            }
        ?>
    </ol>
</nav>