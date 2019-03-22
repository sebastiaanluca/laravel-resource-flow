# Changelog

All Notable changes to `sebastiaanluca/laravel-resource-flow` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

##  Unreleased

### Added

- Added enforcer
- Added interaction
- Added interaction exception to respond early
- Added support for Laravel 5.8

### Removed

- Removed AuthorizesRequests from RequestHandler
- Removed DispatchesJobs from RequestHandler
- Removed ValidatesRequests from RequestHandler
- Removed support for Laravel 5.7 and lower

## 0.4.0 (2018-09-17)

### Changed

- Allow the request handler before method to return an early response

## 0.3.0 (2018-09-04)

### Added

- Run tests against Laravel 5.7

##  0.2.2 (2018-08-06)

### Changed

- Moved event listener registration to the service provider `boot` method
- Renamed `mapModelMorphAliases` method

## 0.2.1 (2018-07-26)

### Changed

- Clean up TestCase

### Fixed

- Remove deprecated nesbot/carbon requirement
- Remove deprecated BooleanDates requirement

##  0.2.0 (2018-07-26)

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
- Added a call to a request handler's _before_ method

### Changed

- Require PHP 7.2 or higher
- Require Laravel 5.6 or higher

### Removed

- Removed empty `mapRoutes` method
- Removed empty `registerCommands` method
- Removed empty `bindRepositories` method
- Removed empty `mapMorphTypes` method
- Removed empty `bootMiddleware` method
- Extracted `BooleanDates` class to its own package

### Fixed

- Correctly resolve config file
