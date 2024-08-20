<?php $this->layout("_theme"); ?>

<link rel="stylesheet" href="<?=theme("/assets/css/blog.css"); ?>"/>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="chevron-right" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
  </symbol>
</svg>

<div class="container">
  <header class="border-bottom lh-1 py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-body-emphasis text-decoration-none" href="#">Blog de Notícias</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" name="search" action="<?= url("/blog/buscar"); ?>" method="post" enctype="multipart/form-data">
          <input type="text" name="s" class="form-control" placeholder="Buscar..." aria-label="Buscar">
        </form>       
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-3 border-bottom">
    <nav class="nav nav-underline justify-content-center ">
    <?php if (!empty($category)): ?>
      <?php foreach ($category as $categories): ?>
        <a class="nav-item nav-link link-body-emphasis" href="<?= url("/blog/em/{$categories->uri}"); ?>"><?=$categories->title?></a>
      <?php endforeach; ?>
    <?php endif; ?>
    </nav>
  </div>
</div>

<main class="container">
  <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
    <div class="col-lg-6 px-0">
      <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
      <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></p>
    </div>
  </div>

  <div class="row mb-2">
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-body-secondary">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Continue reading
            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success-emphasis">Design</strong>
          <h3 class="mb-0">Post title</h3>
          <div class="mb-1 text-body-secondary">Nov 11</div>
          <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
            Continue reading
            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-5">
    <div class="col-md-8">
      <?php if (empty($blog) && !empty($search)): ?>
          <div class="content content">
              <div class="empty_content">
                  <h3 class="empty_content_title">Sua pesquisa não retornou resultados :/</h3>
                  <p class="empty_content_desc">Você pesquisou por <b><?= $search; ?></b>. Tente outros termos.</p>
                  <a class="empty_content_btn gradient gradient-green gradient-hover radius"
                    href="<?= url("/blog"); ?>" title="Blog">...ou volte ao blog</a>
              </div>
          </div>
      <?php elseif (empty($blog)): ?>
          <div class="content content">
              <div class="empty_content">
                  <h3 class="empty_content_title">Ainda estamos trabalhando aqui!</h3>
                  <p class="empty_content_desc">Nossos editores estão preparando um conteúdo de primeira para você.</p>
              </div>
          </div>
      <?php else: ?>
          <div class="blog_content container content">
              <div class="blog_articles">
                  <?php foreach ($blog as $post): ?>
                      <?php $this->insert("blog-list", ["post" => $post]); ?>
                  <?php endforeach; ?>
              </div>

              <nav aria-label="Page navigation example">
                <?= $paginator; ?>
              </nav>
              
          </div>
      <?php endif; ?>
    </div>

    <div class="col-md-4">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-body-tertiary rounded">
          <h4 class="fst-italic">Sobre o Blog</h4>
          <p class="mb-0"><strong>Blog de Notícias </strong>voltado a informações do mundo da tecnologia em <strong>COTI-SMSUB</strong>. Orientações e novidades em sistemas estão entre as principais notícias.</p>
        </div>

        <div>
            <h4 class="fst-italic">Recentes</h4>
            <ul class="list-unstyled">
            <?php if (!empty($recents)): ?>
                <?php foreach ($recents as $recent): ?>
                  <li>
                    <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="<?= url("/blog/{$recent->uri}"); ?>">
                      <img class="img-fluid" alt="<?= $recent->title; ?>" title="<?= $recent->title; ?>" src="<?= image($recent->cover, 100, 100); ?>">
                      <div class="col-lg-8"> 
                        <h6 class="mb-0"><?= $recent->title; ?></h6>
                        <small class="text-body-secondary"><?=strftime('%d de %B de %Y', strtotime($recent->updated_at));?></small>
                      </div>
                    </a>
                  </li>
                <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>

        <div class="p-4">
          <h4 class="fst-italic">Archives</h4>
          <ol class="list-unstyled mb-0">
            <li><a href="#">March 2021</a></li>
            <li><a href="#">February 2021</a></li>
            <li><a href="#">January 2021</a></li>
            <li><a href="#">December 2020</a></li>
            <li><a href="#">November 2020</a></li>
            <li><a href="#">October 2020</a></li>
            <li><a href="#">September 2020</a></li>
            <li><a href="#">August 2020</a></li>
            <li><a href="#">July 2020</a></li>
            <li><a href="#">June 2020</a></li>
            <li><a href="#">May 2020</a></li>
            <li><a href="#">April 2020</a></li>
          </ol>
        </div>

        <div class="p-4">
          <h4 class="fst-italic">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="blog_page">
    <header class="blog_page_header">
        <h1><?= ($title ?? "BLOG"); ?></h1>
        <p><?= ($search ?? $desc ?? "Confira nossas dicas para controlar melhor suas contas"); ?></p>
        <form name="search" action="<?= url("/blog/buscar"); ?>" method="post" enctype="multipart/form-data">
            <label>
                <input type="text" name="s" placeholder="Encontre um artigo:" required/>
                <button class="icon-search icon-notext"></button>
            </label>
        </form>
    </header>


</section>