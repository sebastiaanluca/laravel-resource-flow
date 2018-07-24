# Changelog

All Notable changes to `sebastiaanluca/laravel-resource-flow` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

##  Unreleased

### Added

- Added a base Eloquent model
- Added a queueable job
- Added auto-discovery
- Added a test suite and tests
- Updated documents
- Added boolean date parsing in base model
- Add Laravel 5.6 service provider bindings and singletons properties
- Alias all predefined class aliases
- Map polymorphic models to their alias
- Auto-register event listeners and subscribers

### Changed

- Require Laravel 5.6 or higher

### Removed

- Removed empty `mapRoutes` method
- Removed empty `registerCommands` method
- Removed empty `bindRepositories` method
- Removed empty `mapMorphTypes` method
- Removed empty `bootMiddleware` method

### Fixed

- Correctly resolve config file
