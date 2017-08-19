<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class RubyShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ruby', function(ShortcodeInterface $sc) {
            $output = $this->twig->processTemplate('partials/ruby.html.twig', [
                'rt' => $sc->getParameter('ruby', $sc->getBbCode()) ?: '',
                'rb' => $sc->getContent()
            ]);

            return $output;
        });
    }
}
?>
