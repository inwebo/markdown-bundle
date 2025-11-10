# Symfony Markdown Bundle
![Packagist Version](https://img.shields.io/packagist/v/inwebo/markdown-bundle?style=flat-square)
![Packagist Downloads](https://img.shields.io/packagist/dd/inwebo/markdown-bundle?style=flat-square)
![Packagist License](https://img.shields.io/packagist/l/inwebo/markdown?style=flat-square)


## Introduction

The Inwebo Markdown Bundle integrates Inwebo\Markdown\Factory into Symfony applications, providing a simple and configurable way to convert Markdown to safe HTML. It registers the factory as a service for dependency injection, supports parser configuration and extensions, and is installed via Composer. Inject Inwebo\\Markdown\\Factory and call parse() to render Markdown content.

> See [Inwebo\Markdown](https://github.com/inwebo/markdown) for more information.
> 
## Installation

```bash
composer require inwebo/markdown-bundle
```
## Usage

```php

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Inwebo\Markdown\Factory;

class MarkdownController extends AbstractController
{
    // DI
    public function __construct(private readonly Factory $factory)
    {
    }

    #[Route('/markdown/preview', name: 'markdown_preview')]
    public function preview(): Response
    {
        $markdown = <<<'MD'
# Bonjour

Ceci est un exemple de *Markdown* converti en HTML via `Inwebo\Markdown\Factory`.
MD;
        // Call the parser and you are done!
        $html = $this->factory->parse($markdown);

        return new Response($html, Response::HTTP_OK, ['Content-Type' => 'text/html; charset=utf-8']);
    }
}

```
