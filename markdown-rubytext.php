<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;


class MarkdownRubyTextPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onMarkdownInitialized' => ['onMarkdownInitialized', 0],
        ];
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Initialize configuration
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__.'/shortcodes');
    }

    /**
     * old implementation without shortcode
     */
    public function onMarkdownInitialized(Event $event)
    {
        $markdown = $event['markdown'];
        // Initialize Text example
        $markdown->addInlineType('{', 'RubyText');
        // Add function to handle this
        $markdown->inlineRubyText = function($excerpt) {
            if (preg_match('/\{r}([^\s{]+){\/r:([^\s}]+)}/', $excerpt['text'], $matches))
            {
                return
                array(
                  'extent' => strlen($matches[0]),
                  'element' => array(
                    'name' => 'ruby',
                    'handler' => 'elements',
                    'text' => array(
                        array(
                            'name' => 'rb',
                            'text' => $matches[1],
                            ),
                        array(
                            'name' => 'rp',
                            'text' => '（',
                            ),
                        array(
                            'name' => 'rt',
                            'text' => $matches[2],
                            ),
                        array(
                            'name' => 'rp',
                            'text' => '）',
                            )
                        )
                    )
                );
            }
        };
    }
}
