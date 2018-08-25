# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.1] - 2018-08-24
### Added
- `CHANGELOG.md`
- `.editorconfig`

### Fixed
- Fix incorrect boolean value in `README.md`

## [1.0.0] - 2018-08-24
### Added
- Abstract class `Hugger` implementing `GroupHuggable`
  (and therefore `Huggable` too)
- Reference implementations extending `Hugger`
    - `Satisfiable` - tracks/increments internal satisfaction state on hugging
    - `Silent` - executes without modifying state or causing side effects
    - `Verbose` - writes to output on hugging  

[Unreleased]: https://github.com/michaelbiberich/huggables/compare/1.0.1...HEAD
[1.0.1]: https://github.com/michaelbiberich/huggables/compare/1.0.0...1.0.1
[1.0.0]: https://github.com/michaelbiberich/huggables/tree/1.0.0
