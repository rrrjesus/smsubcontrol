<nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-chevron p-2 bg-body-tertiary rounded-3">
        <li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-<?=CONF_WEB_COLOR?>" href="<?=url("/")?>"><i class="bi bi-house-heart"></i> Início</a></li>
        <?php 
            if(isset($urls)): 
                echo '<li class="breadcrumb-item"><a class="link-body-emphasis fw-semibold text-decoration-none text-'.CONF_WEB_COLOR.' text-capitalize" href="'.url("/{$urls}").'"><i class="bi bi-'.$icon.'"></i> '.$urls.'</a></li>';
            endif;
            if(isset($page)): 
                echo '<li class="breadcrumb-item active" aria-current="page"><i class="bi bi-'.$iconpage.' me-1"></i>'.$page.'</li>';
            endif;
        ?>
    </ol>
</nav>