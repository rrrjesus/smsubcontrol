<?php

namespace Source\Support;

use Source\Core\Session;
    
    /**
     * Class Modal
     *
     * @author Rodolfo Romaioli Ribeiro de Jesus <rodolfo.romaioli@gmail.com>
     * @package Source\Core
     */

    class Modal
    {
        /** @var string */
        private $text;
    
        /** @var string */
        private $type;

        /** @var string */
        private $title;
    
        /** @var string */
        private $icon;
    
        /** @return string */
        public function __toString()
        {
            return $this->render();
        }
    
        /** @return string */
        public function getText(): ?string
        {
            return $this->text;
        }
    
        /** @return string */
        public function getType(): ?string
        {
            return $this->type;
        }

        /** @return string */
        public function getTitle(): ?string
        {
            return $this->title;
        }
    
        /**
         * @return string|null
         */
        public function getIcon(): ?string
        {
            return $this->icon;
        }
    
        public function icon(string $text = "exclamation-octagon"): Modal
        {
            $this->icon = $text;
            return $this;
        }
    
        /**
         * @param string $modal
         * @return Modal
         */
        public function info(string $modal): Modal
        {
            $this->type = "info";
            $this->text = $this->filter($modal);
            return $this;
        }
    
        /**
         * @param string $modal
         * @return Modal
         */
        public function success(string $modal): Modal
        {
            $this->type = "success";
            $this->text = $this->filter($modal);
            return $this;
        }
    
        /**
         * @param string $modal
         * @return Modal
         */
        public function warning(string $modal): Modal
        {
            $this->type = "warning";
            $this->text = $this->filter($modal);
            return $this;
        }
    
        /**
         * @param string $modal
         * @return Modal
         */
        public function error(string $modal): Modal
        {
            $this->type = "danger";
            $this->text = $this->filter($modal);
            return $this;
        }
    
        /** @return string */
        public function render(): string
        {
            return "<div class='modal fade' id='modal' tabindex='-1' aria-labelledby='modalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-sm'>
                            <div class='modal-content'>
                            <div class='modal-header bg-secondary text-light'>
                                <h1 class='modal-title fs-5' id='modalLabelSair'>Teste</h1>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body fw-semibold'>
                                Deseja sair do sistema ?
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-outline-danger btn-sm fw-semibold' data-bs-dismiss='modal'><i class='bi bi-trash'></i> Não</button>
                                <a href='teste' class='btn btn-outline-success btn-sm fw-semibold'><i class='bi bi-plus-circle' role='button' ></i> Sim</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var modal = document.getElementById('modal');
                            var closeButton = document.querySelector('.close-button');

                            modal.style.display = 'block';

                            closeButton.addEventListener('click', function() {
                                modal.style.display = 'none';
                            });

                            window.addEventListener('click', function(event) {
                                if (event.target == modal) {
                                    modal.style.display = 'none';
                                }
                            });
                        });
                    </script>
                </div>";
    }
    
        /** @return string */
        public function json(): string
        {
            return json_encode(["error" => $this->getText()]);
        }
    
        /**
         * Set flash Session Key
         */
        public function flash(): void
        {
            (new Session())->set("flash", $this);
        }
    
        /**
         * @param string $modal
         * @return string
         */
        private function filter(string $modal): string
        {
            return filter_var($modal, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    }
