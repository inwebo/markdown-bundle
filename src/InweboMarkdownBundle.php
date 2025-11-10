<?php

declare(strict_types=1);

namespace Inwebo\MarkdownBundle;

use Inwebo\Markdown\Factory;
use Inwebo\Markdown\Html\Block\Blockquote;
use Inwebo\Markdown\Html\Block\H1;
use Inwebo\Markdown\Html\Block\H2;
use Inwebo\Markdown\Html\Block\H3;
use Inwebo\Markdown\Html\Block\H4;
use Inwebo\Markdown\Html\Block\H5;
use Inwebo\Markdown\Html\Block\H6;
use Inwebo\Markdown\Html\Block\Hr;
use Inwebo\Markdown\Html\Block\Ol;
use Inwebo\Markdown\Html\Block\Paragraph;
use Inwebo\Markdown\Html\Block\Ul;
use Inwebo\Markdown\Html\Inline\Bold;
use Inwebo\Markdown\Html\Inline\Image;
use Inwebo\Markdown\Html\Inline\Italic;
use Inwebo\Markdown\Html\Inline\Link;
use Inwebo\Markdown\Html\Inline\Strikethrough;
use Inwebo\Markdown\Html\TagFactory;
use Inwebo\Markdown\Model\Enum\NodeType;
use Inwebo\Markdown\Parser;
use Inwebo\Markdown\Token\Token;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class InweboMarkdownBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->services()
            ->set('inwebo_markdown.parser.tokens.paragraph', Token::class)
                ->arg('$type', NodeType::PARAGRAPH)
            ->set('inwebo_markdown.parser.tokens.ul', Token::class)
                ->arg('$type', NodeType::UL)
            ->set('inwebo_markdown.parser.tokens.ol', Token::class)
                ->arg('$type', NodeType::OL)
            ->set('inwebo_markdown.parser.tokens.hr', Token::class)
                ->arg('$type', NodeType::HR)
            ->set('inwebo_markdown.parser.tokens.h1', Token::class)
                ->arg('$type', NodeType::H1)
            ->set('inwebo_markdown.parser.tokens.h2', Token::class)
                ->arg('$type', NodeType::H2)
            ->set('inwebo_markdown.parser.tokens.h3', Token::class)
                ->arg('$type', NodeType::H3)
            ->set('inwebo_markdown.parser.tokens.h4', Token::class)
                ->arg('$type', NodeType::H4)
            ->set('inwebo_markdown.parser.tokens.h5', Token::class)
                ->arg('$type', NodeType::H5)
            ->set('inwebo_markdown.parser.tokens.h6', Token::class)
                ->arg('$type', NodeType::H6)
            ->set('inwebo_markdown.parser.tokens.blockquote', Token::class)
                ->arg('$type', NodeType::BLOCKQUOTE)
            ->set('inwebo_markdown.parser.tokens.bold', Token::class)
                ->arg('$type', NodeType::BOLD)
            ->set('inwebo_markdown.parser.tokens.italic', Token::class)
                ->arg('$type', NodeType::ITALIC)
            ->set('inwebo_markdown.parser.tokens.strikethrough', Token::class)
                ->arg('$type', NodeType::STRIKETHROUGH)
            ->set('inwebo_markdown.parser.tokens.link', Token::class)
                ->arg('$type', NodeType::LINK)
            ->set('inwebo_markdown.parser.tokens.image', Token::class)
                ->arg('$type', NodeType::IMAGE)

            ->set('inwebo_markdown.parser', Parser::class)
                ->arg(0, service('inwebo_markdown.parser.tokens.paragraph'))
                ->arg(1, service('inwebo_markdown.parser.tokens.ul'))
                ->arg(2, service('inwebo_markdown.parser.tokens.ol'))
                ->arg(3, service('inwebo_markdown.parser.tokens.hr'))
                ->arg(4, service('inwebo_markdown.parser.tokens.h1'))
                ->arg(5, service('inwebo_markdown.parser.tokens.h2'))
                ->arg(6, service('inwebo_markdown.parser.tokens.h3'))
                ->arg(7, service('inwebo_markdown.parser.tokens.h4'))
                ->arg(8, service('inwebo_markdown.parser.tokens.h5'))
                ->arg(9, service('inwebo_markdown.parser.tokens.h6'))
                ->arg(10, service('inwebo_markdown.parser.tokens.blockquote'))
                ->arg(11, service('inwebo_markdown.parser.tokens.bold'))
                ->arg(12, service('inwebo_markdown.parser.tokens.italic'))
                ->arg(13, service('inwebo_markdown.parser.tokens.strikethrough'))
                ->arg(14, service('inwebo_markdown.parser.tokens.link'))
                ->arg(15, service('inwebo_markdown.parser.tokens.image'))
                ->public()

            ->set('inwebo_markdown.html_tag_factory.paragraph', Paragraph::class)
            ->set('inwebo_markdown.html_tag_factory.h1', H1::class)
            ->set('inwebo_markdown.html_tag_factory.h2', H2::class)
            ->set('inwebo_markdown.html_tag_factory.h3', H3::class)
            ->set('inwebo_markdown.html_tag_factory.h4', H4::class)
            ->set('inwebo_markdown.html_tag_factory.h5', H5::class)
            ->set('inwebo_markdown.html_tag_factory.h6', H6::class)
            ->set('inwebo_markdown.html_tag_factory.ul', Ul::class)
            ->set('inwebo_markdown.html_tag_factory.ol', Ol::class)
            ->set('inwebo_markdown.html_tag_factory.hr', Hr::class)
            ->set('inwebo_markdown.html_tag_factory.blockquote', Blockquote::class)
            ->set('inwebo_markdown.html_tag_factory.strikethrough', Strikethrough::class)
            ->set('inwebo_markdown.html_tag_factory.bold', Bold::class)
            ->set('inwebo_markdown.html_tag_factory.italic', Italic::class)
            ->set('inwebo_markdown.html_tag_factory.link', Link::class)
            ->set('inwebo_markdown.html_tag_factory.image', Image::class)

            ->set('inwebo_markdown.html_tag_factory', TagFactory::class)
                ->arg(0, service('inwebo_markdown.html_tag_factory.h1'))
                ->arg(1, service('inwebo_markdown.html_tag_factory.h2'))
                ->arg(2, service('inwebo_markdown.html_tag_factory.h3'))
                ->arg(3, service('inwebo_markdown.html_tag_factory.h4'))
                ->arg(4, service('inwebo_markdown.html_tag_factory.h5'))
                ->arg(5, service('inwebo_markdown.html_tag_factory.h6'))
                ->arg(6, service('inwebo_markdown.html_tag_factory.ul'))
                ->arg(7, service('inwebo_markdown.html_tag_factory.ol'))
                ->arg(8, service('inwebo_markdown.html_tag_factory.hr'))
                ->arg(9, service('inwebo_markdown.html_tag_factory.blockquote'))
                ->arg(10, service('inwebo_markdown.html_tag_factory.paragraph'))
                ->arg(11, service('inwebo_markdown.html_tag_factory.strikethrough'))
                ->arg(12, service('inwebo_markdown.html_tag_factory.bold'))
                ->arg(13, service('inwebo_markdown.html_tag_factory.italic'))
                ->arg(14, service('inwebo_markdown.html_tag_factory.link'))
                ->arg(15,service('inwebo_markdown.html_tag_factory.image'))
                ->public()

            ->set('inwebo_markdown.factory', Factory::class)
                ->arg('$parser', service('inwebo_markdown.parser'))
                ->arg('$tagFactory', service('inwebo_markdown.html_tag_factory'))
                ->alias(Factory::class, 'inwebo_markdown.factory')
                ->public()
        ;
    }
}