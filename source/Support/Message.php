<?php

namespace Source\Support;

use Source\Core\Session;

/**
 * Class Message
 *
 * @authores Robson V. Leite  & Rodolfo Romaioli R. de Jesus
 * @package Source\Core
 */
class Message
{
    /** @var string */
    private $text;

    /** @var string */
    private $type;

    /** @var */
    private $after;

    /** @var */
    private $before;

    /** @var */
    private $icon;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @param string $text
     * @return $this
     */
    public function after(string $text): Message
    {
        $this->after = $text;
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function before(string $text): Message
    {
        $this->before = $text;
        return $this;
    }

    /**
     * @param string $text
     * @return $this|null
     */
    public function icon(string $text = "book-half"): ?Message
    {
        $this->icon = $text;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;

    }
    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->after.$this->text.$this->before;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function info(string $message): Message
    {
        $this->type = "bd-callout-info";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function success(string $message): Message
    {
        $this->type = "bd-callout-success";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function warning(string $message): Message
    {
        $this->type = "bd-callout-warning";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @param string $message
     * @return Message
     */
    public function error(string $message): Message
    {
        $this->type = "bd-callout-danger";
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return "<div class='bd-callout fw-semibold text-center message" . " {$this->getType()}'><i class='bi bi-{$this->getIcon()} fs-5 me-2'></i> {$this->getText()}</div>";
    }

    /**
     * @return string
     */
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
     * @param string $message
     * @return string
     */
    private function filter(string $message): string
    {
        return $message;
    }
}