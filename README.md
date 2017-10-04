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

## simple ruby

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

## serial ruby

In your markdown file, __2 or more successives shortcodes__:

```
This is {r}日(に)本(ほん)語(ご){/r} and this is {r}漢(ㄏㄢˋ){/r}.
```

Will produce the following HTML, nested by a __single `ruby` HTML tag__:

```
This is <ruby><rb>日</rb><rp>（</rp><rt>に</rt><rp>）</rp><rb>本</rb><rp>（</rp><rt>ほん</rt><rp>）</rp><rb>語</rb><rp>（</rp><rt>ご</rt><rp>）</rp></ruby> and this is <ruby><rb>漢</rb><rp>（</rp><rt>ㄏㄢˋ</rt><rp>）</rp></ruby>.
```

# Future goal (difficult, please contribute)

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
