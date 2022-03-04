<p align="center"><a href="https://syntafin.dev" target="_blank"><img src="https://share.syntafin.de/github/dev_slogan.png" width="600" /></a></p>

<p align="center">
<a href="https://discord.gg/7NqGZfn" target="_blank"><img src="https://img.shields.io/discord/616573354685759488?color=fe93db&label=Discord&style=for-the-badge" alt="Discord" /></a>
<a href="xmpp://syntafin@tengu.chat"><img src="https://img.shields.io/static/v1?label=XMPP&message=syntafin@tengu.chat&color=fe93db&style=for-the-badge" alt="XMPP" /></a>
<a href="mailto://mail@syntaf.in"><img src="https://img.shields.io/static/v1?label=Mail&message=hello@syntafin.dev&color=fe93db&style=for-the-badge" alt="Email me" /></a>
<a href="LICENSE"><img src="https://img.shields.io/static/v1?label=Lizenz&message=MIT&color=fe93db&style=for-the-badge" alt="License" /></a>
</p>

# Table of contents

* [About the project](#about-the-project)
* [Contributing](#contributing)
* [Versioning](#versioning)
* [Authors](#authors)
* [License](#license)

# About the project

This is a simple package to provide a Discord Widget through a Livewire component.
Thanks to [SoftCreatR](https://github.com/softcreatr) for the inspiration!

# Installation

``composer require syntafin/discordwidget``

# Usage

Add ``@discordWidget`` to the ``<head>`` of your page.

To show the widget:

``@livewire('discord-widget', ['serverId' => '1234'])``

or

``<livewire:discord-widget :serverId="1234" />``

# Configuration

The Widget comes with pre-compiled assets, but if you want to use your own Stylesheet,
you can disable the import in the config ``discordwidget.php``.
Don't forget to add ``./vendor/syntafin/discordwidget/**/*.php`` to the ``content`` array in your
TailwindCSS config.

# Contributing

There are many ways to help this open source project. Write bug reports, make feature requests, write code, help us translate the page (maybe we will support Chinese and Korean if we have people who help us with). We look forwar to every contribution.

For more information and our guidelines, please refer to the [CONTRIBUTING.md](CONTRIBUTING.md) file.

# Versioning

We use [SemVer](http://semver.org/) for versioning. For available versions, see the [tags on this repository](tags). 

# Authors

* [Syntafin](https://github.com/syntafin)

# License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

# TODO

* Replace Bootstrap with own
* Get assets published (CSS/SCSS)
