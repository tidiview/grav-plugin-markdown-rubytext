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
            if (preg_match('/(*UTF8)\{r}([^\s{]+){\/r:([^\s}]+)}/', $excerpt['text'], $matches))
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
            } elseif (preg_match('/(*UTF8)\{r}([^\s{]+){\/r}/', $excerpt['text'], $matches))
            {
                $matchesminusun = array_slice($matches,1);
                $strings = rtrim($matchesminusun[0],')');
                $extract = explode (')',$strings);
                $out = array();

                foreach ($extract as $value) {
                $value = explode('(',$value);
                $out = array_merge($out,array(array('name'=>'rb','text'=>$value[0]),array('name'=>'rp','text'=>'('),array('name'=>'rt','text'=>$value[1]),array('name'=>'rp','text'=>')')));
                };

                return
                array(
                  'extent' => strlen($matches[0]),
                  'element' => array(
                    'name' => 'ruby',
                    'handler' => 'elements',
                    'text' => $out
                    )
                );
            }
        };
    }
}
