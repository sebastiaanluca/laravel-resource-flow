# Changelog

All Notable changes to `sebastiaanluca/laravel-resource-flow` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

##  Unreleased

### Added

- Added module service provider
- Added automated router mapping in the module service provider
- Added a base Eloquent model
- Added a queueable job
- Added auto-discovery
- Added a test suite and tests
- Updated documents
- Added boolean date parsing in base model
- Load JSON translations
- Add Laravel 5.6 service provider bindings and singletons properties
- Alias all predefined class aliases

### Changed

- Require Laravel 5.6 or higher

### Removed

- Removed service provider `registerListeners` method
- Removed empty `mapRoutes` method
- Removed empty `registerCommands` method

### Fixed

- Correctly resolve config file
