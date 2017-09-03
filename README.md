# Grav Markdown RubyText Plugin

The **markdown-rubytext plugin** for [Grav](http://github.com/getgrav/grav) allows you to add output <ruby> tagged text in Markdown:

# Installation

This plugin is easy to install with GPM.

```
$ bin/gpm install markdown-rubytext
```

# Configuration

Simply copy the `user/plugins/markdown-color/markdown-rubytext.yaml` into `user/config/plugins/markdown-rubytext.yaml` and make your modifications.

```
enabled: true
```

# Usage

In your markdown file:

```
This is {r}日本語{/r:にほんご} and this is {r}漢{/r:ㄏㄢˋ}.
```

Will produce the following HTML:

```
This is <ruby><rb>日本語</rb><rp>（</rp><rt>にほんご</rt><rp>）</rp></ruby> and this is <ruby><rb>漢</rb><rp>（</rp><rt>ㄏㄢˋ</rt><rp>）</rp></ruby>.
```

Standart display:

![this-is-nihongo-and-this-is-kan](this-is-nihongo-and-this-is-kan.PNG)

# Futures goals (difficult, please contribute)

## make serial ruby possible:

In your markdown file, __2 or more successives shortcodes__:

```
主人公ルキウスが{r}驢{/r:ロ}{r}馬{/r:バ}に変えられる
```

Would produce the following HTML, nested by a __single `ruby` HTML tag__:

```
主人公ルキウスが<ruby><rb>驢</rb><rp>（</rp><rt>ロ</rt><rp>）</rp><rb>馬</rb><rp>（</rp><rt>バ</rt><rp>）</rp></ruby>に変えられる
```

Possibility to consider a __different specific pattern__ like for instance:

```
主人公ルキウスが{r}驢{r:ロ}馬{/r:バ}に変えられる
```

## add possibility to enabled from page

In your `config` file:

```
enabled: true
active: false
```

In your markdown file:

```
markdown-rubytext:
    active: true
```

Would activate the plugin.

A example can be found with the `shortcode-core` plugin [here](https://github.com/getgrav/grav-plugin-shortcode-core).
