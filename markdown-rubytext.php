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
            'onMarkdownInitialized' => ['onMarkdownInitialized', 0],
        ];
    }
    public function onMarkdownInitialized(Event $event)
    {
        $markdown = $event['markdown'];
        // Initialize Text example
        $markdown->addInlineType('{', 'RubyText');
        // Add function to handle this
        $markdown->inlineRubyText = function($excerpt) {
            if (preg_match('/{r}(\S+){\/r:(\S+)}/', $excerpt['text'], $matches))
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
                            'name' => 'rt',
                            'text' => $matches[2],
                            )
                        )
                    )
                );
            }
        };
    }
}
