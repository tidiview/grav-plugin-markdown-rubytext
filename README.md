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

# Examples

```
This is {r}日本語{/r:にほんご} and this is {r}漢{/r:ㄏㄢˋ}.
```

Will produce the following HTML:

```
<p>
    This is <ruby><rb>日本語</rb><rt>にほんご</rt></ruby> and this is <ruby><rb>漢</rb><rt>ㄏㄢˋ</rt></ruby>.
```

Standart display:

![this-is-nihongo-and-this-is-kan](this-is-nihongo-and-this-is-kan.PNG)
